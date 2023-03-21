<?php

namespace App\Controllers\Analytics;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\Deals as DealsModel;
use App\Models\Contragents as ContragentsModel;
use App\Models\Payments as PaymentsModel;

use App\Models\ContragentsConditions as ContragentsConditionsModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $model = new ContragentsConditionsModel();
        $data = [
            'referral' => 'php.net',
            'utm_source' => 'capterra',
            'utm_medium' => 'null',
            'utm_campaign' => '',
            'utm_content' => '',
            'utm_term' => '',
            'dump' => 'clik',
        ];
        $reurn = $model->findContragent($data);
//        dd($reurn);
        return view('dashboard/index', $data);
    }
    
    public function contragentsEffectivnes() : string
    {
        helper('form');
        $time = new Time('now');
        $get = $this->request->getGet();
        $date_start = isset($get['date_start']) ? 
                Time::parse($get['date_start']) : 
                $time->subMonths(6)->modify('first day of this month');
        $date_end = isset($get['date_end']) ? 
                Time::parse($get['date_end']) : 
                $time->modify('last day of this month');

        $interval = \DateInterval::createFromDateString('1 month');
        $periods   = new \DatePeriod($date_start, $interval, $date_end);
//        dd($periods);
        $contragentsModel = new ContragentsModel();
        $contragents = $contragentsModel->findAll();
        $data = [
            'periods' => $periods,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'contragents' => $contragents,
            'deals' => [],
            'payments' => [],
        ];
        return view('dashboard/contragents_effectivnes', $data);
    }
}
