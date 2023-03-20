<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Contragents as ContragentsModel;
use App\Models\ContragentsConditions as ContragentsConditionsModel;

class Contragents extends BaseController
{
    
    /**
     * get list
     * @return string
     */
    public function index() : string
    {
        $model = new ContragentsModel();
        $data = [
            'items' => $model->paginate(),
            'pager' => $model->pager,
        ];
        return view('contragents/index', $data);
    }
    
    /**
     * insert contragent
     * @return type
     */
    public function insert()
    {
        if($this->request->getMethod() != 'post'){
            $data = [];
            return view('contragents/insert', $data);
        }
        $model = new ContragentsModel();
        if (($id = $model->insert($this->request->getPost()))) {
            return redirect()->route('contragents_update', [$id])->with('message', lang('Messages.Submited'));
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }

    /**
     * update contragent
     * @param int $id
     * @return type
     */
    public function update(int $id)
    {
        $model = new ContragentsModel();
        $modelConditions = new ContragentsConditionsModel();
        $item = $model->find($id);
        if ($this->request->getMethod() !== 'post') {
            $data = [
                'fields' => $modelConditions->fieldsName(),
                'item' => $item->withConditions(),
            ];
            return view('contragents/update', $data);
        }
        if ($model->update($id, $this->request->getPost())) {
            return redirect()->route('contragents_update', [$id])->with('message', lang('Messages.Submited'));
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
    
}
