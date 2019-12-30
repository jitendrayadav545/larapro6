@extends('adminpages.master')


@section('title','Add Category')



@section('container')
	<h2>Add Category</h2>

	
			@if($errors->any())
				<ul>
					@foreach($errors->all() as $err)
						<li class="text-danger">{{$err}}</li>
					@endforeach
				</ul>
			@endif
			
		

	
			{!! Form::open(array('url'=>'admin/postaddcategory','enctype'=>'multipart/form-data')) !!}
			
				<div class="form-group">
					{{Form::label('Category Name')}}
					{{Form::text('category','',['class'=>'form-control'])}}
					<label class="text-danger">{{$errors->first('category')}}</label>
				</div>
				
				<div class="form-group">
					{{Form::label('Image')}}
					{{Form::file('image',['class'=>'form-control'])}}
					<label class="text-danger">{{$errors->first('image')}}</label>
				</div>
				
				<div class="form-group">
						{{Form::submit('Submit',['class'=>'btn btn-success'])}}
				
				</div>
				
			{!! Form::close() !!}
@endsection