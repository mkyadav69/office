<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $db_admins = User::all()->pluck('email')->toArray();
        $super_admin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();
        $e2 = Role::where('name', 'e2')->first();
        if(!in_array('suadmin@iksula.com', $db_admins)) {
            /*Super User*/
            $super_admin = User::create([                  
                'id' => 1,
                'email' => 'suadmin@iksula.com',
                'password' =>  bcrypt('123456'),
                'permissions' => NULL,
                'activated' => 1,
                'activation_code' => NULL,
                'activated_at' => NULL,
                'last_login' => '2019-01-29 10:27:18',
                'persist_code' => '$2y$10$1XyKAOaBl.sO78lMtGmkmuzfvgBqH8QTdB6FannSLkrmNiE1kW16i',
                'reset_password_code' => NULL,
                'first_name' => 'SuperAdmin',
                'last_name' => 'SuperAdmin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
                'deleted_at' => NULL,
                'bio' => '',
                'gender' => '',
                'dob' => Carbon::now()->toDateTimeString(),
                'pic' => NULL,
                'country' => '',
                'state' => '',
                'city' => '',
                'address' => '',
                'postal' => '',
                'remember_token' => 'nGSxaRYRMFm02Sqcaj8h3cc2deHdxFIn2O4cF57ce4L6Q76c0pJeeifN9TOO',
            ]);

            $super_admin->attachRole($super_admin);
        }
        if(!in_array('admin@iksula.com', $db_admins)) {
            /*Admin*/
            $admin = User::create([                  
                'id' => 2,
                'email' => 'admin@iksula.com',
                'password' =>  bcrypt('123456'),
                'permissions' => NULL,
                'activated' => 1,
                'activation_code' => NULL,
                'activated_at' => NULL,
                'last_login' => '2019-01-29 10:27:18',
                'persist_code' => '$2y$10$1XyKAOaBl.sO78lMtGmkmuzfvgBqH8QTdB6FannSLkrmNiE1kW16i',
                'reset_password_code' => NULL,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
                'deleted_at' => NULL,
                'bio' => '',
                'gender' => '',
                'dob' => Carbon::now()->toDateTimeString(),
                'pic' => NULL,
                'country' => '',
                'state' => '',
                'city' => '',
                'address' => '',
                'postal' => '',
                'remember_token' => 'nGSxaRYRMFm02Sqcaj8h3cc2deHdxFIn2O4cF57ce4L6Q76c0pJeeifN9TOO',
            ]);

            $admin->attachRole($admin);
        }
        if(!in_array('user@iksula.com', $db_admins)) {
        /*User*/
            $user = User::create([                  
                'id' => 3,
                'email' => 'user@iksula.com',
                'password' =>  bcrypt('123456'),
                'permissions' => NULL,
                'activated' => 1,
                'activation_code' => NULL,
                'activated_at' => NULL,
                'last_login' => '2019-01-29 10:27:18',
                'persist_code' => '$2y$10$1XyKAOaBl.sO78lMtGmkmuzfvgBqH8QTdB6FannSLkrmNiE1kW16i',
                'reset_password_code' => NULL,
                'first_name' => 'User',
                'last_name' => 'User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
                'deleted_at' => NULL,
                'bio' => '',
                'gender' => '',
                'dob' => Carbon::now()->toDateTimeString(),
                'pic' => NULL,
                'country' => '',
                'state' => '',
                'city' => '',
                'address' => '',
                'postal' => '',
                'remember_token' => 'nGSxaRYRMFm02Sqcaj8h3cc2deHdxFIn2O4cF57ce4L6Q76c0pJeeifN9TOO',
            ]);
            $user->attachRole($user);
        }  
        if(!in_array('e2@iksula.com', $db_admins)) {
            /*E2*/
            $e2 = User::create([                  
                'id' => 4,
                'email' => 'e2@iksula.com',
                'password' =>  bcrypt('123456'),
                'permissions' => NULL,
                'activated' => 1,
                'activation_code' => NULL,
                'activated_at' => NULL,
                'last_login' => '2016-11-30 12:34:31',
                'persist_code' => '$2y$10$FQxqe5BVe7J7VTk1QFPvLuInyG7ERDQQyZHv6.P.Nholg/6MF.zHq',
                'reset_password_code' => NULL,
                'first_name' => 'Enrich2',
                'last_name' => 'Enrich2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
                'deleted_at' => NULL,
                'bio' => NULL,
                'gender' => NULL,
                'dob' =>Carbon::now()->toDateTimeString(),
                'pic' => NULL,
                'country' => NULL,
                'state' => NULL,
                'city' => NULL,
                'address' => NULL,
                'postal' => NULL,
                'remember_token' => '',
            ]);
            $e2->attachRole($e2);
        }
    }
}