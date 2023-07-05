<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\Invoices as InvoicesModel;

class Billings extends Entity
{
    protected $datamap = [];
    protected $dates = [
        'created_at', 
        'updated_at', 
        'deleted_at',
        'date_start',
        'date_end',
        ];
    protected $casts   = [];
    
    protected $invoices;
    
    protected $view_link;


    /**
     * find the invoices of billing
     * @return self
     * @throws \RuntimeException
     */
    public function withInvoices(): self {
        if (empty($this->id)) {
            throw new \RuntimeException('Entity must be created before getting conditions.');
        }
        if (empty($this->invoices)) {
            $model = new InvoicesModel();
            $this->invoices = $model->where('billing_id', $this->id)->findAll();
        }
        return $this;
    }

    /**
     * get the invoices of billing
     * @return array|null
     */
    public function getInvoices(): ?array {
        return $this->invoices;
    }
    
    public function getViewLink(): string {
        if (!$this->view_link) {
            $this->view_link = anchor(['billings', 'view', $this->id], '<i class="fas fa-pen"></i>');
        }
        return $this->view_link;
    }
}
