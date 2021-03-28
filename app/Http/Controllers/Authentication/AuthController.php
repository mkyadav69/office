<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Config;
use DataTables;

class AuthController extends Controller
{
    public function viewLogin(){
        return view('auth.users.login');
    }

    public function addUser(Request $request){
        $branch_wise = Config::get('constant.branch_wise');
        $name_branch = array_flip($branch_wise);
        $roles = Role::All();
        $permissions = Permission::All();
        $module_name = [];
        $permission = Permission::get()->toArray();
        if(!empty($permission)){
            foreach($permission as $per){
                $feature = explode("_", $per['name'],-1)[0];
                $name = $per['identifier'];
               if(!isset($module_name['Modules'][$name])){
                    $module_name['order'][$feature] = $feature;
                    $module_name['Operations'][$feature] = $feature;
                    $module_name['Modules'][$name][$feature] = $per;
                }else{
                    $feature = explode("_", $per['name'],-1)[0];
                    $module_name['Modules'][$name][$feature] = $per;
                    $module_name['Operations'][$feature] = $feature;
                    $module_name['order'][$feature] = $feature;
               }
            }
        }
        return view('auth.users.create', compact('branch_wise', 'name_branch', 'roles', 'permissions', 'module_name'));
    }

    public function getLogin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            "password"    => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('message', 'Login done successfully.');
        }
        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', 'Logout successfully !');
    }

    public function showUser(Request $request){
        $branch_wise = Config::get('constant.branch_wise');
        $name_branch = array_flip($branch_wise);
        $roles = Role::All();
        $permissions = Permission::All();
        return view('auth.users.index', compact('branch_wise', 'name_branch', 'roles', 'permissions'));
    }

    public function getUser(Request $request){
        $branch_wise = Config('constant.branch_wise');
        $users = Datatables::of(User::query());
        if(Auth::user()->hasPermission('update_user')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_user')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_user', 'delete_user'])){
            $users->addColumn('actions', function ($users) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($users) {
                    return $users->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $users->addColumn('actions', function ($users){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($users) {
                    return $users->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $users->editColumn('dt_created', function ($users) {
            $date = $users['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->editColumn('branch_id', function ($users) use($branch_wise) {
            $id = $users['branch_id'];
            if(!empty($id)){
                if(isset($branch_wise[$id])){
                    return $branch_wise[$id];
                }
            }
        })->make(true);

        return $users->make(true);
    }

    public function storeUser(Request $request){
       $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'cc_email' => 'required',
            'name'    => 'required|unique:roles',
            'branch' => 'required',
            'permission'=>'required|array',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'user_add')->withInput();
        }

        $per_id = [];
        $new_per_list = [];
        $existing_permsn = [];
        $permissions = Permission::get()->toArray();
        $per_arr_list = []; 
        if(!empty($permissions)){
            foreach ($permissions as $key => $value) {
                if(!isset($per_arr_list[$value['identifier']])){
                    $per_arr_list[$value['identifier']] = [];
                }  
                $per_arr_list[$value['identifier']][] = $value['name']; 
            }
        }
        $new_per = $request->permission;
        foreach ($new_per as $identifr => $value) {
            if(isset($per_arr_list[$identifr]) && !empty($per_arr_list[$identifr])){
                $new_per_list[$identifr] = array_diff($value, $per_arr_list[$identifr]);
                $existing_permsn[$identifr] = array_intersect($value,$per_arr_list[$identifr]);
            }else{
                $new_per_list[$identifr] = $value;
            }
        }
        if(!empty($new_per_list)){
            foreach ($new_per_list as $identifier => $value) {
                foreach ($value as $name) {
                    $pr_id = Permission::insertGetId(['name'=>$name, 'identifier'=>$identifier]);
                    $per_id[]  = $pr_id;
                }
            }
        }
        if(!empty($existing_permsn)){
            foreach ($existing_permsn as $identifier => $value) {
                foreach ($value as $name) {
                    $pr_id = Permission::where('name',$name)->where('identifier',$identifier)->first()->id;
                    $per_id[]  = $pr_id;
                }
            }
        }
        $role = Role::create([
            'name'=> $request->name,
            'created_at'=> Carbon::now(),
        ]);
        if(!empty($role)){
            $role->permissions()->sync($per_id);
        }else{
            return redirect()->back()->withErrors(['message', 'Fail to create role or permissions !']);
        }

        $check_status = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'user_name'=>$request->username,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'branch_id'=>$request->branch,
            'cc_email'=>$request->cc_email,
            'dt_created'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            $check_status->roles()->attach($role->id);
            return redirect()->route('show_user')->with('message','User created successfully !');
        }else{
            return redirect()->back()->withErrors(['message', 'Fail to add user !']);
        }
    }

    public function updateUser(Request $request, $id){
        if(empty($id)){
            return redirect()->back()->withErrors(['message', 'Fail to get user id !']);
        }
        $user = User::where('id', $id)->first();
        $branch_wise = Config::get('constant.branch_wise');
        $order = Config('constant.feature_list');
        $path = app_path() . "/Models";
        $model_list = [];
        $results = scandir($path);
        if(!empty($results)){
            foreach ($results as $result) {
                if ($result === '.' or $result === '..') continue;
                $filename = strtolower($result);
                $model_list[] = substr($filename,0,-4);
            }
        }
        $persm_custom = [];
        $new_permsn = [];
        $per_data = [];
        if(!empty($model_list)){
            foreach ($model_list as $idfn) {
                foreach($order as $pr){
                    $x = [];
                    $x['display_name'] = ucfirst(str_replace('_',' ' , $pr)).' '.ucfirst(str_replace('_',' ' , $idfn));
                    $x['name'] = $pr.'_'.$idfn;
                    $x['description'] = "Permission to ".ucfirst(str_replace('_',' ' , $pr)).' '.ucfirst(str_replace('_',' ' , $idfn));
                    $x['identifier'] = $idfn;
                    $new_permsn[]  = $x;
                }
            }
        }
        if(!empty($new_permsn)){
            foreach ($new_permsn as $v) {                
                if(!isset($per_data[$v['identifier']])){
                    $per_data[$v['identifier']] = [];
                }
                $k = explode('_',  $v['name'])[0];
                $per_data[$v['identifier']][$k] = $v['name'];
            }
        }
        $permissions = Permission::All();
        $permissions  = $permissions->toArray();
        $per_arr_list = [];
        $user_role_list = []; 
        if(!empty($permissions)){
            foreach ($permissions as $key => $value) {
                if(!isset($per_arr_list[$value['identifier']])){
                    $per_arr_list[$value['identifier']] = [];
                }  
                $per_arr_list[$value['identifier']][$value['id']] = $value['name']; 
            }
        }
        $auth_role = $user->roles->first()->toArray();
        $edit_role = Role::with('permissions')->where('id',$auth_role['id'])->first();
        $user_role = $edit_role->permissions->toArray();
        if(!empty($user_role)){
            foreach ($user_role as $key => $value) {
                $per = explode('_', $value['name']);
                if(!isset($user_role_list[$value['identifier']])){
                    $user_role_list[$value['identifier']] = [];
                }  
                $user_role_list[$value['identifier']][$per[0]] = $value['name']; 
            }
        }
        $roles = Role::with('permissions')->get();
        return view('auth.users.edit',compact('user', 'branch_wise', 'roles', 'user_role_list', 'edit_role', 'permissions', 'per_arr_list', 'per_data', 'order', 'auth_role', 'id'));
    }

    public function storeUserUpdate(Request $request){
        $data = $request->all();
        if(empty($data['id'])){
            return redirect()->back()->with('error','Cant find the role id !');
        }
        $this->validate($request,[
            'update_first_name'=>'required',
            'update_last_name'=>'required',
            'update_username'=>'required',
            'update_email'=>'required',
            'update_cc_email'=>'required',
            'update_branch'=>'required',
            'name' => "required",
            "permission"    => "required|array",
        ]);
        $update = User::where('id', $data['id'])->update([
            'first_name'=>$data['update_first_name'],
            'last_name'=>$data['update_last_name'],
            'user_name'=>$data['update_username'],
            'email'=>$data['update_email'],
            'branch_id'=>$data['update_branch'],
            'cc_email'=>$data['update_cc_email'],
            'dt_modify'=>Carbon::now(),
        ]);
        $per_id = [];
        $new_per_list = [];
        $existing_permsn = [];
        $permissions = Permission::get()->toArray();
        $per_arr_list = []; 
        if(!empty($permissions)){
            foreach ($permissions as $key => $value) {
                if(!isset($per_arr_list[$value['identifier']])){
                    $per_arr_list[$value['identifier']] = [];
                }  
                $per_arr_list[$value['identifier']][] = $value['name']; 
            }
        }
        $new_per = $request->permission;
        foreach ($new_per as $identifr => $value) {
            if(isset($per_arr_list[$identifr]) && !empty($per_arr_list[$identifr])){
                $new_per_list[$identifr] = array_diff($value, $per_arr_list[$identifr]);
                $existing_permsn[$identifr] = array_intersect($value,$per_arr_list[$identifr]);
            }else{
                $new_per_list[$identifr] = $value;
            }
        }
        if(!empty($new_per_list)){
            foreach ($new_per_list as $identifier => $value) {
                foreach ($value as $name) {
                    $pr_id = Permission::insertGetId(['name'=>$name, 'identifier'=>$identifier]);
                    $per_id[]  = $pr_id;
                }
            }
        }
        if(!empty($existing_permsn)){
            foreach ($existing_permsn as $identifier => $value) {
                foreach ($value as $name) {
                    $pr_id = Permission::where('name',$name)->where('identifier',$identifier)->first()->id;
                    $per_id[]  = $pr_id;
                }
            }
        }

        $user = User::where('id', $data['id'])->first();
        $auth_role = $user->roles->first()->toArray();
        if(!empty($data['id'])){
            $roles = Role::with('permissions')->get();
            $permissions = Permission::All();
            $update_role = Role::where('id',$auth_role['id'])->first();
            $update_role->name = $request->name;
            $update_role->permissions()->sync($per_id);
            $update_role->save();
            if(!empty($update_role)){
                return redirect()->route('show_user')->with('message','User updated successfully !');
            }
        }
        return redirect()->back()->with('message','Cant find the user !');
    }

    public function deleteUser(Request $request, $id){
        $records = User::where('id', $id)->delete();
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
