<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Stages as StagesEntity;
use \CodeIgniter\I18n\Time;

class Stages extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = StagesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['deal_id', 'stage_id', 'order_nr', 'name', 'stage_change_time'];

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
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * get deals count by stages & by months
     * @param Time $date_start
     * @param Time $date_end
     * @return array
     */
    public function getCountDealsByStages(Time $date_start, Time $date_end, ?int $contragent_id) : array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stages s1');
        $builder->select('s1.stage_id, s1.name, COUNT(s2.deal_id) AS deals, DATE_FORMAT(s1.stage_change_time, "%m-%Y") AS month');
        $subbuilder = $db->table('stages')
                ->select('MAX(stage_id) AS stage_max, deal_id')
                ->where('stage_change_time >=', $date_start->toDateTimeString())
                ->where('stage_change_time <=', $date_end->toDateTimeString())
                ->groupBy('deal_id')
                ->getCompiledSelect();
        $builder->join('('.$subbuilder.') `s2`', "s1.stage_id = s2.stage_max AND s1.deal_id = s2.deal_id", "inner");
        $builder->groupBy('MONTH(s1.stage_change_time)');
        $builder->groupBy('YEAR(s1.stage_change_time)');
        $builder->groupBy('s1.stage_id');
        $builder->orderBy('s1.stage_change_time', 'DESC');
        $builder->orderBy('s1.stage_id', 'DESC');
        return $builder->get()->getResult();
    }
}
