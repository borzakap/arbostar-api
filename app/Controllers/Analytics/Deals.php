<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Deals as DealsModel;
use App\Models\ContragentsConditions as ContragentsConditionsModel;

class Deals extends BaseController
{
    /**
     * get list
     * @return string
     */
    public function index() : string
    {
        $model = new DealsModel();
        $data = [
            'items' => $model->select('deals.*, contragents.name as contragent')
                ->orderBy('added_at', 'DESC')
                ->join('contragents', 'contragents.id = deals.contragent_id', 'left')
                ->paginate(),
            'pager' => $model->pager,
        ];
        return view('deals/index', $data);
    }

    /**
     * view the deal details
     * @param int $id
     * @return string
     */
    public function view(int $id) : string
    {
        $model = new DealsModel();
        $data = [
            'item' => $model->find($id)->withStages(),
        ];
        return view('deals/view', $data);
    }

    /**
     * find contragent for deal
     * @param int $id
     * @return type
     */
    public function findContragent(int $id){
        $model = new DealsModel();
        $deal = $model->asArray()->find($id);
        $contragentsConditionsModel = new ContragentsConditionsModel();
        if(($contragent = $contragentsConditionsModel->findContragent($deal))){
            if($model->update($id, ['contragent_id' => $contragent->contragent_id])){
                return redirect()->back()->withInput()->with('message', lang('Messages.ContragentUpdated'));
            }
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
        return redirect()->back()->withInput()->with('message', lang('Messages.CantFindContragent'));
    }
}
