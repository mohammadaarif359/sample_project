<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

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
