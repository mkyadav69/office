<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Parameter;
use Carbon\Carbon;
use DataTables;
use Log;

class ProductParameter extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showParameter(Request $request){
        return view('office.parameter.parameter');
    }

    public function storeParameter(Request $request){
        $validator = Validator::make($request->all(), [
            'parameter_name' => 'required',
            'column_name'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'parameter_add')->withInput();
        }
        $check_status = Parameter::insertGetId([
            'p_name'=>$request->parameter_name,
            'column_name'=>$request->column_name,
            'dt_created'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Product parameter created successfully !',
            ]);
        }
    }

    public function getParameter(Request $request){
        $parameter = Datatables::of(Parameter::query());
        if(Auth::user()->hasPermission('update_parameter')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_parameter')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_parameter', 'delete_parameter'])){
            $parameter->addColumn('actions', function ($parameter) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($parameter) {
                    return $parameter->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $parameter->addColumn('actions', function ($parameter){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($parameter) {
                    return $parameter->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $parameter->editColumn('dt_created', function ($parameter) {
            $date = $parameter['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $parameter->make(true);
    }

    public function updateParameter(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_parameter_name' => 'required',
            'update_column_name'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'parameter_update')->withInput();
        }

        $check_status = Parameter::where('id', $id)->update([
            'p_name'=>$request->update_parameter_name,
            'column_name'=>$request->update_column_name,
            'dt_created'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Product parameter updated successfully !',
            ]);
        }
    }

    public function deleteParameter(Request $request, $id){
        $records = Parameter::where('id', $id)->get()->first();
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
