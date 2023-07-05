<?php

namespace App\Controllers\Billings;

use App\Controllers\Billings\BaseController;
use App\Models\Billings as BillingsModel;
use App\Models\Currencies as CurrenciesModel;
use App\Models\Invoices as InvoicesModel;
use CodeIgniter\Shield\Entities\User as UserEntity;
use CodeIgniter\Shield\Models\UserIdentityModel;
use App\Models\Users as UsersModel;
use CodeIgniter\I18n\Time;

class Billings extends BaseController 
{
    public function index() : string
    {
        $model = new BillingsModel();
        $items = $model->select('*')
                ->join('users', 'billings.client_id = users.id', 'inner')
                ->paginate();
        $pager = $model->pager;
        return view('billings/index', compact('items', 'pager'));
    }

    public function new() : string
    {
        $currencitesModel = new CurrenciesModel();
        $billingModel = new BillingsModel();
        $currencies = $currencitesModel->getList();
        $pariods = $billingModel->periodList();
        return view('billings/new', compact('currencies', 'pariods'));
    }

    /**
     * create billing and invoices
     * @return object
     */
    public function create() : object
    {
        $userIdentityModel = new UserIdentityModel();
        if(!$userIdentity = $userIdentityModel->getIdentityBySecret('email_password', $this->request->getPost('email'))){
            // create user
            $userModel = new UsersModel();
            $userEntity = new UserEntity([
                'username' => $this->request->getPost('full_name'),
                'full_name' => $this->request->getPost('full_name'),
                'phone' => $this->request->getPost('phone'),
            ]);
            $userModel->save($userEntity);
            $userIdentity = $userModel->findById($userModel->getInsertID());
            $userIdentity->createEmailIdentity([
                'email' => $this->request->getPost('email'),
                'password' => substr(str_shuffle(MD5(microtime())), 0, 10),
            ]);
            $userIdentity->addGroup('client');
        }
        // create billing
        $billingsModel = new BillingsModel();
        $billingsModel->insert([
            'client_id' => $userIdentity->id,
            'currency_id' => $this->request->getPost('currency_id'),
            'summ' => $this->request->getPost('summ'),
            'status' => 'active',
            'period' => $this->request->getPost('period'),
            'date_start' => $this->request->getPost('date_start'),
            'date_end' => $this->request->getPost('date_end'),
        ]);
        // create invoices
        $date_start = Time::parse($this->request->getPost('date_start'));
        $date_end = Time::parse($this->request->getPost('date_end'));
        $interval = \DateInterval::createFromDateString($this->request->getPost('period'));
        $periods = new \DatePeriod($date_start, $interval, $date_end);
        $invoicesModel = new InvoicesModel();
        helper('text');
        foreach($periods as $period){
            $invoicesModel->insert([
                'billing_id' => $billingsModel->getInsertID(),
                'summ' => $this->request->getPost('summ') / iterator_count($periods),
                'status' => 'new',
                'payment_at' => $period->format('Y-m-d H:i:s'),
                'slug' => random_string('alnum', 28),
            ]);
        }
        return redirect()->route('billings_list')->with('message', lang('Messages.Currencies.Switched'));
    }
    
    public function view(int $id) : string
    {
        $billingsModel = new BillingsModel();
        $item = $billingsModel->find($id);
//        dd($item);
        return view('billings/view', ['item' => $item->withInvoices()]);
    }
}
