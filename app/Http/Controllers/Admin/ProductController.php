<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Traits\AuthCode;

class ProductController extends Controller
{
    use AuthCode;
	public function index(Request $request) {
		if ($request->ajax()) {
			$products = Product::get();
			return Datatables::of($products)
				->addColumn('action', function ($data) {
					$btn = '<a href="/admin/product/edit/'.$data->id.'" class="" title="Edit"><i class="fa fa-edit"></i></a><a href="/admin/product/delete/'.$data->id.'" class="" title="Delete"><i class="fa fa-trash"></i></a>';
					return $btn;
				})->editColumn('created_at', function ($data) {
					return [
						'display' => Carbon::parse($data->created_at)->format('d-m-Y h:i A'),
						'timestamp' => $data->created_at
					];
				})->editColumn('image_url', function ($data) {
					$btn = !empty($data->image_url) ? '<img src="'.$data->image_url.'" class="img img-responsive" style="height:100px;width:100px;">' : '';
					return $btn;
				})->rawColumns(['image_url','action'])
				->make(true);
		}
		return view('admin.product.list');
	}
	public function add() {
		return view('admin.product.add');
	}
	public function store(Request $request) {
		$request_data = $request->all();
		$request->validate([
			'name'    => 'required',
            'price'   => 'required|numeric|min:1',
            'description'  => 'required',
			'image' => 'required|mimes:jpeg,jpg,png',
		]);
		$file_name = null;
		if($request->hasFile('image')) {
			$file_name = $this->uploadImg($request->image,'products');
		}
		$product = Product::create([
			'name'=>$request_data['name'],
			'price'=>$request_data['price'],
			'description'=>$request_data['description'],
			'image'=>$file_name,
		]);
		return redirect()->route('admin.product')->with('success', 'Product added Successfully !');
	}
	public function edit($id) {
		$product = Product::where('id',$id)->first();
		if($product) {
			return view('admin.product.edit',compact('product'));
		} else {
			abort(404);
		}
	}
	public function update(Request $request) {
		$request_data = $request->all();
		$request->validate([
			'id' =>	'required',
			'name'    => 'required',
            'price'   => 'required|numeric|min:1',
            'description'  => 'required',
			'image' => 'nullable|mimes:jpeg,jpg,png',
		]);
		$file_name = null;
		if($request->hasFile('image')) {
			$file_name = $this->uploadImg($request->image,'products');
		}
		$product = Product::where('id',$request->id)->first();
		if($product) {
			$product->name = $request_data['name'];
			$product->price = $request_data['price'];
			$product->description = $request_data['description'];
			$product->image = !empty($file_name) ?  $file_name : $product->image;
			$product->save();
			return redirect()->route('admin.product')->with('success', 'Product updated successfully !');
		} else {
			return redirect()->back()->with('error', 'Failer to updated product !');
		}
		
	}
	public function delete($id) {
		$product = Product::where('id',$id)->first();
		if($product) {
			$product->delete();
			return redirect()->back()->with('success', 'Product deleted successfully !');
		} else {
			abort(404);
		}	
	}
}
