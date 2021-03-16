<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function viewRegister(){
        return view('auth.users.register');
    }

    public function storeRegister(Request $request){
        try {
            $this->validate($request,[
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                "password"    => 'required_with:password_confirmation|string|confirmed',
                'password_confirmation' =>'required'
            ]);

            $getInstertedId = User::insertGetId([
                'first_name'=> $request->username,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'dt_created'=> Carbon::now(),
            ]);
            if(!empty($getInstertedId)){
                return redirect()->route('login')->with('message', 'User register successfully, Please login !');
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
