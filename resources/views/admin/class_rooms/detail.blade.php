@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>View Tables</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Classroom Table</li>
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
                <h3 class="card-title"><b>Detailed Classroom List</b></h3>
            </div>
            <div class="card-body">
                <a href="/class_rooms" class="btn btn-danger btn-sm"> Back</a><br><br>
                <table id="example2" class="table table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                    <thead class="thead">
                  <tr>

                      <th>Class Name</th>
                      <th>Class Code</th>
                      <th>Description</th>
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
                          <td><span class="badge bg-primary">{{$classes->classroom->classroom_code}}</span></td>
                          <td>{{$classes->classroom->classroom_description}}</td>
                          <td>{{$classes->batch->batch}}</td>
                          {{-- <td>@if($classes->classroom->classroom_status === 1)
                              <span class="badge bg-lime">Active</span>
                              @else
                              <span class="badge badge-danger">Inactive</span>
                              @endif</td> --}}
                          <td><div class="row">
                              <div class="column">&nbsp;&nbsp;
                              {{-- <a href="/class_rooms/{{ $classes->id }}" class="btn btn-primary  btn-sm"> Manage Students</a>
                              <a href="/attendances/{{ $classes->id }}/index" class="btn btn-primary  btn-sm"> Manage Attendance</a> --}}
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
    </div>
  </section>

  @endsection
