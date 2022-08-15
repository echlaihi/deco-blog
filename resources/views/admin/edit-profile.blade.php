@extends('admin.layout')

@section('table')

{{-- <div class="panel panel-default"> --}}
    
    <form class="form-horizontal" role="form" method="POST" style="border: 2px solid #333;" action="{{ route('user-profile-information.update') }}">
        @method("PUT")
        @csrf

        
        <div class="h3" style="padding: 1rem; margin-top: 4rem; ">Update profile:</div>
        @if($errors->updateProfileInformation->any())

            <div class="form-group">

              @foreach($errors->updateProfileInformation->all() as $error)
                <div class="alert alert-danger col-sm-7 col-sm-offset-3" style="width: 54%;
                padding: 1rem;
                margin-bottom: 7px;
                margin-left: 27%;">{{ $error }}</div>
              @endforeach

            </div>

        @endif
           <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Name: </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
              </div>
          </div>

          <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Email: </label>
              <div class="col-sm-7">
                  <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" >
              </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
              <button type="submit" class="btn btn-default">update</button>
            </div>
          </div>
    </form>

    <form role="form" method="POST" style="border: 2px solid #333; margin-top: 3rem;"  action="{{ route('user-password.update', auth()->user()->id) }}" class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="h3" style="padding: 1rem; margin-top: 4rem;">Update password: </div>
        @if($errors->updatePassword->any())

            <div class="form-group">

              @foreach($errors->updatePassword->all() as $error)
                <div class="alert alert-danger col-sm-7 col-sm-offset-3" style="width: 54%;
                padding: 1rem;
                margin-bottom: 7px;
                margin-left: 27%;">{{ $error }}</div>
              @endforeach

            </div>

         @endif
          <div class="form-group">
            <label for="" class="control-label col-sm-3">Current password: </label>
            <div class="col-sm-7">
              <input type="password" class="form-control" name="current_password">
            </div>
        </div>
            
            <div class="form-group">
                <label for="inputPassword3" class="control-label col-sm-3">New Password: </label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="control-label col-sm-3">Confirm your password: </label>
              <div class="col-sm-7">
                  <input type="password" class="form-control" name="password_confirmation">
              </div>
          </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                  <button type="submit" class="btn btn-default">update</button>
                </div>
              </div>

    </form>
       

{{-- </div> --}}

  @endsection
