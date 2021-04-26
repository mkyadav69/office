<?php

namespace App\Http\Controllers\Office;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Source;
use Carbon\Carbon;
use DataTables;

class SourceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function showSource(){
        return view('office.source.source');
    }

    public function storeSource(Request $request){
        $validator = Validator::make($request->all(), [
            'source_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'source_add')->withInput();
        }
        $check_status = Source::insertGetId([
            'pro_source'=>$request->source_name,
            'branch_id' =>\Auth()->user()->branch_id,
            'user_id' =>\Auth()->user()->id,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Source created successfully !',
            ]);
        }
    }

    public function getSource(Request $request){
        $source = Datatables::of(Source::query());

        if(Auth::user()->hasPermission('update_source')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_source')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }
        ;
        if(Auth::user()->hasPermission(['update_source', 'delete_source'])){
            $source->addColumn('actions', function ($source) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($source) {
                    return $source->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $source->addColumn('actions', function ($source){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($source) {
                    return $source->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $source->editColumn('dt_created', function ($source) {
            $date = $source['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $source->make(true);
    }

    public function updateSource(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_source_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'source_update')->withInput();
        }

        $check_status = Source::where('id', $id)->update([
            'pro_source'=>$request->update_source_name,
            'branch_id' =>\Auth()->user()->branch_id,
            'user_id' =>\Auth()->user()->id,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Source updated successfully !',
            ]);
        }
    }

    public function deleteSource(Request $request, $id){
        $records = Source::where('id', $id)->delete();
        if($records == '1'){
            $message =  'Records deleted successfully !';
        }else{
            $message ='Fail to delete record !';
        }
        return back()->with([
            'message' =>$message
        ]);
    }
}

