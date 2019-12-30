@extends('adminpages.master')


@section('title','Add News')



@section('container')
	<h2>Add News</h2>

	@if($errors->any())
				<ul>
					@foreach($errors->all() as $err)
						<li class="text-danger">{{$err}}</li>
					@endforeach
				</ul>
			@endif
		
		

	
			{!! Form::open(array('url'=>'admin/postaddnews','enctype'=>'multipart/form-data')) !!}
			
				<div class="form-group">
					{{Form::label('Category Name')}}
					
					<select name="cat" class="form-control">
						<option hidden value="">Select</option>
						
						@foreach($catdata as $cd)
							<option>{{$cd->category}}</option>
						@endforeach
					</select>
					
				</div>
				
				<div class="form-group">
					{{Form::label('Title')}}
					{{Form::text('title','',['class'=>'form-control'])}}
					
				</div>
				
				<div class="form-group">
					{{Form::label('Description')}}
					{{Form::textarea('description','',['class'=>'form-control'])}}
					
				</div>
				
				<div class="form-group">
					{{Form::label('Image')}}
					{{Form::file('image',['class'=>'form-control'])}}
					
				</div>
				
				<div class="form-group">
						{{Form::submit('Submit',['class'=>'btn btn-success'])}}
				
				</div>
				
			{!! Form::close() !!}
@endsection