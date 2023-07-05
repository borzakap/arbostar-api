<?php

namespace App\Libraries\Billings\Gateways\Cardpointe;

use CodeIgniter\Config\BaseConfig;

/**
 * Description of Config
 *
 * @author alexey
 */
class Config extends BaseConfig{
    
    public array $auth = [
        'cp_site'  => '',
        'cp_user' => '',
        'cp_pass' => '',
    ];
    
    public array $rules = [
        'ach' => [
            
        ],
    ];
    
    public array $views = [
        'ach' => 'App\Libraries\Billings\Gateways\Cardpointe\Views\achForm',
    ];
    
}
