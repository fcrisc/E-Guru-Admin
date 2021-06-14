@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>Student's Classroom Table</h1> --}}
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Student management table</li>
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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                            <h3 class="card-title"><b>{{$batch_classroom->classroom->classroom_name}}
                               [ @foreach($batch_classroom->classroom->batches as $batch)
                                {{$batch['batch']}}
                            @endforeach]</b></h3>
                          </div>
                        <div class="card-body">

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-studentAssign">
                                <i class="fas fa-plus-circle"></i>   Add Student
                            </button><br><br>

                            <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                              <thead class="thead">
                            <tr>
                                <th>Reference Id</th>
                                <th>Assigned Students</th>
                                <th></th>
                            </tr>
                              </thead>
                              <tbody>
                                @foreach($batch_classroom->classroom->students as $student)
                                <tr>
                                <td>{{$student->reference_id}}</td>
                                <td>{{$student->first_name}} {{$student->last_name}}</td>
                                <td><form action="{{route('class_rooms.destroy', [$batch_classroom->id, $student->id])}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="confirmation" type="submit" value="Remove" />
                                </form>
                                </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table><br>
                            <a href="/class_rooms" class="btn btn-danger btn-sm"></i>Back </a>
                        </div>
                    {{-- </div> --}}
                </div>

            </section>

 <!-- /.modal-add role -->
 <div class="modal fade" id="modal-studentAssign">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">Add Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

    <form action="{{ route('class_rooms.attachStudent', $batch_classroom->id) }}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="student" >{{ __('Student') }}</label>

            <div class="input-group">
            <select id="student"  class="custom-select @error('student') is-invalid @enderror" name="student" >
                <option value="">Choose Student</option>
                @foreach($students as $student)
                <option value="{{$student->id}}">{{$student->first_name}} {{$student->last_name}}</option>
                @endforeach
            </select>
            @error('student')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Assign Student</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection
