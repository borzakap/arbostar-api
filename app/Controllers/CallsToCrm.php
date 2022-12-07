<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Twilio\TwiML\VoiceResponse;
use CodeIgniter\API\ResponseTrait;

class CallsToCrm extends BaseController {
    
    use ResponseTrait;

    public function index() {
        $response_service = $this->request->getPost();
        log_message('error', '{message}', ['message' => serialize($response_service)]);
        $response = new VoiceResponse;
        $response->say("This is the test message!", array('voice' => 'alice'));
        $this->response->setStatusCode(200)
                ->setContentType('application/xml')
                ->setBody($response)
                ->send();
    }

}
