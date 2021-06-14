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
            <li class="breadcrumb-item active">Manage Year</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Update Year</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('batches.update', $batches->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="batch" >{{ __('Year') }}</label>

                    <div class="input-group">
                        <input id="batch" type="text" value="{{$batches->batch}}" class="form-control @error('batch') is-invalid @enderror" name="batch"   autocomplete="batch" autofocus>

                        @error('batch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Year</button>
                <a href="/batches" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
