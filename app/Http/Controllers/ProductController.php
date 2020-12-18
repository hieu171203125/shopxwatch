<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
	public function checklogin(){
		$admin_id = Session::get('admin_id');
		if($admin_id){
			return redirect('dashboard');
		}
		else{
			echo 'Không có quyền truy cập , vui lòng đăng nhập' ;
			return redirect('admin')->send();
		}

	}
    //
	public function add_product(){
		$this->checklogin();

		$cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
		$sup_product=DB::table('suppliers')->orderby('supplierID','desc')->get();

		return view('admin.add_product')->with('cate_product',$cate_product)->with('sup_product',$sup_product);
	}
	public function all_product(){
		$this->checklogin();
		
		$all_product = DB::table('products')->
		join('categories','categories.categoryID','=','products.categoryID')->join('suppliers','suppliers.supplierID','=','products.supplierID')->orderby('productID','desc')->paginate(10);
		$manager_product = view('admin.all_product')->with('all_product',$all_product);

		return view('admin_layout')->with('admin.all_product',$manager_product);
	}
	public function save_product(Request $Request){
		$data= array();
		$data['productID'] = $Request->productID;
		$data['productName'] = $Request->productName;
		$data['categoryID'] = $Request->categoryID;
		$data['supplierID'] = $Request->supplierID;
		$data['quantity'] = $Request->quantity;
		$data['unitPrice'] = $Request->unitPrice;
		$data['discount'] = $Request->discount;
		$data['status'] = $Request->status;			
		$data['description'] = $Request->description;	
		$get_img = $Request->file('thumbnail');
		
		if($get_img){
			$new_img = $get_img->getClientOriginalName();
			$get_img->move('public/upload/products',$new_img);
			$data['thumbnail'] = $new_img;
		}else{
			$data['thumbnail'] = '';
		}

		$get_img1 = $Request->file('image');
		// dd($get_img1);
		if($get_img1){
			$newimg = "";
			foreach ($get_img1 as $key => $value) {
				$value->move('public/upload/products',$value->getClientOriginalName());	
				$newimg = trim($newimg.$value->getClientOriginalName().';');		
			}
			$data['image'] = $newimg;
		}else{
			$data['image'] = '';
		}
		DB::table('products')->insert($data);
		Session::put('message','thêm sản phẩm thành công');
		return Redirect::to('/add_product');

		
		
	}
	public function unactive_product($product_id){
		try {
			//code...
			DB::table('products')->where('productID',$product_id)->update(['status'=>0]);
			Session::put('message','Thay đổi thành công');
		} catch (\Throwable $th) {
			//throw $th;
			Session::put('message','Thay đổi thất bại');
		}
		
		return Redirect::to('/all_product');
	}
	public function active_product($product_id){
		DB::table('products')->where('productID',$product_id)->update(['status'=>1]);
		Session::put('message','Thay đổi thành công');
		return Redirect::to('/all_product');
	}
	public function edit_product($product_id){
		$this->checklogin();

		$cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
		$sup_product=DB::table('suppliers')->orderby('supplierID','desc')->get();

		$edit_product = DB::table('products')->where('productID',$product_id)->get();
		$manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('sup_product',$sup_product);
		return view('admin_layout')->with('admin.edit_product',$manager_product);
	}
	public function update_product(Request $Request , $product_id){
		$this->checklogin();
		$data= array();
		$data['productID'] = $Request->productID;
		$data['productName'] = $Request->productName;
		$data['categoryID'] = $Request->categoryID;
		$data['supplierID'] = $Request->supplierID;
		$data['quantity'] = $Request->quantity;
		$data['unitPrice'] = $Request->unitPrice;
		$data['discount'] = $Request->discount;
		$data['status'] = $Request->status;			
		$data['description'] = $Request->description;	
		$get_img = $Request->file('thumbnail');
		
		if($get_img){
			$new_img = $get_img->getClientOriginalName();
			$get_img->move('public/upload/products',$new_img);
			$data['thumbnail'] = $new_img;
		}

		$get_img1 = $Request->file('image');
		// dd($get_img1);
		if($get_img1){
			$newimg = "";
			foreach ($get_img1 as $key => $value) {
				$value->move('public/upload/products',$value->getClientOriginalName());	
				$newimg = trim($newimg.$value->getClientOriginalName().';');		
			}
			$data['image'] = $newimg;
		}
		DB::table('products')->where('productID',$product_id)->update($data);
		Session::put('message','Cập nhật sản phẩm thành công');
		return Redirect::to('/all_product');
	}
	public function delete_product($product_id){
		DB::table('products')->where('productID',$product_id)->delete();
		Session::put('message','Xóa sản phẩm thành công');
		return Redirect::to('/all_product');
	}
}
