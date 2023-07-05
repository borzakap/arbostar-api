<?php

namespace App\Libraries\Billings\Gateways\Authorize;

use CodeIgniter\Config\BaseConfig;

/**
 * Description of Config
 *
 * @author alexey
 */
class Config extends BaseConfig{
    
    public array $auth = [
        'merchantLoginId'  => '3MzQrq5D8H',
        'merchantTransactionKey' => '53NC95t5D7TwsU4c',
        'publicKey' => 'SIMON',
    ];
    
    public array $rules = [
        'ach' => [
            'account_number' => 'required|max_length[17]',
            'name_on_account' => 'required|max_length[22]',
            'bank_name' => 'required|max_length[50]',
            'routing_number' => 'required|max_length[9]',
        ],
    ];
    
    public array $views = [
        'ach' => 'App\Libraries\Billings\Gateways\Authorize\Views\achForm',
    ];
    
}
