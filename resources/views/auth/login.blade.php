@extends('layouts.auth')

@section('content')

<section id="auth-section">
    <h1>Login</h1>
    <form action="{{ route('login') }}" id="loginForm" method="POST">

        @csrf

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>    
        @enderror
        <input type="email" name="email" id="" placeholder="Enter your email" value="{{ old('email') ? old('email') : '' }}">

        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>    
        @enderror
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Login">
    </form>

</section>

@endsection