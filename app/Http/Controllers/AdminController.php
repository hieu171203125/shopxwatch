<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function checklogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        }
        else{
            Session::put('message','Không có quyền truy cập');
            return redirect('admin')->send();
        }
    }
    public function index(){
      return view('admin_login');
  }
  public function show_dashboard(){
    $this->checklogin();
      return view('admin.dashboard');
  }
  public function dashboard(Request $request){
      $admin_email = $request->admin_email;
      $admin_password = $request->admin_password;   
      $result = DB::table('employees')->where('email',$admin_email)->where('password',$admin_password)->first();
      if($result)
      {
       session::put('employeeName',$result->employeeName);
      session::put('admin_id',$result->id);
            //return redirect::to('/dashboard');

         return redirect('/dashboard');
        
     }
     else{
         session::put('message','Tài khoản hoặc mật khẩu không đúng');
         return Redirect::to('/admin');
     }

 }
   public function logoutdashboard(Request $request){

     Session::put('employeeName',null);
     Session::put('admin_id',null);
     return Redirect::to('/admin');
 } 
}
