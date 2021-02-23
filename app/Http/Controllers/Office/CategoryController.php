<?php

namespace App\Http\Controllers\Office;
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
    public function showCategory(){
        $parameter = Parameter::get()->toArray();
        if(!empty($parameter)){
            $param = collect($parameter)->pluck('p_name')->toArray();
        }
        return view('office.category.category', compact('param'));
    }

    public function storeCategory(Request $request){
        $this->validate($request,[
            'category_name' => 'required',
            'category_desc'=>'required',
            'principal_image'=>'required',
        ]);
        
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
            'dt_created'=>Carbon::now(),
            'category_banner_image'=>$request->principal_image,
            'category_small_banner_image'=>$request->principal_image,
            'user_id'=>Auth::user()->id,
            'status'=>1,
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Category created successfully !',
            ]);
        }
    }

    public function getCategory(Request $request){
        return Datatables::of(Category::query())->make(true);
    }

    public function updateCategory(Request $request, $id){
        $this->validate($request,[
            'update_category_name' => 'required',
            'update_category_desc'=>'required',
            'update_principal_image'=>'required',
        ]);

        $check_status = Category::where('cat_id', $id)->update([
            'st_cat_name'=>$request->update_category_name,
            'st_cat_disc'=>$request->update_category_desc,
            'str_img_src'=>$request->update_principal_image,
            'dt_created'=>Carbon::now(),
            'category_banner_image'=>$request->update_principal_image,
            'category_small_banner_image'=>$request->update_principal_image,
            'user_id'=>Auth::user()->id,
            'status'=>1,
            'dt_modify'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
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
