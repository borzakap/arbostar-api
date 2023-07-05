<?php

namespace App\Libraries\Billings\Base;

/**
 * Description of Payment
 *
 * @author alexey
 */
class BillingsBase {
    
    protected $config;
    
    protected $client;

    protected $responce;
    
    const APPROVED = 'appruved';

    const DECLINED = 'declined';
    
    const ERROR = 'error';
    
    const REVIEW = 'review';

    /**
     * upload the form
     * @param string $method
     * @param array $data
     * @return string|null
     */
    public function form(string $method = 'ach', array $data = []): ?string {
        return isset($this->config->views[$method]) ? view($this->config->views[$method], $data) : null;
    }

    /**
     * Upload rules
     * @param string $method
     * @return array|null
     */
    public function rules(string $method = 'ach'): ?array {
        return $this->config->rules[$method] ?? [];
    }

    /**
     * Call the payment method
     * @param string $method
     * @param array $data
     * @return self
     */
    public function pay(string $method = 'ach', array $data = []): self {
        if(method_exists($this, $method)){
            return $this->{$method}($data);
        }else{
            throw new \Exception("Method {$method} not defined");
        }
    }

    /**
     * chack the payment/transaction status
     * @return void
     * @throws \Exception
     */
    public function check(): void 
    {
        throw new \Exception("Method check not defined");
    }
    /**
     * format responce
     * @return object|null
     * @throws \Exception
     */
    public function formatResponce(): ?array
    {
        throw new \Exception("Method formatResponce not defined");
    }
}
