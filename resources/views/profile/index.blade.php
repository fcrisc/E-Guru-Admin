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

    <!-- Main content -->

      <div class="container-fluid col-sm-5 ">
                   <!-- Profile Image -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Profile</b></h3>
                </div>
              <div class="card-body box-profile">
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

                <h3 class="profile-username text-center">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h3>

                <p class="text-muted text-center"><span class="badge badge-default bg-lime">Admin</span></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ Auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Password</b> <a href="{{ route('profile.change.password') }}" class="btn btn-primary btn-sm  float-right">Change Password</a>
                  </li>
                </ul>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm float-right">Update Profile</a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>


  @endsection
