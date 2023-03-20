<?php

namespace App\Controllers\Analytics;

use App\Controllers\Analytics\BaseController;
use App\Models\Deals as DealsModel;

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
    
}
