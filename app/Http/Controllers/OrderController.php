<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderProduct;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('web.checkout');
    }
	public function order(Request $request) {
		$request_data = $request->all();
		$request->validate([
			'name'    => 'required|regex:/^[\pL\s]+$/u',
            'email'   => 'required|email',
            'mobile'  => 'required|numeric|digits_between:8,12',
			'address'=> 'required',
		]);
		$sucess = 0;
		$total = 0;
		foreach(session('cart') as $id => $details) {
			$total += $details['price'] * $details['quantity'];		
		}
		echo $total;
		if($total <= 0) {
			session()->put('cart', []);
			return redirect()->back()->with('error', 'Cart is empty');
		} else {
			$order = Order::create([
				'name'=> $request_data['name'],
				'email'=> $request_data['email'],
				'mobile'=> $request_data['mobile'],
				'address'=> $request_data['address'],
				'total'=> $total,
				'status'=> 1
			]);
			if($order) {
				foreach(session('cart') as $id => $details) {
					OrderProduct::create([
						'order_id'=>$order->id,
						'product_id'=>$id,
						'name'=>$details['name'],
						'price'=>$details['price'],
						'quantity'=>$details['quantity'],
						'total'=>$details['price'] * $details['quantity']
					]);	
				}
				$sucess = 1;
			}
			if($sucess == 1) {
				session()->put('cart', []);
				return redirect()->route('home')->with('success', 'Order placed successfully');
			} else {
				return redirect()->back()->with('error', 'something went wrong');
			}			
		}
	}
}
