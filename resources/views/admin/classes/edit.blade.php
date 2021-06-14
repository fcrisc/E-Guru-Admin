@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Room</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Manage Room</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Venue</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('classes.update', $classes->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="class_name" >{{ __('Room Name') }}</label>

                    <div class="input-group">
                        <input id="class_name" type="text" value="{{$classes->class_name}}" class="form-control @error('class_name') is-invalid @enderror" name="class_name"   autocomplete="class_name" autofocus>

                        @error('class_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="class_code" >{{ __('Room Code') }}</label>

                    <div class="input-group row-cols-2">
                        <input id="class_code" type="text" value="{{$classes->class_code}}" class="form-control @error('class_code') is-invalid @enderror" name="class_code"  autocomplete="class_code">

                        @error('class_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Class</button>
                <a href="/classes" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
