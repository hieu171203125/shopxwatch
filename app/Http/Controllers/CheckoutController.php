<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Cart;

use Carbon\Carbon;

session_start();


class CheckoutController extends Controller
{	

	public function order()
	{
		if(Session::has('customer') == false){
			return redirect('/logincus');
		} else {
			if(!session::get('cart')||count(session('cart')->list)==0){
				Session::put('message','Cart is Empty!');
				return Redirect::to('/');
			}
			$supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
			$cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
			return view('pages.checkout')->with('cate_product',$cate_product)->with('supplier',$supplier);
		}
	}
	public function confirmOrder(Request $Request)
	{
		
		try {
                $products = session::get('cart')->list;
                $to_name = "X-watch";
                $to_email = $Request->email;//send to this email
				try {
					//code...
					$data = array("name"=>"X-watch","body"=>'Đặt hàng thành công',"products"=> $products); //body of mail.blade.php
                	Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

                    $message->to($to_email)->subject('Thông tin đặt hàng');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail

                });
				} catch (\Throwable $th) {
					//throw $th;
				}
				


                $order=array();
                $orderDetail=array();
                $i=DB::table('orders')->orderby('id','desc')->limit(1)->get();
                $orderId='ORDER'.($i[0]->id+1);
                $customerId=session::get('customer')->customerID;
                $order['customerId']=$customerId;
                $order['employeeId']='EM001';

                $order['orderId']=$orderId;
                $order['orderDate'] = Carbon::now('Asia/Ho_Chi_Minh')->todatetimestring();
                $order['status'] = 0;
                DB::table('orders')->insert($order);
			//end insert orders
                $orderDetail['orderId']=$orderId;
                foreach (session::get('cart')->list as $key => $value) 
                {
				# code...
                	$orderDetail['productId']=$key;
                	$orderDetail['quantity']=$value['quantity'];
                	$orderDetail['unitPrice']=$value['info']->unitPrice;
                	$orderDetail['discount']=$value['info']->discount;
				// insert orderDetail
                	DB::table('orderdetail')->insert($orderDetail);
                	echo "TC\n";
                }
                $data = array();
                $data['fullName'] = $Request->fullName;
                $data['email'] = $Request->email;
                $data['phone'] = $Request->phone;
                $data['address'] = $Request->address;
                DB::table('customers')->where('customerID',$Request->customerID)->update($data);
                              
                $cart = Session::get('cart');

                foreach ($cart->list as $key => $value) 
                {
                	$oldProduct = DB::table('products')->where('productID',$value['info']->productID)->get('quantity');
                	$hientai = $oldProduct['0']->quantity; 
                	$giohang = $value['quantity'];

                	$new = array();
                	$new['quantity'] = $hientai - $giohang;

                	DB::table('products')
                	->where('productID', $value['info']->productID)
                	->update(['quantity' => $new['quantity']]);
                }
				Session::put('message','Order successfully');
				Session::forget('cart');
            } 
            catch (Exception $e) 
            {
            	Session::put('message','Order Error! ');
            }
            return Redirect::to('/');	

        }
        public function confirm_order(Request $Request)
        {
        	$data = $Request->all();
			// Lay thong tin order
        	$order=array();
        	$orderDetail=array();
        	$order['name_cus']=$data['name_cus'];			
        	$order['email_cus']=$data['email_cus'];
        	$order['address_cus']=$data['address_cus'];		
        	$order['phone_cus']=$data['phone_cus'];
        	$order['text_ćus']=$data['text_cus'];
        	$order['_token']=$data['_token'];
        	$i=count(DB::table('orders')->get())+1;
        	$orderId='ORDER'.$i;
        	$order['orderId']=$orderId;

			// Lay thong tin orders detail
        	$orderDetail['orderId']=$orderId;
        	foreach (session::get('cart')->list as $key => $value) {
			# code...
        		$orderDetail['productId']=$key;
        		$orderDetail['quantity']=$value['quantity'];
        		$orderDetail['unitPrice']=$value['info']->unitPrice;
        		$orderDetail['discount']=$value['info']->discount;
        	}
			// them order va order detail vao DB
        	print_r($data);
		// try{
		// 	DB::table('orders')->insert($order);
		// 	DB::table('orderdetail')->insert($orderDetail);	
		// 		//huy cart

		// 	echo 'Thanh Cong';
		// }
		// catch (Exception $e){
		// 	echo 'That bai';
		// }
        }

    }

			//print_r($oder) ;
			// Return view('pages.checkout')->with('data',$data);



