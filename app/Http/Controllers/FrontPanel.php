<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // for use query builder database or fluent  
use Anam\Phpcart\Cart;
use Illuminate\Http\Request;

class FrontPanel extends Controller
{
    function index()
	{
		$cdata = DB::table('categories')->get();
		$news = DB::table('news')->orderBy('created_at','desc')->paginate(2);
		return view("frontpages.front")->with('catdata',$cdata)->with('newsdata',$news);
	}
	
	
	function category($cn)
	{
		$cdata = DB::table('categories')->get();
		$catdata = DB::table('news')->where('category',$cn)->get();
		return view("frontpages.category")->with('catdata',$cdata)->with('categorydata',$catdata);
	}
	
	function newsdetail($nid)
	{
		$cdata = DB::table('categories')->get();
		$ndata = DB::table('news')->where('id',$nid)->get();
		return view("frontpages.newsdetails")->with('catdata',$cdata)->with('newsdata',$ndata);
	}
	
	function books()
	{
		$cart = new Cart();
		$ti = $cart->count();
		$tp = $cart->getTotal();
		
		$cdata = DB::table('categories')->get();
		$bdata = DB::table('books')->get();		
		
		return view("frontpages.books")->with('catdata',$cdata)->with('bookdata',$bdata)->with('totalitems',$ti)->with('totalprice',$tp);
	}
	
	function addcart()
	{
		extract($_GET);
		
		$arr = [
			'id' => $bookid,
			'name' => $bookname,
			'image'	=>	$bookimage,
			'price'	=> $bookprice,
			'quantity'	=>$bookquan
		];
		
		//print_r($arr);
		
		
		$cart = new Cart();
		
		if($cart->add($arr))
		{
			echo "Cart Added Successfully";
		}
		
		
	}
	
}
