<?php

namespace App\Controllers\Billings;

use App\Controllers\Billings\BaseController;
use App\Models\Invoices as InvoicesModel; 
use CodeIgniter\I18n\Time;

class Invoices extends BaseController 
{
   
    public function view(int $id)
    {
        
    }
    
    public function show(string $slug) : string
    {
        $model = new InvoicesModel();
        $item = $model->where('slug', $slug)
                ->select('invoices.*, billings.*, currencies.*, users.*, invoices.id as invice_number, ')
                ->join('billings', 'billings.id = invoices.billing_id', 'left')
                ->join('currencies', 'currencies.id = billings.currency_id', 'left')
                ->join('users', 'users.id = billings.client_id', 'left')
                ->first();
        return view('invoices/show', ['item' => $item]);
    }
    
    public function form()
    {
        $gateway = $this->request->getPost('gateway');
        if(!$gateway){
            $gateway = 'authorize';
        }
        $invoice = service('billings', $gateway);
        return $invoice->form();
    }

    public function pay()
    {
        $pay = $this->request->getPost();
        $invoice = service('billings', $pay['gateway']);
        if(!$this->validate($invoice->rules($pay['method']))){
            return $this->response->setJSON([
                'result' => false,
                'status' => 'error',
                'messages' => $this->validator->getErrors() 
            ]);
        }
        try{
            $resp = $invoice->pay($pay['method'], $pay);
            $fresp = $resp->formatResponce();
            // get the current invoice
            $model = new InvoicesModel();
            $cinvoice = $model->find($pay['invice_number']);
            $cinvoice->status = $fresp['status'];
            $cinvoice->driver = $pay['gateway'];
            $cinvoice->method = $pay['method'];
            $cinvoice->payment_log = json_encode(array_merge(json_decode($cinvoice->payment_log, true) ?? [], [Time::now()->toDateTimeString() => ['resp' => (array)$fresp, 'gateway' => $pay['gateway'], 'method' => $pay['method']]]));
            $model->save($cinvoice);
            return $this->response->setJSON($fresp);
        } catch (Exception $e) {
            return $this->response->setJSON($e);
        }
    }
    
    public function check()
    {
        
    }
}
