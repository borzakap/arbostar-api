<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Payments as PaymentsEntity;
use App\Models\Currencies as CurrenciesModel;
use CodeIgniter\I18n\Time;

class Payments extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = PaymentsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['summ', 'converted_to_usd', 'currency_id', 'contragent_id', 'payment_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['convertToUsd'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['convertToUsd'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    protected function convertToUsd(?array $data) : array
    {
        if(!isset($data['data']['payment_at'])){
            return $data;
        }
        $date = new Time($data['data']['payment_at']);
        $currenciesModel = new CurrenciesModel();
        $simbol = $currenciesModel->find($data['data']['currency_id']);
        $access_key = 'rONc726IJKiazCrxhO9x39WxBOS4cfg4';
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'https://api.apilayer.com/fixer/' . $date->toDateString(), [
            'headers' => ['apikey' => $access_key],
            'query' => ['base' => 'USD', 'symbols' => $simbol->iso],
        ]);
        $body = $response->getBody();
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($body);
            if($body->success){
                $converted_to_usd = (float)$data['data']['summ'] / (float)$body->rates->{$simbol->iso};
                $this->update($data['id'], ['converted_to_usd' => $converted_to_usd]);
            }
        }
        return $data;
    }
}
