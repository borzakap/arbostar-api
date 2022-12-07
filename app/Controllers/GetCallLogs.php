<?php

namespace App\Controllers;

use App\Libraries\CallLogs;
use CodeIgniter\I18n\Time;

class GetCallLogs extends BaseController{
    
    protected $personId;
    
    protected $dealId;

    public function index(){
        
        $before = Time::now('UTC');
        $after = $before->subMinutes(10);

        $calls = $this->twilio->calls->read(
                [
                    'starttimeAfter' => $after->toDateTimeString(),
                    'starttimeBefore' => $before->toDateTimeString(),
                ]
        );
        foreach($calls as $call){
            $call_data = new CallLogs();
            $call_data->setFromPhoneNumber($call->from);
            $call_data->setToPhoneNumber($call->to);
            $call_data->setOutcome($call->status);
            $call_data->setStartTime($call->startTime->format('Y-m-d H:i:s'));
            $call_data->setEndTime($call->endTime->format('Y-m-d H:i:s'));
            $call_data->setDuration($call->duration);
            $call_data->setClientsPhoneNumber($call->direction);
            // find the person by phone
            if(!$call_data->getClientsPhoneNumber()){
                continue;
            }
            $persons = $this->pipedrive->getPersons();
            $collect = [
                'term' => $call_data->getClientsPhoneNumber(),
                'fields' => 'phone',
            ];
            $person = $persons->searchPersons($collect);
            $this->personId = $person->data->items[0]->item->id ?? null;
            if(!$this->personId){
                continue;
            }
            $persons_deals = $persons->listDealsAssociatedWithAPerson(['id' => $this->personId]);
            $this->dealId = $persons_deals->data[0]->id ?? null;
            if(!$this->dealId){
                continue;
            }
            // get pipedrive callLogs controller
            $callLogs = $this->pipedrive->getCallLogs();
            // set the deal id
            $call_data->setDealId($this->dealId);
            $call_log = $callLogs->addACallLog($call_data->toArray());
            // write the call record
            $recording = $this->twilio->recordings->read(['callSid' => $call->sid]);
            if(!empty($recording)){
                $callection = [
                    'file' => $recording[0]->mediaUrl,
                    'mime_type' => 'audio/wave',
                ];
                $record = $callLogs->attachAnAudioFileToTheCallLog($call_log->data->id, $callection);
//                print_r($record);
            }
        }
        return;
    }
}
