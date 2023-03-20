<?php

namespace App\Controllers;

use Pipedrive;
/**
 * Description of Test
 *
 * @author alexey
 */
class Test extends BaseController{
    
    public function index()
    {
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
        $pipedrive_user = $this->pipedrive->getUsers()->getCurrentUserData();
        print_r($pipedrive_user);
        die();
    }
    
    public function log(){
        $log = $this->request->getJSON(true);
        log_message('info', '[hook]{hook}', ['hook' => print_r($log, true)]);
    }
}
