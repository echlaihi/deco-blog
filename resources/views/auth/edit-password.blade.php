@extends('layouts.auth')

@section('content')

<section class="left-content">

    <form action="{{ route('user-password.update') }}"  method="POST" id="createForm">
        <h1>Change password: </h1>


        @method("PUT")
        @csrf

        @if ( $errors->updatePassword->any() ) 

            @foreach ($errors->updatePassword->all() as  $error)
                <div class="alert alert-danger">{{ $error }}</div>    
            @endforeach

        @endif
       

        <input type="password" name="current_password" placeholder="Enter your current password">
        <input type="password" name="password" placeholder="Enter your new password">
        <input type="submit" value="Save">
    </form>

</section>


@include('includes.authAside')
    
@endsection