<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
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
        if(!in_array('suadmin@iksula.com', $db_admins)) {
            /*Super User*/
            $super_admin = User::create([                  
                'id' => 1,
                'name' => 'SuperAdmin',
                'email' => 'admin@office.com',
                'password' =>  bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
                'remember_token' => 'nGSxaRYRMFm02Sqcaj8h3cc2deHdxFIn2O4cF57ce4L6Q76c0pJeeifN9TOO',
            ]);

            $super_admin->attachRole($super_admin);
        }
    }
}