@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-3 ">
    <div class="card">
        <div class="card-body box-profile">

            <div class="text-center">
                <div class="text-center">
                    @if(Auth::user()->avatar)
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/storage/image/'. Auth::user()->avatar)}}"
                       alt="User profile picture">
                       @else
                    <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/storage/image/avatar.png')}}"
                       alt="User profile picture">
                       @endif
                </div>
            </div><br/><br/>

        <form action="{{ route('profile.changepassword') }}" method="POST" >
                @csrf

                <div class="form-group">
                    <label for="currentpassword" >{{ __('Current Password') }}</label>

                    <div class="input-group">
                        <input id="currentpassword" type="password" class="form-control" name="currentpassword" required >
                    </div>

                    @if(session('msg_currentpassword'))
                    <p class="text-red">{{ session('msg_currentpassword') }}</p>
                     @endif

                </div>

                <div class="form-group">
                    <label for="newpassword" >{{ __('New Password') }}</label>

                    <div class="input-group">
                        <input id="newpassword" type="password" class="form-control" name="newpassword" required autocomplete="new-password">

                        {{-- @error('newpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>
                    @error('newpassword')
                            <p class="text-red">{{ $message }}</p>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="newpassword_confirmation" >{{ __('Confirm Password') }}</label>

                    <div class="input-group">
                        <input id="newpassword_confirmation" type="password" class="form-control" name="newpassword_confirmation" required autocomplete="new-password">
                    </div>
                </div>



                        <button type="submit"  class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to update?')" data-toggle="confirmation">
                            Update Password
                        </button><br><br>

                        <a href="/profile" class="btn btn-danger btn-sm"></i>Cancel</a>

              </form>



        </div>
    </div>
</div>

@endsection
