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
        return view('auth.users.index', compact('branch_wise', 'name_branch'));
    }

    public function getUser(Request $request){
        $branch_wise = Config('constant.branch_wise');
        $users = User::get();
        return Datatables::of($users)
            ->editColumn('dt_created', function ($users) {
                $date = $users['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
            })
            ->editColumn('branch_id', function ($users) use($branch_wise) {
                $id = $users['branch_id'];
                if(!empty($id)){
                    if(isset($branch_wise[$id])){
                        return $branch_wise[$id];
                    }
                }
            })->make(true);
    }

    public function storeUser(Request $request){
       $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'cc_email' => 'required',
            'branch' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'user_add')->withInput();
        }
        $check_status = User::insertGetId([
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
            return back()->with([
                'message' => 'User created successfully !',
            ]);
        }
    }

    public function updateUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_first_name' => 'required',
            'update_last_name' => 'required',
            'update_username' => 'required',
            'update_email' => 'required',
            'update_cc_email' => 'required',
            'update_branch' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'user_update')->withInput();
        }

        $check_status = User::where('id', $id)->update([
            'first_name'=>$request->update_first_name,
            'last_name'=>$request->update_last_name,
            'user_name'=>$request->update_username,
            'email'=>$request->update_email,
            'branch_id'=>$request->update_branch,
            'cc_email'=>$request->update_cc_email,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'User updated successfully !',
            ]);
        }
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

    public function showRole(){
        $roles = Role::with('permissions')->get();
        $permissions = Permission::All();
        return view('auth.role_permission.index',compact('roles','permissions'));
    }

    public function addRole(){
        $module_name = [];
        $permission = Permission::get()->toArray();
        if(!empty($permission)){
            foreach($permission as $per){
                $name = $per['identifier'];
               if(!isset($module_name['Modules'][$name])){
                    $module_name['Modules'][$name] = [];
               }else{
                    $feature = explode("_", $per['name'],-1)[0];
                    $module_name['Modules'][$name][$feature] = $per;
                    $module_name['Operations'][$feature] = $feature;
                    $module_name['order'][$feature] = $feature;
               }
            }
        }
        return view('auth.role_permission.create', compact('module_name'));
    }

    public function storeRole(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:roles',
            'display_name' => 'required|unique:roles|min:3',
            "description"    => "required",
            "permission"    => "required|array",
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
        $role = Role::create([
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'description'   => $request->description,
            ]);
        if($role){
            $role->permissions()->sync($per_id);
            return redirect()->route('list.role')->with('success','Role added successfuly !');
        }else{
            return redirect()->back()->withErrors(['error', 'Fail to add new role !']);
        }
    }

    public function updateRole(Request $request , $id){
        dd("lklk");
        $this->validate($request,[
            'name' => "required|unique:roles,name,{$id}",
            'display_name' => "required|unique:roles,display_name,{$id}",
            "description"    => "required",
            "permission"    => "required|array",
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
        if(!empty($id)){
            $roles = Role::with('permissions')->get();
            $permissions = Permission::All();
            $update_role = Role::where('id',$id)->first();
            $update_role->name = $request->name;
            $update_role->display_name = $request->display_name;
            $update_role->description = $request->description;
            $update_role->permissions()->sync($per_id);
            $update_role->save();
            if(!empty($update_role)){
                return redirect()->route('list.role')->with('success','Role updated successfully !');
            }
        }
        return redirect()->back()->with('error','Cant find the role !');
    }
}
