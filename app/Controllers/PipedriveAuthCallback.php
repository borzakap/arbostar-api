<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Pipedrive;

class PipedriveAuthCallback extends BaseController {

    public function index() {
        //reouth pipedrive with the outhtoken
        $pipedrive_conf = config('Pipedrive');
        $this->pipedrive = new Pipedrive\Client($pipedrive_conf->oAuthClientId, $pipedrive_conf->oAuthClientSecret, $pipedrive_conf->oAuthRedirectUri);

        // callback stores token for reuse when token is updated
        Pipedrive\Configuration::$oAuthTokenUpdateCallback = function ($token) {
            cache()->save("pipe_drive_oath_token", $token, 0);
        };

        if (!$this->request->getGet('code')) {
            // if authorization code is absent, redirect to authorization page
            $authUrl = $this->pipedrive->auth()->buildAuthorizationUrl();
            return redirect()->to(filter_var($authUrl, FILTER_SANITIZE_URL));
        } else {
            try {
                // authorize client (calls token update callback as well)
                $token = $this->pipedrive->auth()->authorize($this->request->getGet('code'));

                // resume user activity
                $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
                return redirect()->to(filter_var($redirect_uri, FILTER_SANITIZE_URL));
            } catch (Pipedrive\Exceptions\OAuthProviderException $ex) {
                print_r($ex);
            }
        }
    }
}
