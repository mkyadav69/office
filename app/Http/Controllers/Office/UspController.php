<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usp;
use Carbon\Carbon;
use DataTables;

class UspController extends Controller
{
    public function showUsp(){
        return view('office.usp.usp');
    }

    public function storeUsp(Request $request){
        $this->validate($request,[
            'usp_type' => 'required',
            'packing'=>'required',
            'brand'=>'required',
            'select_category'=>'required',
            'select_principal'=>'required',

        ]);
        $check_status = Usp::insertGetId([
            'usp_type'=>$request->usp_type,
            'packing'=>$request->packing,
            'brand'=>$request->brand,
            'category'=>$request->select_category,
            'principal'=>$request->select_principal,
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Pricipal created successfully !',
            ]);
        }
    }

    public function getUsp(Request $request){
        return Datatables::of(Usp::query())->make(true);
    }

    public function updateUsp(Request $request, $id){

        $this->validate($request,[
            'usp_type' => 'required',
            'packing'=>'required',
            'brand'=>'required',
            'select_category'=>'required',
            'select_principal'=>'required',
        ]);
        $check_status = Usp::where('id', $id)->update([
            'usp_type'=>$request->usp_type,
            'packing'=>$request->packing,
            'brand'=>$request->packing,
            'category'=>$request->select_category,
            'principal'=>$request->select_principal,


        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Product Usp updated successfully !',
            ]);
        }
    }

    public function deleteUsp(Request $request, $id){
        $records = Usp::where('id', $id)->get()->first();
        if($records){
            $records->delete();
            $message =  'Records deleted successfully !';
        }else{
            $message ='Fail to successfully !';
        }
        return back()->with([
            'message' =>$message
        ]);
    }
    
}
