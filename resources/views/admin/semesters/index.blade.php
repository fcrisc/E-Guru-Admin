@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Semesters Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Class Level Table</li>
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
                        <h3 class="card-title"><b>Classroom Level List</b></h3>
                      </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-semester">
                        <i class="fas fa-plus-circle"></i>   Add Level
                    </button><br><br>
                        <table id="example2" class="table data table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                          <thead class="thead">
                        <tr>

                            <th>Level</th>
                            <th>Level Code</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                          </thead>
                          <tbody>
                            @foreach($semesters as $semester)
                            <tr>
                            <td>{{$semester['semester_name']}}</td>
                            <td>{{$semester['semester_code']}}</td>
                            <td>{{$semester['duration']}}</td>
                            <td>{{$semester['description']}}</td>
                            <td><div class="row">
                                <div class="column">&nbsp;&nbsp;
                                <a href="/semesters/{{ $semester['id'] }}/edit" class="btn btn-default bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                                </div>
                                <div class="column">
                                <form action="{{route('semesters.destroy', [$semester->id])}}" method="POST">
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
 <div class="modal fade" id="modal-semester">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title"><b>Add Level</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <form action="{{ route('semesters.store') }}" method="POST" >
        @csrf
        <div class="form-group ">
            <label for="semester_name" >{{ __('Semester Name') }}</label>

            <div class="input-group">
                <input id="semester_name" type="text" class="form-control @error('semester_name') is-invalid @enderror" name="semester_name"   autocomplete="semester_name" autofocus>

                @error('semester_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group ">
            <label for="semester_code" >{{ __('Semester Code') }}</label>

            <div class="input-group">
                <input id="semester_code" type="text" class="form-control @error('semester_code') is-invalid @enderror" name="semester_code"   autocomplete="semester_code" autofocus>

                @error('semester_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group ">
            <label for="duration" >{{ __('Duration') }}</label>

            <div class="input-group">
                <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration"   autocomplete="duration" autofocus>

                @error('duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group ">
            <label for="description" >{{ __('Description') }}</label>

            <div class="input-group">
                <textarea id="description" rows="3" type="text" class="form-control @error('description') is-invalid @enderror" name="description"   autocomplete="description" autofocus>
                </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Add Level</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
