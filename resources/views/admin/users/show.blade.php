@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">User Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card card-navy card-outline">
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

            <p class="text-muted text-center">Role</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Name</b> <a class="float-right">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ Auth::user()->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Phone number</b> <a class="float-right">Phone number</a>
                </li>
                <li class="list-group-item">
                    <b>School</b> <a class="float-right">School</a>
                  </li>
              </ul>

        </div>
    </div>

  </div>

@endsection
