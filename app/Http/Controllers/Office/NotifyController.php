<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notify;
use Carbon\Carbon;
use Config;
use DataTables;


class NotifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showNotify(){
        $branch_wise = Config::get('constant.branch_wise');
        $swipe_branch = array_flip($branch_wise);
        return view('office.notify.notify', compact('branch_wise', 'swipe_branch'));
    }

    public function storeNotify(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email1' => 'required',
            'email2' => 'required',
            'select_branch' => 'required'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'notify_add')->withInput();
        }

        $check_status = Notify::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email1,
            'cc_email'=>$request->email2,
            'branch_id'=>$request->select_branch,
            'dt_created'=>Carbon::now(),
        ]);

        if(!empty($check_status)){
            return back()->with([
                'message' => 'Notification created successfully !',
            ]);
        }else{
            return back()->with([
                'error_message' => 'Fail created notification !',
            ]);
        }
    }

    public function getNotify(Request $request){
        $notify = Notify::get();
        $branch_wise = Config::get('constant.branch_wise');

        $notify = Datatables::of(Notify::query());
        if(Auth::user()->hasPermission('update_notify')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_notify')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_notify', 'delete_notify'])){
            $notify->addColumn('actions', function ($notify) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($notify) {
                    return $notify->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $notify->addColumn('actions', function ($notify){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($notify) {
                    return $notify->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $notify->editColumn('dt_created', function ($notify) {
            $date = $notify['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->editColumn('branch_id', function ($notify) use($branch_wise){
            if(!empty($notify['branch_id'])){
                if(isset($branch_wise[$notify['branch_id']])){
                    return $branch_wise[$notify['branch_id']];
                }
            }
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $notify->make(true);
    }

    public function updateNotify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email1'=>'required',
            'email2'=>'required',
            'select_branch'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'notify_update')->withInput();
        }
    
        $check_status = Notify::where('id', $id)->update([
            'name'=>$request->name,
            'email'=>$request->email1,
            'cc_email'=>$request->email2,
            'branch_id'=>$request->select_branch,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Notification updated successfully !',
            ]);
        }else{
            return back()->with([
                'error_message' => 'Fail to update user notification !',
            ]);
        }

    }

    public function deleteNotify(Request $request, $id){
        $records = Notify::where('id', $id)->delete();
        if($records == '1'){
            $message =  ['message'=>'Records deleted successfully !'];
        }else{
            $message =['error_message'=>'Fail to delete record !'];
        }
        return back()->with($message);
    }
    
}
