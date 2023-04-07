@extends('web.layout')
   
@section('content')
    
<div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="{{ !empty($product->image_url) ? $product->image_url : 'https://dummyimage.com/200x300/000/fff&text=Samsung' }}" alt="">
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> ₹ {{ $product->price }}</p>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
    @endforeach
	<div class="col-sm-12">
		{{  $products->appends(request()->input())->links() }}
    </div>
</div>
    
@endsection