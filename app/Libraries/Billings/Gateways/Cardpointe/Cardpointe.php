<?php

namespace App\Libraries\Billings\Gateways\Cardpointe;

use App\Libraries\Billings\Base\BillingsBase;
use App\Libraries\Billings\Gateways\Cardpointe\Config as CardpointeConfig;

/**
 * Description of Cardpointe
 *
 * @author alexey
 */
class Cardpointe extends BillingsBase
{
    protected $config;

    protected $client;
    
    public function __construct() {
        $this->config = config(CardpointeConfig::class);
        $this->client = \Config\Services::curlrequest([
                    'baseURI' => "https://{$this->config->auth['cp_site']}.cardconnect.com/cardconnect/rest/",
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($this->config->auth['cp_user'] . ':' . $this->config->auth['cp_pass']),
                    ],
        ]);
    }

    protected function ach(array $data)
    {
        try {
            $resp = $this->client->post('auth', [
                'json' => [
                    'merchid' => '496160873888',
                    'amount' => $this->amount,
                    'account' => $data['routing number'].'/'.$data['account number'],
                    'ecomind' => 'E', // SEC code WEB for an Internet or mobile payment.
                    'accttype' => $data['account_type'], // testing ECHK
                    'capture' => 'y',
                ],
            ]);
            
        } catch (Exception $e) {

        }
    }
}
