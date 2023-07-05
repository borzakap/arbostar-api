<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Invoices extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'payment_at', 
        'created_at', 
        'updated_at', 
        'deleted_at',
    ];
    protected $casts   = [
        'payment_log' => 'json-array',
    ];
}
