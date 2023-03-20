<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Contragents as ContragentsEntity;

class Contragents extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'contragents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = ContragentsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

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
    protected $beforeInsert   = [];
    protected $afterInsert    = ['deleteCaches'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['deleteCaches'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['deleteCaches'];
    

    /**
     * get list of contragents
     * @return array
     */
    public function getList() : array
    {
        if (!$found = cache("contragents_list")) {
            $found = [0 => lang('Forms.Fields.Select')];
            $items = $this->findAll();
            foreach ($items as $item) {
                $found[$item->id] = $item->name;
            }
            cache()->save("contragents_list", $found, 0);
        }
        return $found;
    }

    /**
     * delete caches in callbacks
     * @param array $data
     * @return array
     */
    protected function deleteCaches(array $data): array {
        cache()->delete("contragents_list");
        return $data;
    }

}
