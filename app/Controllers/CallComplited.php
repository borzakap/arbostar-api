<?php

namespace App\Controllers;

use App\Libraries\CallLogs;

class CallComplited extends BaseController
{
    public function index()
    {
        $response_service = $this->request->getPost();
        log_message('error',  '{message}', ['message' => serialize($response_service)]);

        $call_data = new CallLogs($this->request->getPost());
        // find the person by phone
        $persons = $this->pipedrive->getPersons();
        $collect = [
            'term' => $call_data->getClientsPhoneNumber(),
            'fields' => 'phone',
        ];
        $person = $persons->searchPersons($collect);
        if(!$person->success){
            return $this->fail('no person', 400);
        }
        $person_id = $person->data->items[0]->item->id;
        // find the deal
        $persons_deals = $this->pipedrive->listDealsAssociatedWithAPerson(['id'=>$person_id]);
        if(!$persons_deals->success){
            return $this->fail('no deals', 400);
        }
        $deal_id = $persons_deals->data->items[0]->item->id;
        // get pipedrive callLogs controller
        $callLogs = $this->pipedrive->getCallLogs();
        // set the deal id
        $call_data->setDealId($deal_id);
        $callLogs->addACallLog($call_data->toArray());
    }
}
