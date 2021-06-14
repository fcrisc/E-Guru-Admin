@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Schedule</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Schedule</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class = "content">
<div class="container-fluid col-sm-12">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title"><b>Schedule</b></h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="column">
            <a href="/timetables" class="btn btn-default bg-lightblue  btn-sm"> Manage Schedule</a><br><br>
                </div>
                <div class="column float-right">
            <a href="/class_rooms" class="btn btn-danger btn-sm"> Back </a><br><br>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <th width="125">Time</th>
                    @foreach($weekDays as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($calendarData as $time => $days)
                        <tr >
                            <td>
                                {{ $time }}
                            </td>
                            @foreach($days as $value)
                                @if (is_array($value))
                                    <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center" style="background-color:#f0f0f0 font">
                                        <b>{{ $value['teacher_name'] }}</b><br><small>
                                        Venue: {{ $value['venue'] }}<br>
                                        Subject: {{ $value['course'] }}<br></small>
                                        {{-- Subject code: {{ $value['course_code'] }}<br></small> --}}
                                    </td>
                                @elseif ($value === 1)
                                    <td></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
</section>

@endsection
