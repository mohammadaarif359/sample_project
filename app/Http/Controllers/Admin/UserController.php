<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\AuthCode;
use DB;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    use AuthCode;
	public function index(Request $request) {
		if ($request->ajax()) {
			$users = User::get();
			return Datatables::of($users)
				->editColumn('created_at', function ($user) {
					return [
						'display' => Carbon::parse($user->created_at)->format('d-m-Y h:i A'),
						'timestamp' => $user->created_at
					];
				})->editColumn('status', function ($user) {
					return $user->status == 1 ? 'Active' : 'Deactive';
				})
				->make(true);
		}
		return view('admin.user.list');
	}
}	
