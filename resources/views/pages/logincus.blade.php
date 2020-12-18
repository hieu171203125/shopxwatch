@extends('layout')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					<form action="{{URL::TO('/checklogin')}}" method="post">
						{{ csrf_field() }}
						<?php 
						$message = Session::get('message');
						if($message)
						{
							echo '<span class ="text-alert">' .$message. '</span>';
							Session::put('message',null);
						}
						?>
						<input name="email" type="email" placeholder="Email" />
						<input name="password" type="password" placeholder="Password" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
						<a type="button" class="btn btn-default" href="{{URL::TO('/login/facebook')}}">Login with Facebook</a>
					</form>

				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="{{URL::TO('/add_cus')}}" method="post">
						{{ csrf_field() }}
						<input type="text" placeholder="Name" name="fullName" required />
						<input type="email" placeholder="Email" name="email" required/>
						<input type="password" placeholder="Password" name="password" required="" />
					
					
						<input type="text" placeholder="Address" name="address" required/>
						<input type="number" placeholder="Phone" name="phone" required/>
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection