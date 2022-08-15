@extends('layouts.auth')

@section('content')

<section id="auth-section">
    <h1>register</h1>
    <form action="{{ route('register') }}" id="loginForm" method="POST">
        @csrf
        

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>    
        @enderror
        <input type="text" name="name" id="" placeholder="Enter your name" value="{{ old('name') ? old('name') : '' }}">

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>    
        @enderror
        <input type="email" name="email" id="" placeholder="Enter your email" value="{{ old('email') ? old('email') : '' }}">

        @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="password" name="password" placeholder="Enter your password">

        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>    
        @enderror
        <input type="password" name="password_confirmation" placeholder="Enter your password confirmation">
        <input type="submit" value="Register">
    </form>
</section>
    
@endsection