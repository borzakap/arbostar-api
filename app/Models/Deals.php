<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Deals as DealsEntity;
use App\Models\ContragentsConditions as ContragentsConditionsModel;

class Deals extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'deals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = DealsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'referral', 'utm_source', 'utm_medium',
        'utm_campaign', 'utm_content', 'utm_term', 'contragent_id', 'status', 
        'added_at', 'stage_id', 'stage_order_nr', 'stage_change_time'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['findContragent'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['findContragent'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * detect the contragent_id for deal
     * @param array|null $data
     * @return array
     */
    protected function findContragent(?array $data) : array
    {
        // detect if insert or update
        $inner_data = (isset($data['id'])) ? $data['data'] : $data;
        $contragentsConditionsModel = new ContragentsConditionsModel();
        if(($contragent = $contragentsConditionsModel->findContragent($inner_data))){
            if(isset($data['id'])){
                $data['data']['contragent_id'] = $contragent->contragent_id;
            }else{
                $data['contragent_id'] = $contragent->contragent_id;
            }
        }
        return $data;
    }
}
