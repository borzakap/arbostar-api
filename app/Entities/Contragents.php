<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ContragentsConditions as ContragentsConditionsModel;
use App\Models\Deals as DealsModel;
use App\Models\Payments as PaymentsModel;

class Contragents extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    // conditions
    protected $conditions;
    // dealst count monthly
    protected $deals_monthly = [];
    // payments sum nothly
    protected $payments_monthly = [];
    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';

    /**
     * find the conditions for contragent
     * @return self
     * @throws \RuntimeException
     */
    public function withConditions() : self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Entity must be created before getting conditions.');
        }
        if(empty($this->conditions)){
            $model = new ContragentsConditionsModel();
            $this->conditions = $model->where('contragent_id', $this->id)->findAll();
        }
        return $this;
    }
    
    /**
     * get the conditions of contragent
     * @return array|null
     */
    public function getConditions(): ?array
    {
        return $this->conditions;
    }

    /**
     * find the deals count monthly
     * @param string $date_start
     * @param string $date_end
     * @return self
     * @throws \RuntimeException
     */
    public function withDealsMonthly(string $date_start, string $date_end): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Entity must be created before getting deals.');
        }
        $model = new DealsModel();
        $this->deals_monthly = $model->select('DATE_FORMAT(added_at, "%m-%Y") AS added_month, COUNT(id) AS all_count')
                ->where('added_at >=', $date_start)
                ->where('added_at <=', $date_end)
                ->where('contragent_id', $this->id)
                ->groupBy('MONTH(added_at)')
                ->groupBy('YEAR(added_at)')
                ->orderBy('added_at', 'DESC')
                ->find();
        return $this;
    }

    /**
     * get deals_monthly
     * @return array|null
     */
    public function getDealsMonthly(): ?array
    {
        return $this->deals_monthly;
    }

    /**
     * find payments by months
     * @param string $date_start
     * @param string $date_end
     * @return self
     * @throws \RuntimeException
     */
    public function withPaymentsMonthly(string $date_start, string $date_end): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Entity must be created before getting paymens.');
        }
        $model = new PaymentsModel();
        $this->payments_monthly = $model->select('DATE_FORMAT(payment_at, "%m-%Y") AS added_month, SUM(converted_to_usd) AS all_sum')
                ->where('payment_at >=', $date_start)
                ->where('payment_at <=', $date_end)
                ->where('contragent_id', $this->id)
                ->groupBy('MONTH(payment_at)')
                ->groupBy('YEAR(payment_at)')
                ->orderBy('payment_at', 'DESC')
                ->find();
        return $this;
    }
    
    /**
     * get payments_monthly
     * @return array|null
     */
    public function getPaymentsMonthly(): ?array
    {
        return $this->payments_monthly;
    }
    
    /**
     * get delete link
     * @return string
     */
    public function getUpdateLink() : string
    {
        if(!$this->update_link){
            $this->update_link = anchor(['contragents', 'update', $this->id], '<i class="fas fa-pen"></i>');
        }
        return $this->update_link;
    }
}
