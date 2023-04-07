@extends('web.layout')
  
@section('content')
<div class="row">
	<div class="col-md-4 order-md-2 mb-4">
	   @php $total = 0 @endphp
       @if(session('cart'))
	   <h4 class="d-flex justify-content-between align-items-center mb-3">
		  <span class="text-muted">Your cart</span>
		  <span class="badge badge-secondary badge-pill">{{ count((array) session('cart')) }}</span>
	   </h4>
	   <ul class="list-group mb-3 sticky-top">
		  @foreach(session('cart') as $id => $details)
			@php $total += $details['price'] * $details['quantity'] @endphp
			  <li class="list-group-item d-flex justify-content-between lh-condensed">
				 <div>
					<h6 class="my-0">{{ $details['name'] }}</h6>
				 </div>
				 <span class="text-muted">₹{{ $details['price'] * $details['quantity'] }}</span>
			  </li>
		   @endforeach
			  <li class="list-group-item d-flex justify-content-between">
				 <span>Total (INR)</span>
				 <strong>₹{{ $total }}</strong>
			  </li>		   
	   </ul>
	   @else
		<h4 class="d-flex justify-content-between align-items-center mb-3">
		  <span class="text-muted">Your cart</span>
		  <span class="badge badge-secondary badge-pill">{{ count((array) session('cart')) }}</span>
	   </h4>		
	   @endif   
	</div>
	<div class="col-md-8 order-md-1">
	   <h4 class="mb-3">Billing address</h4>
	   <form class="needs-validation" novalidate="" method="post" action="{{ '/order' }}">
		  @csrf
		  <div class="mb-3">
			 <label for="email">Name <span class="text-muted">*</span></label>
			 <input type="text" name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="xyz">
			 @error('name')
			 <div class="help-block"> {{ $message }}</div>
			 @enderror
		  </div>
		  <div class="mb-3">
			 <label for="email">Email <span class="text-muted">*</span></label>
			 <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="you@example.com">
			 @error('email')
			 <div class="help-block"> {{ $message }}</div>
			 @enderror
		  </div>
		  <div class="mb-3">
			 <label for="email">Mobile <span class="text-muted">*</span></label>
			 <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control" id="mobile" placeholder="999999">
			 @error('mobile')
			 <div class="help-block"> {{ $message }}</div>
			 @enderror
		  </div>
		  <div class="mb-3">
			 <label for="address">Address</label>
			 <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" placeholder="1234 Main St" required="">
			 @error('address')
			 <div class="help-block"> {{ $message }}</div>
			 @enderror
		  </div>
		  @if($total > 0)
		  <hr class="mb-4">
		  <button class="btn btn-primary btn-lg btn-block" type="submit">Order Confirm</button>
		  @endif
	   </form>
	</div>
</div>
@endsection
  
@section('scripts')
<script type="text/javascript">
  
</script>
@endsection