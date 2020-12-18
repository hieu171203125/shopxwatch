<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryController extends Controller
{
	    //
	public function add_category_product(){
		return view('admin.add_category_product');
	}
	public function all_category_product(){
		$all_category_product = DB::table('categories')->paginate(4);
		$manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
		return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
	}
	public function save_category_product(Request $Request){
		$data= array();
		$data['categoryID'] = $Request->categoryID;
		$data['categoryName'] = $Request->categoryName;
		$data['description'] = $Request->description;

		DB::table('categories')->insert($data);
		Session::put('message','thêm  danh mục thành công');
		return Redirect::to('/add_category_product');
		
	}

	public function edit_category_product($category_product_id){

		$edit_category_product = DB::table('categories')->where('categoryID',$category_product_id)->get();
		$manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
		return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
	}
	public function update_category_product(Request $Request , $category_product_id){
		$data= array();
		$data['categoryID'] = $Request->categoryID;
		$data['categoryName'] = $Request->categoryName;
		$data['description'] = $Request->description; 

		DB::table('categories')->where('categoryID',$category_product_id)->update($data);
		Session::put('message','Cập nhật danh mục thành công');
		return Redirect::to('/all_category_product');
	}
	public function delete_category_product($category_product_id){
    DB::table('categories')->where('categoryID',$category_product_id)->delete();
		Session::put('message','xóa danh mục thành công');
		return Redirect::to('/all_category_product');
	}

}
