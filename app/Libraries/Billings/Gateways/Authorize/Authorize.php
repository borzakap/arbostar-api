<?php

namespace App\Libraries\Billings\Gateways\Authorize;

use App\Libraries\Billings\Base\BillingsBase;
use App\Libraries\Billings\Gateways\Authorize\Config as AuthorizeConfig;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

/**
 * Description of Authorize
 *
 * @author alexey
 */
class Authorize extends BillingsBase
{
    protected $config;
    
    protected $client;
    
    protected $responce;
    
    const RESPONSE_APPROVED = 1;
    
    const RESPONSE_DECLINED = 2;
    
    const RESPONSE_ERROR = 3;
    
    const RESPONSE_REVIEW = 4;

    public function __construct() {
        $this->config = config(AuthorizeConfig::class);
        $this->client = new AnetAPI\MerchantAuthenticationType();
        $this->client->setName($this->config->auth['merchantLoginId']);
        $this->client->setTransactionKey($this->config->auth['merchantTransactionKey']);
    }

    protected function ach(array $post)
    {
        // Set the transaction's refId
        $refId = 'ref' . time();
        // Create the payment data for a Bank Account
        $bankAccount = new AnetAPI\BankAccountType();
        $bankAccount->setAccountType('checking');
        // see eCheck documentation for proper echeck type to use for each situation
        $bankAccount->setEcheckType('WEB');
        $bankAccount->setRoutingNumber($post['routing_number']);
        $bankAccount->setAccountNumber($post['account_number']);
        $bankAccount->setNameOnAccount($post['name_on_account']);
        $bankAccount->setBankName($post['bank_name']);

        $paymentBank = new AnetAPI\PaymentType();
        $paymentBank->setBankAccount($bankAccount);
        // Order info
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($post['invice_number']);
        $order->setDescription($post['invice_desctiption']);
        //create a bank debit transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($post['sum']);
        $transactionRequestType->setPayment($paymentBank);
        $transactionRequestType->setOrder($order);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($this->client);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $this->response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        return $this;
    }
    
    public function formatResponce(): ?array {
        $result = ['result' => false];
        if (!$this->response) {
            $result['messages'] = ['common' => 'Empty responce'];
            return $result;
        }
        
        $tresponse = $this->response->getTransactionResponse();
        
        switch ($tresponse->getResponseCode()) {
            case self::RESPONSE_APPROVED:
                $result['status'] = self::APPROVED;
                break;

            case self::RESPONSE_DECLINED:
                $result['status'] = self::DECLINED;
                break;
            
            case self::RESPONSE_ERROR:
                $result['status'] = self::ERROR;
                break;

            case self::RESPONSE_REVIEW:
                $result['status'] = self::REVIEW;
                break;
            
            default:
                break;
        }

        if(!$tresponse){
            $result['messages'] = ['common' => 'Empty data about transaction'];
            return $result;
        }
        
        $terrors = $tresponse->getErrors();
        
        if(!empty($terrors)){
            $errors = [];
            foreach ($terrors as $error){
                $errors[] = $error->getErrorText();
            }
            $result['messages']['common'] = $errors;
            return $result;
        }
        
        $result['result'] = true;
        $result['response_code'] = $tresponse->getResponseCode();
        $result['auth_code'] = $tresponse->getAuthCode();
        $result['trans_id'] = $tresponse->getTransId();
        $description = [];
        foreach ($tresponse->getMessages() as $message){
            $description[] = $message->getDescription();
        }
        $result['messages'] = $description;
        
        return $result;
    }
}
