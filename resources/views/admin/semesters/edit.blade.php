@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Semester</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Manage Semester</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Level</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('semesters.update', $semesters->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="semester_name" >{{ __('Semester Name') }}</label>

                    <div class="input-group">
                        <input id="semester_name" type="text" value="{{$semesters->semester_name}}" class="form-control @error('semester_name') is-invalid @enderror" name="semester_name"   autocomplete="semester_name" autofocus>

                        @error('semester_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="semester_code" >{{ __('Semester Code') }}</label>

                    <div class="input-group row-cols-2">
                        <input id="semester_code" type="text" value="{{$semesters->semester_code}}" class="form-control @error('semester_code') is-invalid @enderror" name="semester_code"  autocomplete="semester_code">

                        @error('semester_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="duration" >{{ __('Duration') }}</label>

                    <div class="input-group row-cols-2">
                        <input id="duration" type="text" value="{{$semesters->duration}}" class="form-control @error('duration') is-invalid @enderror" name="duration"  autocomplete="duration">

                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" >{{ __('Description') }}</label>

                    <div class="input-group">
                        <textarea rows="3" id="description"  class="form-control @error('description') is-invalid @enderror" name="description" >{{$semesters->description}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Class</button>
                <a href="/semesters" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
