<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\Currencies as CurrenciesModel;

class Payments extends Entity
{
    protected $datamap = [];
    protected $dates   = ['payment_at', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';
    
    /**
     * get delete link
     * @return string
     */
    public function getDeleteLink() : string
    {
        if(!$this->delete_link){
            $this->delete_link = anchor(['payments', 'delete', $this->id], '<i class="fas fa-trash"></i>');
        }
        return $this->delete_link;
    }
    
    /**
     * get delete link
     * @return string
     */
    public function getUpdateLink() : string
    {
        if(!$this->update_link){
            $this->update_link = anchor(['payments', 'update', $this->id], '<i class="fas fa-pen"></i>');
        }
        return $this->update_link;
    }
}
