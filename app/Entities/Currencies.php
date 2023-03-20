<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Currencies extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    protected $switch_link;
    
    public function getSwitchLink() : ?string
    {
        if(!$this->switch_link){
            $icon = $this->in_use ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-stop-circle"></i>';
            $this->switch_link = anchor(['currencies', 'switch', $this->id], $icon);
        }
        return $this->switch_link;
    }
}
