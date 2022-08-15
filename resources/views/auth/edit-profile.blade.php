@extends('layouts.auth')

@section('content')

<section class="left-content">

    <form action="{{ route('user-profile-information.update', auth()->user()->id) }}" id="createForm" method="POST">
        @method('PUT')
        @csrf

        <h1>Edit Profile: </h1>
        @if($errors->updateProfileInformation->any())

            @foreach ($errors->updateProfileInformation->all() as $error )
                <div class="alert alert-danger">{{ $error }}</div>    
            @endforeach

        @endif

        <input type="name" name="name" id=""  value="{{ auth()->user()->name }}">
        <input type="email" name="email" id="" value="{{ auth()->user()->email }}">
    </form>


    <form  id="createForm" action="{{ route('user-password.update', auth()->user()->id) }}" method="POST">
        @method("PUT")
        @csrf

        <h1>Change password: </h1>
        @if($errors->updatePassword->any())

        @foreach ($errors->updatePassword->all() as $error )
            <div class="alert alert-danger">{{ $error }}</div>    
        @endforeach

    @endif
        <input type="password" name="current_password" id="" placeholder="Enter your current password">
        <input type="password" name="password" placeholder="Enter you new password">
        <input type="password" name="password_confirmation" id="" placeholder="Confirm your new password">
        <input type="submit" value="Save">
    </form>

</section>


@include('includes.authAside')
    
@endsection