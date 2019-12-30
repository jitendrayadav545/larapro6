<?php

namespace App\Http\Controllers;
use App\Admin;
use App\category;
use App\news;
use App\Http\Requests\addcat;
use Session;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    function login()
	{
		return view("adminpages.login");
	}
	
	function postlogin(Request $req)
	{
		$em = $req->email;
		$pass = md5($req->password);
		
		//echo $em,$pass;
		
		$data = Admin::where(['email'=>$em,'password'=>$pass])->get();
			
		
		if(count($data)>0)
		{
			//echo "Login";
			Session::put('adminem',$em);
			return redirect('/admin/dashboard');			
		}
		else
		{
			//echo "Invalid";
			Session::flash('status','Invalid Login');
			return redirect('/admin');
		}
	}
	
	function dash()
	{
		$data = "Ducat";
		return view("adminpages.dashboard")->with('message',$data);
	}
	
	function category()
	{
		$cdata = category::get();
		
		return view("adminpages.category")->with('catdata',$cdata);
	}
	
	
	
	function addcategory()
	{
		return view("adminpages.addcategory");
	}
	
	
	function postaddcategory(addcat $req)
	{
		$cn = $req->category;
		$file = $req->file('image');
		
		$ext = $file->getClientOriginalExtension();
		$fnn = rand().'.'.$ext;
		
		$destinationpath = public_path('/attach');
		
		if($file->move($destinationpath,$fnn))
		{
			// obj = new modelname();
			$cat = new category();
				
			//obj->tablefieldname = data;
			$cat->category = $cn;
			$cat->image = $fnn;
			
			if($cat->save())
			{
				Session::flash('status',"Category Added Successfully");
				return redirect("/admin/category");
			}
		}	
		
	}
	
	
	
	function deletecategory($did,$dimg)
	{
		
		$cat = category::find($did); // it will automatically match from id column in table
		
		
			
		if($cat->delete())
		{
			$image = public_path().'/attach/'.$dimg;
			unlink($image);
			Session::flash('status',"Category Delete Successfully");
			return redirect('/admin/category');
		}
	}
	
	
	
	function editcategory($eid)
	{
		$cdata = category::where('id',$eid)->first();
		
		return view("adminpages.editcategory")->with('catdata',$cdata);
	}
	
	
	
	function posteditcategory(Request $req)
	{
		$hid = $req->hid;
		$himg = $req->himg;
		$cn = $req->category;
		$file = $req->file('image');
		
		if(empty($file))
		{
				
			$cat = category::find($hid);		
			$cat->category = $cn;			
			
			if($cat->save())
			{
				Session::flash('status',"Category Update Successfully");
				return redirect("/admin/category");
			}
		}
		else
		{
			$ext = $file->getClientOriginalExtension();
			$fnn = rand().'.'.$ext;
			
			$destinationpath = public_path('/attach');
			
			if($file->move($destinationpath,$fnn))
			{
				
				$cat = category::find($hid);
			
				$cat->category = $cn;
				$cat->image = $fnn;
				
				if($cat->save())
				{
					$oldfile = public_path().'/attach/'.$himg;
					unlink($oldfile);
					Session::flash('status',"Category Added Successfully");
					return redirect("/admin/category");
				}
			}
		}
		
		
	}
	
	
	
	function news()
	{
		return view("adminpages.news");
	}
	
	
	function addnews()
	{
		$cdata = category::get();
		return view("adminpages.addnews")->with('catdata',$cdata);
	}
	
	function postaddnews(Request $req)
	{
		/*
		$data = $res->all();
		echo "<pre>";
		print_r($data);
		echo "</pre>";		
		echo $data['cat'];
		*/
	
		
		$req->validate([
			'cat' => 'required',
			'title' => 'required|min:3|unique:news',
			'description' => 'required',
			'image' => 'required',
		]);
		
		
		//Remaining custom message
		
		
		$cn = $req->cat;
		$ti = $req->title;
		$desc = $req->description;
		$file = $req->file('image');
		
		$ext = $file->getClientOriginalExtension();
		$fnn = rand().'.'.$ext;
		
		$destinationpath = public_path('/attach');
		
		if($file->move($destinationpath,$fnn))
		{
			// obj = new modelname();
			$newstable= new news();
				
			//obj->tablefieldname = data;
			$newstable->category = $cn;
			$newstable->title = $ti;
			$newstable->description = $desc;
			$newstable->image = $fnn;
			
			if($newstable->save())
			{
				Session::flash('status',"News Added Successfully");
				return redirect("/admin/news");
			}
		}	
		
		
	}
	
	function logout()
	{
		Session::flush();
		return redirect('/admin');
	}
}
