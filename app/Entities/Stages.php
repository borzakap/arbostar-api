<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Stages extends Entity
{
    protected $datamap = [];
    protected $dates   = ['stage_change_time', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
