@extends('adminpages.master')


@section('title','Edit Category')



@section('container')
	<h2>Edit Category</h2>

	
			
			
		

	
			{!! Form::open(array('url'=>'admin/posteditcategory','enctype'=>'multipart/form-data')) !!}
			
				{{Form::hidden('hid',$catdata->id)}}
				{{Form::hidden('himg',$catdata->image)}}
			
			
				<div class="form-group">
					{{Form::label('Category Name')}}
					{{Form::text('category',$catdata->category,['class'=>'form-control'])}}
				
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