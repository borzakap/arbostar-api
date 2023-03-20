<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\ContragentsConditions as ContragentsConditionsEntity;

class ContragentsConditions extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'contragents_conditions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = ContragentsConditionsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['contragent_id', 'field_name', 'field_value'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'field_name' => 'required',
        'field_value' => 'required|is_unique_three[contragents_conditions.field_value,field_name,{field_name},contragent_id,{contragent_id}]'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    const FIELD_REFFERAL = 'referral';
    const FIELD_SOURCE = 'utm_source';
    const FIELD_MEDIUM = 'utm_medium';
    const FIELD_COMPAIGN = 'utm_campaign';
    const FIELD_CONTENT = 'utm_content';
    const FIELD_TERM = 'utm_term';
    
    public function fieldsName() : array
    {
        return [
            self::FIELD_REFFERAL => lang('Forms.Fields.Referral'),
            self::FIELD_SOURCE => lang('Forms.Fields.Source'),
            self::FIELD_MEDIUM => lang('Forms.Fields.Medium'),
            self::FIELD_COMPAIGN => lang('Forms.Fields.Campaign'),
            self::FIELD_CONTENT => lang('Forms.Fields.Content'),
            self::FIELD_TERM => lang('Forms.Fields.Term'),
        ];
    }
    
    /**
     * find contragent_id by conditions array
     * @param array|null $data
     * @return object|null
     */
    public function findContragent(?array $data) : ?object
    {
        $fields = array_keys($this->fieldsName());
        foreach ($data as $k => $d){
            if(!in_array($k, $fields)){
                unset($data[$k]);
            }
        }
        // remove empty values https://stackoverflow.com/a/3654309
        $values = array_filter($data, fn($value) => !is_null($value) && $value !== '');
        if(!empty($values)){
            $find = $this->select('contragent_id');
            foreach ($values as $n => $v){
                $find->having("SUM(field_name = '{$n}' AND field_value = '{$v}') > 0");
            }
            return $find->groupBy('contragent_id')->first();
        }
        return null;
    }
}
