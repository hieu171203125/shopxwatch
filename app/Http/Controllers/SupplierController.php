<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class SupplierController extends Controller
{
    //
	public function add_supplier(){
		return view('admin.add_supplier_product');
	}
	public function all_supplier(){
		$all_supplier_product = DB::table('suppliers')->paginate(4);
		$manager_supplier_product = view('admin.all_supplier_product')->with('all_supplier_product',$all_supplier_product);
		return view('admin_layout')->with('admin.all_supplier_product',$manager_supplier_product);
	}
	public function save_supplier(Request $Request){
		$data= array();
		$data['supplierID'] = $Request->supplierID;
		$data['companyName'] = $Request->companyName;
		$data['address'] = $Request->address;
		$data['phone'] = $Request->phone;
		$data['website'] = $Request->website;

		DB::table('suppliers')->insert($data);
		Session::put('message','thêm sản phẩm thành công');
		return Redirect::to('/add_supplier');
		
	}
	public function edit_supplier($supplier_id){

		$edit_supplier_product = DB::table('suppliers')->where('supplierID',$supplier_id)->get();
		$manager_supplier_product = view('admin.edit_supplier_product')->with('edit_supplier_product',$edit_supplier_product);
		return view('admin_layout')->with('admin.edit_supplier_product',$manager_supplier_product);
	}
	public function update_supplier(Request $Request , $supplier_id){
		$data= array();
		$data['supplierID'] = $Request->supplierID;
		$data['companyName'] = $Request->companyName;
		$data['address'] = $Request->address;
		$data['phone'] = $Request->phone;
		$data['website'] = $Request->website; 

		DB::table('suppliers')->where('supplierID',$supplier_id)->update($data);
		Session::put('message','Cập nhật sản phẩm thành công');
		return Redirect::to('/all_supplier');
	}
	public function delete_supplier($supplier_id){
		DB::table('suppliers')->where('supplierID',$supplier_id)->delete();
		Session::put('message','Cập nhật sản phẩm thành công');
		return Redirect::to('/all_supplier');
	}
}

