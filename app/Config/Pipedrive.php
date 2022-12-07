<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pipedrive extends BaseConfig{
    
    /**
     * pipedrive api token
     * @var string
     */
    public $apiToken = 'd046f6ccd8a86ba7ba7a8abedb0dd33e219d48d2';
    
    /**
     * pipedrive oauth client id 
     * @var string
     */
    public $oAuthClientId = '468b29bb703fcea3';
    
    /**
     * pipedrive oauth clitnt secret
     * @var string
     */
    public $oAuthClientSecret = '7ef5ce46171286aea34451629b7bd1416e482c7d';
    
    /**
     * pipedrive oauth redierct url
     * @var string
     */
    public $oAuthRedirectUri = 'https://9e3e-95-158-20-237.eu.ngrok.io/pipedrive-oauth-callback';

}
