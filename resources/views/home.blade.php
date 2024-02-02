@extends('app')
@section('content')
<p>Welcome <b> {{ Auth::user()->name }} </b></p>
@auth
    <a class="btn btn-primary" href="{{route('password')}}">Change Password</a>
    <a class="btn btn-danger" href="{{route('password')}}">Logout</a>
@endauth
@guest
    
@endguest
@endsection