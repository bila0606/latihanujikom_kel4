@extends('template_auth.layout')

@section('content')
<div class="my-auto page page-h">
			<div class="main-signin-wrapper">
				<div class="main-card-signin d-md-flex">
				<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
					<div class="my-auto authentication-pages">
						<div>
							<h5 class="mb-4">KELOMPOK 4 UJIKOM GACOR</h5>
							<p class="mb-5">APLIKASI PERPUSTAKAAN DIGITAL</p>
							<a href="index.html" class="btn btn-success">Learn More</a>
						</div>
					</div>
				</div>
				<div class="sign-up-body wd-md-50p">
					<div class="main-signin-header">
						<h2>Selamat Datang!</h2>
						<h4>Tolong masuk untuk melanjutkan</h4>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="Enter your email" type="text" value="admin1234@gmail.com">
							</div>
							<div class="form-group">
								<label>Password</label> 
								<input class="form-control" placeholder="Enter your password" type="password"  value="admin123">
							</div><button class="btn btn-primary btn-block">Masuk</button>

						</form>
					</div>
					<div class="main-signin-footer mt-3 mg-t-5">
						<p><a href="">Lupa password?</a></p>
						<p>Belum punya akun? <a href="page-signup.html">Buat akun</a></p>
					</div>
				</div>
			</div>
			</div>
		</div>
@endsection