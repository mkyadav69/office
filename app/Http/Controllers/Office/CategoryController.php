<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Parameter;
use Carbon\Carbon;
use Config;
use DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showCategory(){
        $parameter = Parameter::get()->toArray();
        if(!empty($parameter)){
            $param = collect($parameter)->pluck('p_name')->toArray();
        }
        return view('office.category.category', compact('param'));
    }

    public function storeCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_desc'=>'required',
            'principal_image'=>'required',
            'product_param'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'category_add')->withInput();
        }
        
        if(!empty($request->product_param)){
            $param = implode(',', $request->product_param);
        }else{
            $param = null;
        }

        $check_status = Category::insertGetId([
            'st_cat_name'=>$request->category_name,
            'st_cat_disc'=>$request->category_desc,
            'str_img_src'=>$request->principal_image,
            'st_product_fields'=>$param,
            'category_banner_image'=>$request->principal_image,
            'category_small_banner_image'=>$request->principal_image,
            'user_id'=>Auth::user()->id,
            'status'=>1,
            'dt_created'=>Carbon::now(),
        ]);

        if(!empty($check_status)){
            return back()->with([
                'message' => 'Category created successfully !',
            ]);
        }
    }

    public function getCategory(Request $request){
        $category = Datatables::of(Category::query());
        if(Auth::user()->hasPermission('update_category')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_category')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_category', 'delete_category'])){
            $category->addColumn('actions', function ($category) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($category) {
                    return $category->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $category->addColumn('actions', function ($category){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($category) {
                    return $category->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $category->editColumn('dt_created', function ($category) {
            $date = $category['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->make(true);

        return $category->make(true);
    }

    public function updateCategory(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_category_name' => 'required',
            'update_category_desc'=>'required',
            'update_principal_image'=>'required',
            'product_param'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'category_update')->withInput();
        }

        if(!empty($request->product_param)){
            $param = implode(',', $request->product_param);
        }else{
            $param = null;
        }

        $check_status = Category::where('cat_id', $id)->update([
            'st_cat_name'=>$request->update_category_name,
            'st_cat_disc'=>$request->update_category_desc,
            'str_img_src'=>$request->update_principal_image,
            'category_banner_image'=>$request->update_principal_image,
            'category_small_banner_image'=>$request->update_principal_image,
            'st_product_fields'=>$param,
            'user_id'=>Auth::user()->id,
            'status'=>1,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Category updated successfully !',
            ]);
        }
    }

    public function deleteCategory(Request $request, $id){
        $records = Category::where('cat_id', $id)->delete();
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
