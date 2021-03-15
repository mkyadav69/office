<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
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
            'email' => 'required|string|email',
            "password"    => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('message', 'User register successfully, Please login !');
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
}
