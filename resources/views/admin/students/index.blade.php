@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Students Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Students Table</li>
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


                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title"><b>Students List</b></h3>
                      </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-student">
                        <i class="fas fa-plus-circle"></i>   Add Student
                    </button><br><br>
                        <table id="example1" class="table table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                          <thead class="thead">
                        <tr>

                            <th>Reference ID</th>
                            <th>Student Name</th>
                            <th>IC Number</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            {{-- <th>Status</th> --}}
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                          </thead>
                          <tbody>
                            @foreach($students as $student)
                            <tr>
                            <td>{{$student['reference_id']}}</td>
                            <td>{{$student['first_name']}} {{$student['last_name']}}</td>
                            <td>{{$student['ic_number']}}</td>
                            <td>{{$student['gender']}}</td>
                            <td>{{$student['dob']}}</td>
                            {{-- <td>
                                @if($student->status == 1)
                                <span class="badge bg-lime">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td> --}}
                            <td>{{$student['remarks']}}</td>
                            <td><div class="row">
                                <div class="column">&nbsp;&nbsp;
                                {{-- <a href="/students/qrcode/{{ $student['id'] }}" class="btn btn-primary  btn-sm"> Generate QR code</a> --}}
                                <a href="/students/{{ $student['id'] }}/edit" class="btn btn-default bg bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                                </div>
                                <div class="column">
                                <form action="{{route('students.destroy', [$student->id])}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input  type="hidden" />
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="confirmation">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                                </div>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>

            </div>
        </section>

 <!-- /.modal-add role -->
 <div class="modal fade" id="modal-student">
    <div class="shadow modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title"><b>Add Student</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

    <form action="{{ route('students.store') }}" method="POST" >
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
            <label for="ic_number" >{{ __('IC Number') }}</label>

            <div class="input-group">
                <input id="ic_number" placeholder="Format: XXXXXX-XX-XXXX" type="text" class="form-control @error('ic_number') is-invalid @enderror" name="ic_number"   autocomplete="ic_number" autofocus>

                @error('ic_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group ">
            <label for="gender" >{{ __('Gender') }}</label>

            <div class="input-group">
                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender"   autocomplete="gender" autofocus>
                    <option value="">Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group ">
            <label for="dob" >{{ __('Date of Birth') }}</label>

            <div class="input-group">
                <input id="dob" type="date" data-date-format="mm/dd/yyyy" class="form-control datepicker @error('dob') is-invalid @enderror" name="dob"   autocomplete="dob" autofocus>

                @error('dob')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        </div>

        </div>

        <div class="form-group ">
            <label for="remarks" >{{ __('Remark') }}</label>

            <div class="input-group">
                <textarea id="remarks" rows="3" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks"   autocomplete="remarks" autofocus>
                </textarea>
                @error('remarks')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Register Student</button>
        </div>

    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
