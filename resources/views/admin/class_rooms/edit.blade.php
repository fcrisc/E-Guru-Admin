@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Classroom</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Manage Class</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Classroom</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('class_rooms.update', $classrooms->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="classroom_name" >{{ __('Class Name') }}</label>

                    <div class="input-group">
                        <input id="classroom_name" type="text" value="{{$classrooms->classroom_name}}" class="form-control @error('classroom_name') is-invalid @enderror" name="classroom_name"   autocomplete="classroom_name" autofocus>

                        @error('classroom_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="classroom_code" >{{ __('Class Code') }}</label>

                    <div class="input-group row-cols-2">
                        <input id="classroom_code" type="text" value="{{$classrooms->classroom_code}}" class="form-control @error('classroom_code') is-invalid @enderror" name="classroom_code"  autocomplete="classroom_code">

                        @error('classroom_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="classroom_description" >{{ __('Description') }}</label>

                    <div class="input-group">
                        <textarea rows="3" id="classroom_description"  class="form-control @error('classroom_description') is-invalid @enderror" name="classroom_description" >{{$classrooms->classroom_description}}</textarea>
                        @error('classroom_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="classroom_status" >{{ __('Status') }}</label>

                    <div class="input-group">
                    <select id="classroom_status"  class="custom-select" name="classroom_status" >
                        @if($classrooms->classroom_status === 1)
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        @else
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                        @endif
                    </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Class</button>
                <a href="/class_rooms" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
