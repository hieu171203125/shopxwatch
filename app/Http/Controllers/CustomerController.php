<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;
session_start();

class CustomerController extends Controller
{
	public function checklogin(Request $Request)
	{ 
		$cate_product = $this->getcate();
		$supplier = $this->getsup();
		$result = DB::table('customers')->where('email',$Request->email)->where('password',$Request->password)->first();
		if($result){
			session::put('customer',$result);
			return redirect('/');
		} else {
			session::put('message','Sai tài khoản hoặc mật khẩu');
			return view('pages.logincus')->with('cate_product',$cate_product)->with('supplier',$supplier);          
		}
	}
	public function add_cus(Request $Request)
	{
		$data= array();
		$data['fullName'] = $Request->fullName;
		$data['password'] = $Request->password;
		$data['email'] = $Request->email;
		$data['customerID'] = $Request->customerID;
		$data['address'] = $Request->address;
		$data['phone'] = $Request->phone;
		DB::table('customers')->insert($data);
		return redirect('/logincus');

	}
	public function logoutcus()
	{
		session::flush();
		return redirect('/logincus');
	}
	public function logincus(Request $Request)
	{ 
		$cate_product = $this->getcate();
		$supplier = $this->getsup();
		return view('pages.logincus')->with('cate_product',$cate_product)->with('supplier',$supplier);
	}
	public function getsup()
	{
		$supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
		return $supplier;
	}
	public function getcate()
	{
		$cate_product=DB::table('categories')->orderby('categoryID','desc')->get();	
		return $cate_product;
	}
	public function checkcus()
	{
		if (Session::has('customer')) {
			return redirect('/');
		}
		else{
			return redirect('/');
		}
	}
	public function getinfo_facebook()
	{
		return Socialite::driver('facebook')->redirect();

	}
	public function checkinfo_facebook()
	{
    	// $info = Socialite::driver('facebook')->user();
    	// dd($info);
		echo 'thanh cong';
	}
	public function redirectToProvider()
	{
		return Socialite::driver('facebook')->redirect();
	}


	public function handleProviderCallback()
	{

		$user = Socialite::driver('facebook')->user();
		
		echo $user->email;
		$customer = DB::table('customers')->where('email',$user->email)->first();
		if($customer){
			Session::put('customer',$customer);
			return redirect::to('/');
			
		} else {
			$newCus = array();
			$i=count(DB::table('customers')->get())+1;
			$CustomerId='CUS'.$i;
			$newCus['customerID'] = $CustomerId;
			$newCus['password'] = '123';
			$newCus['email'] = $user->email;
			$newCus['fullName'] = $user->name;
			print_r($newCus);
			DB::table('customers')->insert($newCus);
			return redirect('login/facebook');
			
		}


	}

}

