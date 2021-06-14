@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Schedule</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Edit Schedule</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
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
      <div class="container-fluid col-sm-5 ">
        <div class="card card-navy card-outline">
            <div class="card-body box-profile">

                <form action="{{ route('timetables.update', [$timetables->id]) }}" method="POST" >
                    @csrf

                    <div class="form-group">
                        <label for="teacher" >{{ __('Teacher') }}</label>

                        <div class="input-group">
                        <select id="teacher"  class="custom-select @error('teacher') is-invalid @enderror" name="teacher" >
                            <option value="{{$timetables->teacher->id}}">{{$timetables->teacher->first_name}} {{$timetables->teacher->last_name}}</option>
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
                            <option value="{{$timetables->days->id}}">{{$timetables->days->name}}</option>
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
                            <option value="{{$timetables->classrooms->id}}">{{$timetables->classrooms->classroom_name}}</option>
                            @foreach($classrooms as $classroom)
                            <option value="{{$classroom['id']}}">[{{$classroom['classroom_code']}}] {{$classroom['classroom_name']}} - {{$classroom['classroom_description']}}</option>
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
                            <option value="{{$timetables->classes->id}}">{{$timetables->classes->class_name}}</option>
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
                            <option value="{{$timetables->courses->id}}">{{$timetables->courses->course_name}}</option>
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
                                <option value="{{$timetables['time_start']}}">{{$timetables['time_start']}}</option>
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
                                    <option value="{{$timetables['time_end']}}">{{$timetables['time_end']}}</option>
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
                            <option value="{{$timetables->batches->id}}">{{$timetables->batches->batch}}</option>
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
                        <a href="/timetables" class="btn btn-danger ">Back</a>
                      <button type="submit" class="btn btn-primary">Update Schedule</button>
                    </div>
                </form>

            </div>
        </div>
      </div>

@endsection
