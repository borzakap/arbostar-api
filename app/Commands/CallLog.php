<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\CallLogs;
use CodeIgniter\I18n\Time;
use Pipedrive;
use Twilio;

/**
 * Description of CallLogs
 *
 * @author alexey
 */
class CallLog extends BaseCommand
{
    protected $group = 'Call';
    
    protected $name = 'call:logs';

    protected $description = 'Get call logs from twilil in CLI';
    
    protected $usage = 'call:logs';
    
    protected $arguments = [];
    
    protected $options = [];
    
    protected $twilio;
    
    protected $pipedrive;
    
    public function run(array $params = []) {
        
        $write = 0;
        
        // pipedrive init
        $pipdrive = config(\Config\Pipedrive::class);
        $this->pipedrive = new Pipedrive\Client(null, null, null, $pipdrive->apiToken);
    
        // twilio init
        $twilio = config(\Config\Twilio::class);
        $this->twilio = new Twilio\Rest\Client($twilio->sid, $twilio->token);

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
                $callLogs->attachAnAudioFileToTheCallLog($call_log->data->id, $callection);
            }
            $write++;
        }
        CLI::write('Writed calls: ' . $write, 'green');
    }
}
