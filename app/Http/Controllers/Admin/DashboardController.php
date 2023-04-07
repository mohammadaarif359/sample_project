<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
		$count = [];
		$count['user'] = User::count();
		$count['new_member'] = User::whereBetween('created_at', 
									[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
									)->count();
		$count['notification'] = Notification::count();
		$count['sell'] = 0;
		return view('admin.dashboard.index',compact('count'));
	}
}
