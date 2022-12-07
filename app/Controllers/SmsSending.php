<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Pipedrive;

class SmsSending extends BaseController {

    protected $persons_phones = [];
    
    protected $twilio_phones = [];

    protected $pipedrive_deal_id;

    public function index() {
        //reouth pipedrive with the outhtoken
        helper('phones');
        $pipedrive_conf = config('Pipedrive');
        $this->pipedrive = new Pipedrive\Client($pipedrive_conf->oAuthClientId, $pipedrive_conf->oAuthClientSecret, $pipedrive_conf->oAuthRedirectUri);
        // callback stores token for reuse when token is updated
        Pipedrive\Configuration::$oAuthTokenUpdateCallback = function ($token) {
            cache()->save("pipe_drive_oath_token", $token, 0);
        };
        // check if a token is available
        if(!cache('pipe_drive_oath_token')){
            // redirect user to a page that handles authorization
            return redirect()->to(filter_var($pipedrive_conf->oAuthRedirectUri, FILTER_SANITIZE_URL));
        }
        // set access token in configuration
        Pipedrive\Configuration::$oAuthToken = cache('pipe_drive_oath_token');
        if($this->request->getMethod() !== 'post'){
            $this->getClientsPhones();
            $this->getTwilioPhones();
            $response = $this->formatFormResponse();
        }else{
            $response = $this->formatSucssesResponse();
            $data = $this->request->getJSON();
            $phone_to = phone_validate($data->block_key_phone_to) ?? null;
            $phone_from = phone_validate($data->block_key_phone_from) ?? null;
            $message = trim($data->block_key_message) ?? null;
            $deal_id = $data->block_key_deal_id ?? null;
            if(!$phone_to || !$phone_from || !$message || !$deal_id){
                $response = '{
                    "error": {
                        "message": "All fields required. OR some fields value are incorrect."
                    }
                }';
            }
            // send sms
            $twilio_respond = $this->twilio->messages->create(
                $phone_to,
                [
                    'from' => $phone_from,
                    'body' => $message,
                ]
            );
            // write the note
            $notes = $this->pipedrive->getNotes();
            $result = $notes->addANote(['dealId' => $deal_id, 'content' => 'SMS was send with text: ' . $message]);

//                log_message('error',  '{message}', ['message' => serialize($result)]);
        }

        $this->response->setStatusCode(200)
                ->setContentType('application/json')
                ->setBody($response)
                ->send();
    }
    
    /**
     * search the persons phones in pipedrive
     * @return void
     */
    protected function getClientsPhones() : void
    {
        $this->pipedrive_deal_id = $this->request->getGet('selectedIds');
        $deals = $this->pipedrive->getDeals();
        $deal_details = $deals->getDetailsOfADeal($this->pipedrive_deal_id);
        $client_phones = $deal_details->data->personId->phone;
        foreach($client_phones as $i => $client_phone){
            if(!phone_validate_mobile($client_phone->value)){
                continue;
            }
            $this->persons_phones[$i]['label'] = $client_phone->value;
            $this->persons_phones[$i]['value'] = $client_phone->value;
        }
    }
    
    /**
     * search the twilio phones
     * @return void
     */
    protected function getTwilioPhones() : void
    {
        $twilio_numbers = $this->twilio->incomingPhoneNumbers->read([], 20);
        foreach($twilio_numbers as $i => $twilio_number){
            if(!phone_validate($twilio_number->phoneNumber)){
                continue;
            }
            $this->twilio_phones[$i]['label'] = $twilio_number->phoneNumber;
            $this->twilio_phones[$i]['value'] = $twilio_number->phoneNumber;
        }
    }
    
    /**
     * format the response for form structure
     * @return string
     */    
    protected function formatFormResponse() : string
    {
        return '{
            "data": {
                "blocks": {
                    "block_key_deal_id":{
                        "label":"Deal id",
                        "value":"'.$this->pipedrive_deal_id.'",
                        "visibleOn":"never"
                    },
                    "block_key_phone_to":{
                        "label":"Phone to",
                        "placeholder":"Phone to",
                        "message":"Phone numbers are in E.164 format (e.g., +16175551212)",
                        "items":'.json_encode($this->persons_phones).'
                    },
                    "block_key_phone_from":{
                        "label":"Phone from",
                        "placeholder":"Phone from",
                        "message":"Phone numbers are in E.164 format (e.g., +16175551212)",
                        "items":'.json_encode($this->twilio_phones).'
                    }
                },
                "actions": {}
            }
        }';
    }
    
    /**
     * format the sucsess responce to pipedrive
     * @return string
     */
    protected function formatSucssesResponse() : string
    {
        return '{
            "success": {
                "message": "Successfully done",
                "type": "snackbar",
                "link": {
                    "label": "View item",
                    "value": "https://marketplace.pipedrive.com"
                }
            }
        }';
    }
}
