<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuatationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showQuatation(){
        // $branch_wise = Config::get('constant.branch_wise');
        // $swipe_branch = array_flip($branch_wise);
        return view('office.quatation.show_quatation');
    }
    public function addQuatation(){
        return view('office.quatation.add_quatation');
    }
}
