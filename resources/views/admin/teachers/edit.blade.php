@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Teacher</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Update Teacher</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<div class="container-fluid col-sm-12 ">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Teacher</b></h3>
        </div>
        <div class="card-body box-profile">
       <div class="row">
           <div class="col-6">
           </div>
           <div class="col-6">
            <a href="/teachers/{{ $users->id }}/changePasswordForm" class="btn btn-primary btn-sm float-right">Change Password</a>
           </div>
       </div><br><br>

            <form action="{{ route('teachers.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="first_name" >{{ __('First Name') }}</label>

                    <div class="input-group">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $users->first_name}}" required autocomplete="first_name" autofocus>

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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value=" {{ $users->last_name}}" required autocomplete="last_name" autofocus>

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email}}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>

                  <div class="form-group ">
                    <div class="col-md-8">
                        <button type="submit"  class="btn btn-primary btn-sm">
                            Update
                        </button>
                        <a href="/teachers" class="btn btn-danger btn-sm"></i> Cancel</a>
                    </div>
                </div>

              </form>



        </div>
    </div>
</div>



@endsection
