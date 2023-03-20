<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Payments as PaymentsModel;
use App\Models\Contragents as ContragentsModel;
use App\Models\Currencies as CurrenciesModel;
use App\Entities\Payments as PaymentsEntity;

class Payments extends BaseController
{
    /**
     * get payments list
     * @return string
     */
    public function index() : string
    {
        $model = new PaymentsModel();
        $contragentModel = new ContragentsModel();
        $items = $model->select('payments.*, contragents.name as contragent_name, currencies.iso as currency_iso')
                ->join('contragents', 'contragents.id = payments.contragent_id', 'inner')
                ->join('currencies', 'currencies.id = payments.currency_id', 'inner');
        $filter = $this->request->getGet();
        if($filter['contragent_id'] ?? null){
            $items->where('payments.contragent_id', (int)$filter['contragent_id']);
        }
        if($filter['date_start'] ?? null){
            $items->where('payments.payment_at >=', $filter['date_start']);
        }
        if($filter['date_end'] ?? null){
            $items->where('payments.payment_at <=', $filter['date_end']);
        }
        $items->orderBy('payments.payment_at', 'DESC');
        $data = [
            'filter' => $filter,
            'contragents' => $contragentModel->getList(),
            'items' => $items->paginate(),
            'pager' => $model->pager,
        ];
        return view('payments/index', $data);
    }

    /**
     * insert payment
     * @return type
     */
    public function insert()
    {
        if($this->request->getMethod() != 'post'){
            $contragentModel = new ContragentsModel();
            $currencitesModel = new CurrenciesModel();
            $data = [
                'currencites' => $currencitesModel->getList(),
                'contragents' => $contragentModel->getList(),
            ];
            return view('payments/insert', $data);
        }
        $model = new PaymentsModel();
        $entity = new PaymentsEntity($this->request->getPost());
        if (($id = $model->save($entity))) {
            return redirect()->route('payments_update', [$id])->with('message', lang('Messages.Submited'));
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
    
    /**
     * update payment
     * @param int $id
     * @return type
     */
    public function update(int $id)
    {
        $model = new PaymentsModel();
        $contragentModel = new ContragentsModel();
        $currencitesModel = new CurrenciesModel();
        $item = $model->find($id);
        if ($this->request->getMethod() !== 'post') {
            $data = [
                'currencites' => $currencitesModel->getList(),
                'contragents' => $contragentModel->getList(),
                'item' => $item,
            ];
            return view('payments/update', $data);
        }
        if ($model->update($id, $this->request->getPost())) {
            return redirect()->route('payments_update', [$id])->with('message', lang('Messages.Submited'));
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
    
    /**
     * delete payment
     * @param int $id
     * @return type
     */
    public function delete(int $id)
    {
        $model = new PaymentsModel();
        if(false == $model->delete($id)){
            return redirect()->back()->with('errors', $model->errors());
        }
        return redirect()->back()->with('message', lang('Messages.Deleted'));
    }
}
