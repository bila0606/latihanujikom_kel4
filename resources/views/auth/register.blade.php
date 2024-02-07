<!-- File: resources/views/auth/login.blade.php -->

@extends('template_auth.layout')

@section('content')
<div class="my-auto page page-h">
			<div class="main-signin-wrapper">
				<div class="main-card-signin d-md-flex">
				<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
					<div class="my-auto authentication-pages">
						<div>
							<!-- <img src="{{asset('')}}assets/img/brand/logo-white.png" class=" m-0 mb-4" alt="logo"> -->
							<h5 class="mb-4">KELOMPOK 4 UJIKOM GACOR</h5>
							<p class="mb-5">PERPUSTAKAAN DIGITAL.</p>
							<a href="index.html" class="btn btn-success">Learn More</a>
						</div>
					</div>
				</div>
				<div class="sign-up-body wd-md-50p">
					<div class="main-signin-header">
						<h2>Welcome back!</h2>
						<h4>Please sign in to continue</h4>
						<form action="index.html">
							<div class="form-group">
								<label>Username</label
								><input class="form-control" placeholder="Enter your username" type="text" >
							</div>
                            <div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="Enter your email" type="text" >
							</div>
                            <div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Enter your password" type="password" >
							</div>
							<div class="form-group">
								<label>Nama Lengkap</label> 
								<input class="form-control" placeholder="Enter your nama lengkap" type="text" >
							</div>
                            <div class="form-group">
								<label>Alamat</label> 
								<input class="form-control" placeholder="Enter your alamat" type="text" >
							</div>
                            <div class="form-group">
								<label>Hak Akses</label> 
                                <select name='namerole' id="f1" class="form-control select2" onchange="reload_table()"> 
                                <option value="">=== pilih ===</option> 
                                <option value="administrator" @if(request()->get('f1')==1) selected @endif>administrator</option> 
                                <option value="operator" @if(request()->get('f1')==2) selected @endif>operator</option> 
                            </select>     
							</div>
                            
                            <button class="btn btn-primary btn-block">Sign In</button>
							<div class="form-group">
							</div><button class="btn btn-primary btn-block">Sign Out</button>
						</form>
					</div>
                    
					<!-- <div class="main-signin-footer mt-3 mg-t-5">
						<p><a href="">Forgot password?</a></p>
						<p>Don't have an account? <a href="page-signup.html">Create an Account</a></p>
					</div> -->
				</div>
			</div>
			</div>
		</div>
@endsection