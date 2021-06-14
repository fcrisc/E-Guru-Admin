@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Course</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Manage Course</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Subject</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('courses.update', $courses->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="course_name" >{{ __('Subject Name') }}</label>

                    <div class="input-group">
                        <input id="course_name" type="text" value="{{$courses->course_name}}" class="form-control @error('course_name') is-invalid @enderror" name="course_name"   autocomplete="course_name" autofocus>

                        @error('course_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="course_code" >{{ __('Subject Code') }}</label>

                    <div class="input-group row-cols-2">
                        <input id="course_code" type="text" value="{{$courses->course_code}}" class="form-control @error('course_code') is-invalid @enderror" name="course_code"  autocomplete="course_code">

                        @error('course_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" >{{ __('Description') }}</label>

                    <div class="input-group">
                        <textarea rows="3" id="description"  class="form-control @error('description') is-invalid @enderror" name="description" >{{$courses->description}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" >{{ __('Status') }}</label>

                    <div class="input-group">
                    <select id="status"  class="custom-select" name="status" >
                        @if($courses->status === 1)
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        @else
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                        @endif
                    </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Course</button>
                <a href="/courses" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
