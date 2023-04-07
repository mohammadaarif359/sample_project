@extends('admin.layouts.main')

@section('content')
<section class="content">
  <div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
		<div class="card card-primary">
		  <div class="card-header">
			<h3 class="card-title">Edit Product <small></small></h3>
		  </div>
		  <form role="form" id="quickForm" method="POST" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
			@csrf
			<input type='hidden' name='id' value="{{ $product->id }}">
			<div class="card-body">
			  <div class="row">
				<div class="col-md-6">
				  <div class="form-group">
					<label for="name">Name</label>
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$product['name']) }}" autocomplete="name" autofocus>
					@error('name')
						<span class="error invalid-feedback">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				  </div>
				</div>
				<div class="col-md-6">		
				  <div class="form-group">
					<label for="name">Price</label>
					<input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$product['price']) }}" autocomplete="price" autofocus>
					@error('price')
						<span class="error invalid-feedback">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				  </div>
				</div>
				<div class="col-md-6">		
				  <div class="form-group">
					<label for="name">Image
						@if(!empty($product->image_url))
							<a href="{{ $product->image_url }}">| Download</a>	
						@endif
					</label>
					<div class="custom-file">
					  <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
					  <label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					@error('image')
						<span class="error invalid-feedback">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="form-group">
					<label for="name">Desription</label>
					<textarea id="description" rows="3" cols="10" class="form-control @error('description') is-invalid @enderror" name="description" autofocus>{{ old('description',$product['description']) }}</textarea>
					@error('description')
						<span class="error invalid-feedback">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				  </div>
				</div>
			  </div>			
			</div>
			<div class="card-footer">
			  <button type="submit" class="btn btn-primary">Update</button>
			</div>
		  </form>
		</div>
		</div>
	  <div class="col-md-6">

	  </div>
	</div>
  </div>
</section>
@endsection