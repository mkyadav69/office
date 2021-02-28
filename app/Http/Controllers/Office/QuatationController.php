<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Customer;
use Carbon\Carbon;
use DataTables;
use Config;

class QuatationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showQuatation(){
        $notify = Notify::get();
        return view('office.quatation.show_quatation', compact('notify'));
    }
    public function addQuatation(){
        $notify = Notify::get();
        $company = Customer::get();
        $currency = Config::get('constant.currency');
        $payment_term = Config::get('constant.payment_term');
        if(!empty($notify)){
            $notify = collect($notify)->pluck('name', 'id')->toArray();
        }else{
            $notify = '';
        }
        if(!empty($company)){
            $company = collect($company)->pluck('st_com_name', 'in_cust_id')->toArray();
        }else{
            $company = '';
        }
        return view('office.quatation.add_quatation', compact('notify', 'company', 'currency', 'payment_term'));
    }
}
