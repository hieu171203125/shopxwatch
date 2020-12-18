<?php  
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(Request $req){
        
        
        $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
        $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
        $product=DB::table('products')->where('status','1')->orderby('productID','desc')->paginate(6,['*'],'pageP');
        $discount=DB::table('products')->where('status','1')->where('discount','>','0')->orderby('productID','desc')->paginate(3,['*'],'pageD');
        $discount->setPageName('pageD');
        $product->setPageName('pageP');
        return view('pages.home')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product)->with('productDiscount',$discount);
    

}
public function show_category($category_ID){
   $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
   $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
   $all_product = DB::table('products')->join('categories','categories.categoryID','=','products.categoryID')->join('suppliers','suppliers.supplierID','=','products.supplierID')->where('products.categoryID',$category_ID)->orderby('productID','desc')->paginate(6);
   $name_category = DB::table('categories')->where('categoryID',$category_ID)->orderby('categoryID','desc')->get();
   return view('pages.category')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('all_product',$all_product)->with('name_category',$name_category);


}
public function show_supplier($supplier_ID){
 $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
 $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
 $all_product = DB::table('products')->join('categories','categories.categoryID','=','products.categoryID')->join('suppliers','suppliers.supplierID','=','products.supplierID')->where('products.supplierID',$supplier_ID)->orderby('productID','desc')->paginate(6);
 $name_supplier = DB::table('suppliers')->where('supplierID',$supplier_ID)->orderby('supplierID','desc')->get();
 return view('pages.supplier')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('all_product',$all_product)->with('name_supplier',$name_supplier);

}
public function detail($product_ID){
    $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
    $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
    $product=DB::table('products')->join('categories', 'products.categoryID', '=', 'categories.categoryID')->join('suppliers', 'products.supplierID', '=', 'suppliers.supplierID')->where('productID',$product_ID)->select('productID','productName','quantity','unitPrice','discount','status','products.description as description','thumbnail','image','companyName','address as supAdd','phone as supPhone','website as supWeb','categoryName')->get();
    $img = DB::table('products')->where('productID',$product_ID)->get();

    return view('pages.detail')->with('product',$product)->with('cate_product',$cate_product)->with('supplier',$supplier)->with('img',$img);
    

}
    // Truyền các tham số vào hàm này
public function doSearch()
{
  $pr= DB::table('products')->where('status','1')->orderby('productID','desc')->get();
  return $pr;
}
public function search_PR(Request $Request){
    $text = $Request->search;
    $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
    $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();

    $product=DB::table('products')->where('productName','like','%'.$text.'%')->orderby('productID','desc')->paginate(20);
    return view('pages.home')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product);

}
// public function homeSearch(Request $request){

//   $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
//   $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
//   $product=DB::table('products')->where('status','1')->orderby('productID','desc')->paginate(6);
//   $discount=DB::table('products')->where('status','1')->where('discount','>','0')->orderby('productID','desc')->paginate(3);
//   return view('pages.home')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product)->with('productDiscount',$discount);
//     $product=DB::table('products')->where('productName','like','%'.$text.'%')->orderby('productID','desc')->paginate(6,['*'],'page');
//     //$product= $this->doSearch();
//     // $discount=DB::table('products')->where('status','1')->where('discount','>','0')->orderby('productID','desc')->paginate(3,['*'],'pageD');
//     // $discount->setPageName('pageD');
//     // $product->setPageName('pageP');
//     return view('pages.home')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product)->with('searchStr',$text);

// }
    public function search($searchStr){
      
      $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
      $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
      $product=DB::table('products')->where('productName','like','%'.trim($searchStr).'%')->orderby('productID','desc')->paginate(6,['*'],'page');
      //$product= $this->doSearch();
      // $discount=DB::table('products')->where('status','1')->where('discount','>','0')->orderby('productID','desc')->paginate(3,['*'],'pageD');
      // $discount->setPageName('pageD');
      // $product->setPageName('pageP');
      //dd($product);
      return view('pages.home')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product)->with('searchStr',$searchStr);
  
      }
    public function homeSearch(Request $request){
    
      $cate_product=DB::table('categories')->orderby('categoryID','desc')->get();
      $supplier=DB::table('suppliers')->orderby('supplierID','desc')->get();
      $product=DB::table('products')->where('status','1')->orderby('productID','desc')->paginate(6);
      $discount=DB::table('products')->where('status','1')->where('discount','>','0')->orderby('productID','desc')->paginate(3);
      //$product= $this->doSearch();
        return view('pages.homeSearch')->with('cate_product',$cate_product)->with('supplier',$supplier)->with('product',$product)->with('productDiscount',$discount);
  
}

}