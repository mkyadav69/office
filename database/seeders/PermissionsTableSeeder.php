<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all  = Permission::get();
        $permission = [];
        $new_permsn = [];
        $persm_custom  = [];
        $db_permission = Permission::all()->pluck('name')->toArray();
        dd($db_permission);
        $tables  = \Config::get('modules.permission');
        $all_master_data_749 = \App\Helpers\ModuleConfig::getAllMasterData();
        $master  = $all_master_data_749+$tables;
        foreach ($master as $key => $value) {
           if(isset($value['permission']) && !empty($value['permission'])){
                $new_permsn[$key] = $value['permission'];
           }
        }
        if(!empty($new_permsn)){
            foreach ($new_permsn as $idfn=>$v) {
                foreach($v as $pr){
                    $x = [];
                    $x['display_name'] = ucfirst(str_replace('_',' ' , $pr)).' '.ucfirst(str_replace('_',' ' , $idfn));
                    $x['name'] = $pr.'_'.$idfn;
                    $x['description'] = "Permission to ".ucfirst(str_replace('_',' ' , $pr)).' '.ucfirst(str_replace('_',' ' , $idfn));
                    $x['identifier'] = $idfn;
                    $permission[]  = $x;
                }
            }
        }
    	foreach ($permission as $key => $value){
            if(!in_array($value['name'], $db_permission)){
    		  Permission::create($value);
            }
    	}
    }
}
