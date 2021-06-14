@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Class Rooms Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Class Rooms Table</li>
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
                        <h3 class="card-title"><b>Classroom List [{{now()->year}}]</b></h3>
                      </div>
                    <div class="card-body">

                        <div class="column">
                    <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modal-classroom">
                        <i class="fas fa-plus-circle"></i>   Add Class
                    </button></div><br>
                        <div class="row">
                        <div class="column">
                    <a href="/timetables" class="btn btn-default bg-lightblue btn-sm "> Manage Schedule</a>
                    </div>&nbsp;&nbsp;
                    <div class="column">
                        <a href="{{route('class_rooms.detail')}}" class="btn btn-info btn-sm "> View All Classroom</a>
                        </div>
                    </div><br>
                        <table id="example2" class="table table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                          <thead class="thead">
                        <tr>

                            <th>Class Name</th>
                            <th>Year</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                            <th>Schedule</th>
                        </tr>
                          </thead>
                          <tbody>
                            @foreach($classrooms as $classes)
                            <tr>
                                <td>{{$classes->classroom->classroom_name}}</td>
                                <td>{{$classes->batch->batch}}</td>
                                {{-- <td>@if($classes->classroom->classroom_status === 1)
                                    <span class="badge bg-lime">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif</td> --}}
                                <td><div class="row">
                                    <div class="column">&nbsp;&nbsp;
                                    <a href="/class_rooms/{{ $classes->id }}" class="btn btn-primary  btn-sm"> Manage Students</a>
                                    <a href="/attendances/{{ $classes->id }}/index" class="btn btn-primary  btn-sm"> Manage Attendance</a>
                                    <a href="/class_rooms/{{ $classes['id'] }}/edit" class="btn btn-default bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                                    </div>
                                    <div class="column">
                                    <form action="{{route('classroom.destroy', [$classes->id])}}" method="POST">
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
                                <td>
                                    <a href="{{ route('schedule.index') }}?class_id={{ $classes->id }}" class="btn btn-default bg-lightblue btn-sm"><i class="nav-icon far fa-calendar-alt"></i></a>
                                </td>

                            </tr>
                            @endforeach
                        </table>
                    </div>

            </div>
        </section>

 <!-- /.modal-add role -->
 <div class="modal fade" id="modal-classroom">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title"><b>Add Classroom</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <form action="{{ route('class_rooms.store') }}" method="POST" >
        @csrf
        <div class="form-group ">
            <label for="classroom_name" >{{ __('Class Name') }}</label>

            <div class="input-group">
                <input id="classroom_name" type="text" class="form-control @error('classroom_name') is-invalid @enderror" name="classroom_name"   autocomplete="classroom_name" autofocus>

                @error('classroom_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group ">
            <label for="classroom_code" >{{ __('Class Code') }}</label>

            <div class="input-group">
                <input id="classroom_code" type="text" class="form-control @error('classroom_code') is-invalid @enderror" name="classroom_code"   autocomplete="classroom_code" autofocus>

                @error('classroom_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="year" >{{ __('Year') }}</label>

            <div class="input-group">
            <select id="year"  class="custom-select @error('year') is-invalid @enderror" name="year" >
                <option value="">Select year</option>
                @foreach($batches as $batch)
                <option value="{{$batch['id']}}">{{$batch['batch']}}</option>
                @endforeach
            </select>
            @error('year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group ">
            <label for="classroom_description" >{{ __('Description') }}</label>

            <div class="input-group">
                <textarea id="classroom_description" rows="3" type="text" class="form-control @error('classroom_description') is-invalid @enderror" name="classroom_description"   autocomplete="classroom_description" autofocus>
                </textarea>
                @error('classroom_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Add Classroom</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
