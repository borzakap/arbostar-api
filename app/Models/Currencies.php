<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Currencies as CurrenciesEntity;

class Currencies extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'currencies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = CurrenciesEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['iso', 'in_use', 'name'];

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
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['deleteCaches'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    const IN_USE = 1;
    const NOT_IN_USE = null;
    
    public function getList() : array
    {
        if (!$found = cache("currencies_list")) {
            $found = [0 => lang('Forms.Fields.Select')];
            $items = $this->where('in_use', self::IN_USE)->find();
            foreach ($items as $item) {
                $found[$item->id] = $item->iso . '(' . $item->name . ')';
            }
            cache()->save("currencies_list", $found, 0);
        }
        return $found;
    }

    /**
     * delete caches in callbacks
     * @param array $data
     * @return array
     */
    protected function deleteCaches(array $data): array {
        cache()->delete("currencies_list");
        return $data;
    }
}
