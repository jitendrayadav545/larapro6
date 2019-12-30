@extends('frontpages.master')

@section('title','Digital Newsletter')






@section('container')


	

	@foreach($categorydata as $cd)

	<div class="wthree-top">
					<div class="w3agile-top">
						<div class="w3agile_special_deals_grid_left_grid">
							<a href="singlepage.html"><img src="{{asset('public/attach/'.$cd->image)}}" class="img-responsive" alt="" /></a>
						</div>
						<div class="w3agile-middle">
						<ul>
							<li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</a></li>
							<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>201 LIKES</a></li>
							<li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>15 COMMENTS</a></li>
							
						</ul>
					</div>
					</div>
					
					<div class="w3agile-bottom">
						<div class="col-md-3 w3agile-left">
							<h5>Sit amet consectetur</h5>
						</div>
						<div class="col-md-9 w3agile-right">
							<h3><a href="singlepage.html">{{$cd->title}}</a></h3>
							<p align="justify">
							@php
								echo substr($cd->description,0,250);
							@endphp
							.......
							</p>
							<a class="agileits w3layouts" href="{{url('/newsdetails/'.$cd->id)}}">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>
			
			
		@endforeach
		
	
		
@endsection