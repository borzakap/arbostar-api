<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\ContragentsConditions as ContragentsConditionsModel;
use App\Entities\ContragentsConditions as ContragentsConditionsEntity;

class ContragentsCondigions extends BaseController
{
   
    public function insert()
    {
        $model = new ContragentsConditionsModel();
        $condititon = new ContragentsConditionsEntity($this->request->getPost());
        if ($model->save($condititon)) {
            return redirect()->route('contragents_update', [$condititon->contragent_id])->with('message', lang('Messages.Submited'));
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
    
    /**
     * delete condition
     * @param int $id
     * @return type
     */
    public function delete(int $id){
        $model = new ContragentsConditionsModel();
        if(false == $model->delete($id)){
            return redirect()->back()->with('errors', $model->errors());
        }
        return redirect()->back()->with('message', lang('Messages.Deleted'));
    }
}
