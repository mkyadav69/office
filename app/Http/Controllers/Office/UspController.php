<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usp;
use Carbon\Carbon;
use DataTables;

class UspController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showUsp(){
        return view('office.usp.usp');
    }

    public function storeUsp(Request $request){
        $validator = Validator::make($request->all(), [
            'usp_type' => 'required',
            'packing'=>'required',
            'brand'=>'required',
            'select_category'=>'required',
            'principal'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'usp_add')->withInput();
        }
        $check_status = Usp::insertGetId([
            'usp_type'=>$request->usp_type,
            'packing'=>$request->packing,
            'brand'=>$request->brand,
            'category'=>$request->select_category,
            'principal'=>$request->principal,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Pricipal created successfully !',
            ]);
        }
    }

    public function getUsp(Request $request){
       
        $usp = Datatables::of(Usp::query());
        if(Auth::user()->hasPermission('update_usp')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_usp')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_usp', 'delete_usp'])){
            $usp->addColumn('actions', function ($usp) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($usp) {
                    return $usp->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $usp->addColumn('actions', function ($usp){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($usp) {
                    return $usp->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $usp->editColumn('dt_created', function ($usp) {
            $date = $usp['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $usp->make(true);
    }

    public function updateUsp(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_usp_type' => 'required',
            'update_packing'=>'required',
            'update_brand'=>'required',
            'update_select_category'=>'required',
            'update_principal'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'usp_update')->withInput();
        }

        $check_status = Usp::where('id', $id)->update([
            'usp_type'=>$request->update_usp_type,
            'packing'=>$request->update_packing,
            'brand'=>$request->update_brand,
            'category'=>$request->update_select_category,
            'principal'=>$request->update_principal,
            'dt_updated'=>Carbon::now(),
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
