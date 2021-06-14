@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>User Tables</h1> --}}
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">User Tables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content ">
        <div class="container-fluid col-sm-12">

                {{-- <div class="col-10"> --}}
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title"><b>Users List </b></h3>
                          </div>
                        <div class="card-body">
                            <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                              <thead class="thead">
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                              </thead>
                              <tbody>
                                @foreach($users as $user)
                                <tr>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['first_name']}}</td>
                                <td>{{$user['last_name']}}</td>
                                <td style="color:blue;">{{$user['email']}}</td>
                                <td>{{$user['password']}}</td>
                                <td>@foreach($user->roles as $key => $role)
                                    <span class="badge badge-primary">{{ $role->name }}</span>

                                </td>
                                <td>@if($user->status === 1)
                                    <span class="badge bg-lime">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    {{-- </div> --}}
                </div>
            </section>



@endsection
