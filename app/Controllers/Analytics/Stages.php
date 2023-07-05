<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Stages as StagesModel;

/**
 * Description of Stages
 *
 * @author alexey
 */
class Stages extends BaseController
{
    /**
     * delete the stages
     * @param int $id
     * @return type
     */
    public function delete(int $id){
        $model = new StagesModel();
        if(false == $model->delete($id)){
            return redirect()->back()->with('errors', $model->errors());
        }
        return redirect()->back()->with('message', lang('Messages.Deleted'));
    }

}
