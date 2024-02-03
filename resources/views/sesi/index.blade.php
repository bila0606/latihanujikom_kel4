@extends('layout/aplikasi')

@section('konten')
    //memasukan class div punya whide 50 center biar ketengah border biar punya garis rounded tepiannya tidak siku
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>Login</h1>
        <form action="/sesi/login" method="POST">
            // masukan csrf menyiapkan untuk inputan hidden isinya adalah token 
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{ Session::get('email') }}">
                name="email" class="form-control">
             </div>
             <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn"
                "btn-primary">Login</button>
        </form>
    </div>
@endsection