<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
use App\Models\User;

class CreateDefaultRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $defaultrole = array('admin','user');
	    foreach($defaultrole as $roleData) {
			if(!Role::where('name',$roleData)->exists()) {
				$role = new Role();
				$role->name = $roleData;
				$role->display_name = ucwords(str_replace("-"," ",$roleData));
				$role->save();
			}
		}
		// defult admin user
		$user = User::create([
			'name'=>'aarif',
			'email'=>'aarif@technoscore.net',
			'mobile'=>'8290027571',
			'password'=>bcrypt('12345678'),
			'status'=>1
		]);
		// attach role
		$role = Role::where('name','admin')->first();
		$user->attachRole($role->id);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
