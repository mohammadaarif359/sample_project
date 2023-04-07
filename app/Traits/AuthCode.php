<?php namespace App\Traits;

use Log;
use Auth;
use App\Models\User;
use App\Models\Role;
use Mail;
use Exception;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\{File, Storage};
use DB;

trait AuthCode
{
    
	public function uploadImg($file, $path,$path_type='public')
    {
        $filename = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
		if($path_type == 'protected') {
			Storage::disk('protected')->put($path.'/'.$filename, File::get($file));
		} else {
			Storage::disk($path)->put($filename, File::get($file));
		}
        return $filename;
	}
	public function generateUniqueForgotToken(){
        do{
            $str = md5(uniqid(rand(), true));    
        }while(User::where('forgot_password_token', '=', $str)->count() > 0);
        return $str;
    }
	public function getUserRoleWithId($user) {
		if(!empty($user['roles'])) {
			$userRoles = $user['roles'];
			foreach($userRoles as $userRole) {
				$old_role[] = $userRole->id;
			}
			if($old_role > 0) {
				$roles = Role::select('id','name')->whereIn('id',$old_role)->get();
				return $roles;
			}
			return [];
		}
		return [];
	}
	
}
?>