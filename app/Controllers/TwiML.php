<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Twilio\TwiML\VoiceResponse;
use CodeIgniter\API\ResponseTrait;

class TwiML extends BaseController {

    use ResponseTrait;

    public function index() {
        
        $data = $this->request->getPostGet();
        log_message('error',  '{message}', ['message' => serialize($data)]);
        
        $response = new VoiceResponse();
        $response->dial('+19205075671', [
            'action' => '/calls-to-crm',
            'method' => 'POST',
            'recordingStatusCallbackEvent' => 'completed',
        ]);
        $response->say('I am unreachable');

        $this->response->setStatusCode(200)
                ->setContentType('application/xml')
                ->setBody($response)
                ->send();
    }

}
