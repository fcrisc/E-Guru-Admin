@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>Schedule Table</h1> --}}
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Schedule table</li>
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
                            <h3 class="card-title"><b>Teacher Schedule</b></h3>
                          </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="column">
                            <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modal-schedule">
                                <i class="fas fa-plus-circle"></i>   Add Schedule
                            </button>&nbsp;&nbsp;
                            </div>
                            <div class="column">
                            <a href="/class_rooms" class="btn btn-default bg-lightblue btn-sm  "> View Timetable</a><br><br>
                            </div>
                        </div>
                            <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                              <thead class="thead">
                            <tr>
                                <th>Teacher Name</th>
                                <th>Day</th>
                                <th>Classroom</th>
                                <th>Venue</th>
                                <th>Subject</th>
                                <th>Start time (a.m/p.m)</th>
                                <th>End time (a.m/p.m)</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                              </thead>
                              <tbody>
                                @foreach($timetables as $timetable)
                                <tr>
                                <td>{{$timetable->teacher->first_name}} {{$timetable->teacher->last_name}}</td>
                                <td>{{$timetable->days->name}}</td>
                                <td>{{$timetable->classrooms->classroom_name}}</td>
                                <td>{{$timetable->classes->class_name}}</td>
                                <td>{{$timetable->courses->course_name}}</td>
                                <td>{{$timetable['time_start']}}</td>
                                <td>{{$timetable['time_end']}}</td>
                                <td>{{$timetable->batches->batch}}</td>
                                <td><div class="row">
                                    <div class="column">&nbsp;&nbsp;
                                    <a href="/timetables/{{ $timetable['id'] }}/edit" class="btn btn-default bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                                    </div>
                                    <div class="column">
                                    <form action="{{route('timetable.destroy', [$timetable->id])}}" method="POST">
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
                              </tbody>
                            </table>
                        </div>
                    {{-- </div> --}}
                </div>
            </section>

             <!-- /.modal-add role -->
 <div class="modal fade" id="modal-schedule">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">Add Schedule</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <form action="{{ route('timetables.store') }}" method="POST" >
        @csrf

        <div class="form-group">
            <label for="teacher" >{{ __('Teacher') }}</label>

            <div class="input-group">
            <select id="teacher"  class="custom-select @error('teacher') is-invalid @enderror" name="teacher" >
                <option value="">Select Teacher</option>
                @foreach($users as $user)
                <option value="{{$user['id']}}">{{$user['first_name']}} {{$user['last_name']}}</option>
                @endforeach
            </select>
            @error('teacher')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="day" >{{ __('Day') }}</label>

            <div class="input-group">
            <select id="day"  class="custom-select @error('day') is-invalid @enderror" name="day" >
                <option value="">Select Day</option>
                @foreach($days as $day)
                <option value="{{$day['id']}}">{{$day['name']}}</option>
                @endforeach
            </select>
            @error('day')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="classroom" >{{ __('Classroom') }}</label>

            <div class="input-group">
            <select id="classroom"  class="custom-select @error('classroom') is-invalid @enderror" name="classroom" >
                <option value="">Select Classroom</option>
                @foreach($classrooms as $classroom)
                <option value="{{$classroom['id']}}">{{$classroom['classroom_name']}}</option>
                @endforeach
            </select>
            @error('classroom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="location" >{{ __('Class venue') }}</label>

            <div class="input-group">
            <select id="location"  class="custom-select @error('location') is-invalid @enderror" name="location" >
                <option value="">Select Venue</option>
                @foreach($classes as $venue)
                <option value="{{$venue['id']}}">{{$venue['class_name']}}</option>
                @endforeach
            </select>
            @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="subject" >{{ __('Class subject') }}</label>

            <div class="input-group">
            <select id="subject"  class="custom-select @error('subject') is-invalid @enderror" name="subject" >
                <option value="">Select subject</option>
                @foreach($courses as $course)
                <option value="{{$course['id']}}">{{$course['course_name']}}</option>
                @endforeach
            </select>
            @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
              <label>Start Time:</label>

              <div class="input-group date" id="timepicker" >
                <select id="start_time"  class="custom-select @error('start_time') is-invalid @enderror" name="start_time" >
                    <option value="">Start time</option>
                    <option value="07:40:00">07:40 a.m</option>
                    <option value="08:10:00">08:10 a.m</option>
                    <option value="08:40:00">08:40 a.m</option>
                    <option value="09:10:00">09:10 a.m</option>
                    <option value="09:40:00">09:40 a.m</option>
                    <option value="10:10:00">10:10 a.m</option>
                    <option value="10:30:00">10:30 a.m</option>
                    <option value="11:00:00">11:00 a.m</option>
                    <option value="11:30:00">11:30 a.m</option>
                    <option value="12:00:00">12:00 p.m</option>
                    <option value="12:30:00">12:30 p.m</option>
                    <option value="13:00:00">13:00 p.m</option>
                    <option value="13:30:00">13:30 p.m</option>
                    <option value="14:00:00">14:00 p.m</option>
                    <option value="14:30:00">14:30 p.m</option>
                </select>
                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>

          <div class="bootstrap-timepicker">
            <div class="form-group">
              <label>End Time:</label>

              <div class="input-group date" id="endtimepicker">
                <div class="input-group date" id="timepicker" >
                    <select id="end_time"  class="custom-select @error('end_time') is-invalid @enderror" name="end_time" >
                        <option value="">End time</option>
                        <option value="08:10:00">08:10 a.m</option>
                        <option value="08:40:00">08:40 a.m</option>
                        <option value="09:10:00">09:10 a.m</option>
                        <option value="09:40:00">09:40 a.m</option>
                        <option value="10:10:00">10:10 a.m</option>
                        <option value="10:30:00">10:30 a.m</option>
                        <option value="11:00:00">11:00 a.m</option>
                        <option value="11:30:00">11:30 a.m</option>
                        <option value="12:00:00">12:00 p.m</option>
                        <option value="12:30:00">12:30 p.m</option>
                        <option value="13:00:00">13:00 p.m</option>
                        <option value="13:30:00">13:30 p.m</option>
                        <option value="14:00:00">14:00 p.m</option>
                        <option value="14:30:00">14:30 p.m</option>
                        <option value="15:00:00">15:00 p.m</option>
                    </select>
                      <!-- /.input group -->
                @error('end_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                    </div>

                </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>

        <div class="form-group">
            <label for="year" >{{ __('Year') }}</label>

            <div class="input-group">
            <select id="year"  class="custom-select @error('year') is-invalid @enderror" name="year" >
                <option value="">Select Year</option>
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

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Schedule</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection
