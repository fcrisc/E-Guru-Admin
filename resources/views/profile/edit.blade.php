@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Profile</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<div class="container-fluid col-sm-4 ">
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

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="first_name" >{{ __('First Name') }}</label>

                    <div class="input-group">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ Auth::user()->first_name}}"  autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                            <label for="last_name" >{{ __('Last Name') }}</label>

                            <div class="input-group">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value=" {{ Auth::user()->last_name}}"  autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                <div class="form-group ">
                        <label for="email" >{{ __('E-Mail Address') }}</label>

                        <div class="input-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email}}"  autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile"  >
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>


                  <div class="form-group ">
                    <div class="col-md-8">
                        <button type="submit"  class="btn btn-primary btn-sm">
                            Update Profile
                        </button>
                        <a href="/profile" class="btn btn-danger btn-sm">Cancel</a>
                    </div>
                </div>

              </form>



        </div>
    </div>
</div>



@endsection
