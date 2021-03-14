<?php
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Carbon\Carbon;
class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $db_role = Role::all()->pluck('name')->toArray();
        $all_permission = Permission::all();
        $perm_list = $all_permission->toArray();
        $specific_permision=[];
        foreach($all_permission as $permission) {
            $specific_permision[$permission->name] = $permission;
        }
        if(!in_array('super-admin', $db_role)) {
            /*Super Admin*/
            $su_role = Role::create([
                'display_name' => 'Super Admin',
                'name' => 'super-admin',
                'description' => 'Has access for every operation !'
            ]);
            $arr = [];
            foreach ($perm_list as $key => $value) {
                $su_role->attachPermission($specific_permision[$value['name']]);
            }
        }
        if(!in_array('admin', $db_role)) {
           /*Admin*/
            $admin_role = Role::create([
                'display_name' => 'Admin',
                'name' => 'admin',
                'description' => 'Has access for master & perform qc !'
            ]);

           
            $admin_role->attachPermission($specific_permision['view_category_master']);
            $admin_role->attachPermission($specific_permision['view_attribute_master']);
        }
        if(!in_array('user', $db_role)) {
            /* User*/
            $user_role = Role::create([
                'display_name' => 'User',
                'name' => 'user',
                'description' => 'Has access for perform qc !'
            ]);
           
            $user_role->attachPermission($specific_permision['view_perform_qc']);
            $user_role->attachPermission($specific_permision['view_sp_perform_qc']);
        }
        if(!in_array('e2', $db_role)) {
            /*E2*/
            $e2_role = Role::create([
                'display_name' => 'E2',
                'name' => 'e2',
                'description' => 'Has access enrichmnet 2 !'
            ]);
        }
	}
}