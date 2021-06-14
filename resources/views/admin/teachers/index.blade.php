@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>Teachers Table</h1> --}}
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Teachers table</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content ">

        @if (session('success') != null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
    @endif
    @if (session('abort') != null)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('abort')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
    @endif

        <div class="container-fluid col-sm-12">

                {{-- <div class="col-10"> --}}
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title"><b>Teacher List</b></h3>
                          </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-teacher">
                                Register Teacher
                            </button><br><br>
                            <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                              <thead class="thead">
                            <tr>
                                <th>Id</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                {{-- <th>Status</th> --}}
                                <th>Password</th>
                                <th></th>
                            </tr>
                              </thead>
                              <tbody>
                                @foreach($roles as $role)
                                @foreach($role->users as $key => $user)
                                <tr>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                                <td style="color:blue;">{{$user['email']}}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $role->name }}</span>

                                </td>
                                {{-- <td>@if($user->status === 1)
                                    <span class="badge bg-lime">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td> --}}
                                <td>{{$user['password']}}</td>
                                <td>
                                    <div class="row">
                                    <div class="column">&nbsp;&nbsp;
                                    <a href="/teachers/{{ $user['id'] }}/edit" class="btn btn-default bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                                    </div>
                                    <div class="column">
                                    <form action="{{route('teachers.destroy', [$user->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input  type="hidden" />
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="confirmation">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    </div>
                                    </div>
                                </tr>
                                @endforeach
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    {{-- </div> --}}
                </div>
            </section>

 <!-- /.modal-add role -->
 <div class="modal fade" id="modal-teacher">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title"><b>Add Teacher</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <form action="{{ route('teachers.store') }}" method="POST" >
        @csrf
        <div class="row">
            <div class="col-sm-6">
            <div class="form-group ">
                <label for="first_name" >{{ __('First Name') }}</label>

                <div class="input-group">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"   autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            </div>

            <div class="col-sm-6">
            <div class="form-group ">
                <label for="last_name" >{{ __('Last Name') }}</label>

                <div class="input-group">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"   autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            </div>
            </div>

            <div class="form-group ">
                <label for="email" >{{ __('E-Mail Address') }}</label>

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="password" >{{ __('Password') }}</label>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Register</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
