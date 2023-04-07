<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use DB;
use DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request) {
		if ($request->ajax()) {
			$orders = Order::get();
			return Datatables::of($orders)
				->addColumn('action', function ($data) {
					$btn = '<a href="/admin/order/'.$data->id.'" class="" title="Deatil"><i class="fa fa-eye"></i></a>';
					return $btn;
				})->editColumn('created_at', function ($data) {
					return [
						'display' => Carbon::parse($data->created_at)->format('d-m-Y h:i A'),
						'timestamp' => $data->created_at
					];
				})
				->make(true);
		}
		return view('admin.order.list');
	}
	public function detail(Request $request,$id) {
		if ($request->ajax()) {
			$deatils = OrderProduct::where('order_id',$id)->get();
			return Datatables::of($deatils)
				->editColumn('created_at', function ($data) {
					return [
						'display' => Carbon::parse($data->created_at)->format('d-m-Y h:i A'),
						'timestamp' => $data->created_at
					];
				})
				->make(true);
		}
		return view('admin.order.detail');
	}
}
