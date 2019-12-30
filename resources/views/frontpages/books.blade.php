@extends('frontpages.master')

@section('title','Books')






@section('container')

<script>
	$(document).ready(function()
	{
		$('.addcart').click(function()
		{
			var bid = $(this).attr('bid');
			var bname = $(this).attr('bname');
			var bimage = $(this).attr('bimage');
			var bprice = $(this).attr('bprice');
			var bquan = $('.hquan').val();
			
			
			
			$.ajax({
				url : 'http://localhost/larapro6/addcart',
				method : 'get',
				data : {bookid:bid,bookname:bname,bookimage:bimage,bookprice:bprice,bookquan:bquan},
				success: function(res)
				{
					alert(res);
					location.reload();
				},
				error : function()
				{
					alert('Not Working');
				}
			})
		})
	})

</script>




	<h1>Books</h1>
	

	@foreach($bookdata as $bd)
		<div style="display:inline-block; margin:20px;">
			<div><img src="{{asset('public/attach/'.$bd->image)}}" height="200" width="150"></div>
			<div style="text-align:center; font-weight:bold;">{{$bd->name}}</div>
			<div style="text-align:center; font-weight:bold;">{{$bd->price}}</div>
			<input type="hidden" class="hquan" value="1">
			<div style="text-align:center;">			
			<input type="button" value="Add Cart" class="addcart" bid="{{$bd->id}}" bname="{{$bd->name}}" bimage="{{$bd->image}}" bprice="{{$bd->price}}"></div>
		</div>
	@endforeach	
		
@endsection