<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ContragentsConditions extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    protected $delete_link;
    
    /**
     * get delete link
     * @return string
     */
    public function getDeleteLink() : string
    {
        if(!$this->delete_link){
            $this->delete_link = anchor(['conditions', 'delete', $this->id], '<i class="fas fa-trash"></i>');
        }
        return $this->delete_link;
    }
    
    /**
     * get oly domains name from url
     * @param string|null $field_value
     * @return self
     */
    public function setFieldValue(?string $field_value) : self
    {
        if(filter_var($field_value, FILTER_VALIDATE_URL)){
            $this->attributes['field_value'] = str_ireplace('www.', '', parse_url($field_value, PHP_URL_HOST));
        }else{
            $this->attributes['field_value'] = trim($field_value);
        }
        return $this;
    }
}
