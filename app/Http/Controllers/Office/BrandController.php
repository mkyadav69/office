<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use DataTables;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function showBrand(){
        return view('office.brand.brand');
    }

    public function storeBrand(Request $request){
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'brand_add')->withInput();
        }
        $check_status = Brand::insertGetId([
            'brand_name'=>$request->brand_name,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Brand created successfully !',
            ]);
        }
    }

    public function getBrand(Request $request){
        $brand = Datatables::of(Brand::query());

        if(Auth::user()->hasPermission('update_brand')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_brand')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }
        ;
        if(Auth::user()->hasPermission(['update_brand', 'delete_brand'])){
            $brand->addColumn('actions', function ($brand) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($brand) {
                    return $brand->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $brand->addColumn('actions', function ($brand){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($brand) {
                    return $brand->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $brand->editColumn('dt_created', function ($brand) {
            $date = $brand['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $brand->make(true);
    }

    public function updateBrand(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_brand_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'brand_update')->withInput();
        }

        $check_status = Brand::where('id', $id)->update([
            'brand_name'=>$request->update_brand_name,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Brand updated successfully !',
            ]);
        }
    }

    public function deleteBrand(Request $request, $id){
        $records = Brand::where('id', $id)->delete();
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