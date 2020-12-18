<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Cart;
session_start();

class CartController extends Controller
{
	
    public function add_cart(Request $Request,$productID){
    	$cate_product = $this->getcate();
    	$supplier = $this->getsup();
    	$product = DB::table('products')->where('productID',$productID)->first();
        $quantiti = $Request->quantity;
        if($product != null){
        	$oldcart = Session('cart')?Session::get('cart'):null;
        	$newcart =new Cart($oldcart);
        	$newcart->AddCart($product,$productID,$quantiti);
        	Session::put('cart',$newcart);
        }
        return  redirect('/show-cart');
        // return redirect('/detail/'.$productID)->with('newcart',$newcart)->with('cate_product',$cate_product)->with('supplier',$supplier);
    }
    public function add_cart_home($productID){
        $cate_product = $this->getcate();
        $supplier = $this->getsup();
        $product = DB::table('products')->where('productID',$productID)->first();
        $quantiti = 1;
        if($product != null){
            $oldcart = Session('cart')?Session::get('cart'):null;
            $newcart =new Cart($oldcart);
            $newcart->AddCart($product,$productID,$quantiti);
            Session::put('cart',$newcart);
        }
        return  redirect('/show-cart');
        //return redirect('/')->with('newcart',$newcart)->with('cate_product',$cate_product)->with('supplier',$supplier);
    }
    public function Show_cart()
    {
        $cate_product = $this->getcate();
        $supplier = $this->getsup();
        
        $oldcart = Session('cart')?Session::get('cart'):null;
        $newcart = $oldcart;
        Session::put('cart',$newcart);
        return view('pages.cart')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('newcart',$newcart);
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
public function del_cart($productID)
{
    $cate_product = $this->getcate();
    $supplier = $this->getsup();
    $oldcart = Session('cart')?Session::get('cart'):null;
    $newcart = new Cart($oldcart);
    $newcart->delete_cart($productID);
    Session::put('cart',$newcart);
    return redirect('/show-cart');
}

public function getall()
{
    $data1 =array();
    $data1['pr']=DB::table('products')->where('status','1')->orderby('productID','desc')->get();
    $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
    $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
    $pr= DB::table('products')->where('status','1')->orderby('productID','desc')->get();
    $data = with('cate_product',$cate_product)->with('supplier',$supplier)->with('pr',$pr);
    return $data1;
}
//Update cart
public function update_cart(Request $request)
{
    $cate_product = $this->getcate();
    $supplier = $this->getsup();

    $oldcart = Session('cart')?Session::get('cart'):null;
    //dd($oldcart);
    $newcart = $request->request;

//    dd(array_key_exists("PRO0013",$oldcart));
    foreach ($newcart as $key => $value) {
        # code...
        if(array_key_exists($key,$oldcart->list))
        {
            $oldcart->list[$key]['quantity']=$value;
        }
        
    }

   // dd($oldcart);
    //dd($newcart);
    Session::put('cart',$oldcart);
    //dd($newcart);
    return redirect('/show-cart');
}


}
