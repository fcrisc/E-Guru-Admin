@extends('layouts.adminlte')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>Student's Attendance View</h1> --}}
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Student's Attendance</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content ">
           <div class="alert alert-primary alert-dismissible fade show" role="alert">
               Please select required date first to view the attendance.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
        <div class="container-fluid col-sm-12">

                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title"><b>{{$batch_classroom->classroom->classroom_name}}
                               [ @foreach($batch_classroom->classroom->batches as $batch)
                                {{$batch['batch']}}
                            @endforeach]</b></h3>
                          </div>
                        <div class="card-body">
                            <div class="col">
                                <div class="row">
                        <form action="{{ route('attendances.dateFilter', $batch_classroom->id) }}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label>Date:</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input type="text" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $date }}"/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                      &nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-sm"> View attendance </button>
                                  </div>
                              </div>
                        </form>
                            </div>
                            </div>
                            <div class="row">
                            </div>

                            <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                              <thead class="thead">
                            <tr>
                                <th>Reference Id</th>
                                <th>Students</th>
                                <th>Status</th>
                              </thead>
                              <tbody>
                                  @forelse ($student_attendances as $student_attendance)
                                <tr>
                                    <td>{{$student_attendance->classroom_student->student->reference_id}}</td>
                                    <td>{{$student_attendance->classroom_student->student->first_name}} {{$student_attendance->classroom_student->student->last_name}}</td>
                                    <td id='status{{$student_attendance->id}}'>
                                        @if($student_attendance->status == 0)
                                            Absent
                                        @else
                                            Present
                                        @endif
                                        &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-sm" onclick='changeStatus(this);' data-id="status{{$student_attendance->id}}" data-said = "{{$student_attendance->id}}" >Change Status</button>
                                    </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">No records found. Please
                                        @if ($date)
                                            <form style="display: inline;" action="{{ route('attendances.generateAttendance', $batch_classroom->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="date" value="{{$date}}" />
                                                <button class="btn btn-primary btn-sm">Generate attendance</button> first.
                                            </form>
                                        @endif
                                        </td>
                                    </tr>
                                  @endforelse
                              </tbody>
                            </table><br>
                            <a href="/class_rooms" class="btn btn-danger btn-sm"></i>Back </a>
                        </div>
                </div>
                <script lang="javascript">

                    function changeStatus(elem) {
                        console.log('click');
                        tdid = $(elem).data('id');
                        id = $(elem).data('said');

                        $.ajax({
                        type:'GET',
                        url: '/attendances/changeStatus/' + id,
                        success:function(data) {
                            $("#" + tdid).html(data);
                            $("#" + tdid).append(elem);
                        }
                        });
                    }
                    </script>
            </section>


@endsection
