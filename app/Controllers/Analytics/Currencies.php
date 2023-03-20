<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Currencies as CurrenciesModel;

class Currencies extends BaseController
{
    /**
     * get list
     * @return string
     */
    public function index() : string
    {
        $model = new CurrenciesModel();
        $data = [
            'items' => $model->orderBy('in_use', 'DESC')->orderBy('iso', 'ASC')->paginate(),
            'pager' => $model->pager,
        ];
        return view('currencies/index', $data);
    }
    
    /**
     * switch in use
     * @param int $id
     * @param int $in_use
     * @return type
     */
    public function switch(int $id)
    {
        $model = new CurrenciesModel();
        $data = $model->find($id);
        $status = ($data->in_use == $model::IN_USE) ? $model::NOT_IN_USE : $model::IN_USE; 
        if(false == $model->update($id, ['in_use' => $status])){
            return redirect()->back()->with('errors', $model->errors());
        }
        return redirect()->route('currentcies_list')->with('message', lang('Messages.Currencies.Switched'));
    }
}
