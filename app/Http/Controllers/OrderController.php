<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class OrderController extends Controller
{
    //
	public function all_order(){
		$all_order = DB::table('orders')->orderby('status','asc')->orderby('orderDate','desc')->paginate(4);
		$manager_order_product = view('admin.all_order')->with('all_order',$all_order);
		return view('admin_layout')->with('admin.all_order',$manager_order_product);
    }
    public function order_detail($orderID){

        $order = DB::table('orders')->where('orderID',$orderID)->first();
        $customer=DB::table('customers')->where('customerID',$order->customerID)->first();
        $order_details = DB::table('orderdetail')->where('orderID',$order->orderID)->get();
        //dd($order_details);
        $query="SELECT * FROM products p WHERE p.productID in (''";
        foreach ($order_details as $key => $value) {
            # code...
            $query=$query.",'".$value->productID."'";
        }
        $query=$query.")";
        //dd($query);
        $products=DB::select( DB::raw($query));
        
        // dd($products);

        //dd($order_details);
		return view('admin.order_detail')->with('order',$order)->with('customer',$customer)->with('order_details',$order_details)->with('products',$products);
    }
    public function active_order($orderID){
        try {
            //code...
            DB::table('orders')->where('orderID',$orderID)->update(['status'=>1]);
            Session::put('message','Thay đổi thành công');
        } catch (\Throwable $th) {
            //throw $th;
            Session::put('message','Thay đổi thất bại');
        }
		return Redirect::to('/all_order');
	}
}

