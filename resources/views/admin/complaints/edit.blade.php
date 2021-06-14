@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Classes Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Update Status</li>
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

    <div class="container-fluid col-sm-12 ">

        <div class="card ">
            <div class="card-header">
                <h3 class="card-title"><b>Update Status</b></h3>
            </div>
            <div class="card-body box-profile">

                <form action="{{ route('complaints.update', $complaints->id) }}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="class_name" >{{ __('User') }}</label>

                        <div class="input-group">
                            <input id="class_name" type="text" value="{{$complaints->user->first_name}} {{$complaints->user->last_name}}" class="form-control @error('class_name') is-invalid @enderror" name="class_name" readonly   autocomplete="class_name" autofocus>

                            @error('class_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="class_code" >{{ __('Feedback Type') }}</label>

                        <div class="input-group row-cols-2">
                            <input id="class_code" type="text" value="{{$complaints['complaint_type']}}" class="form-control @error('class_code') is-invalid @enderror" name="class_code" readonly  autocomplete="class_code">

                            @error('class_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="classroom_description" >{{ __('Description') }}</label>

                        <div class="input-group">
                            <textarea id="classroom_description" rows="3" type="text" class="form-control @error('classroom_description') is-invalid @enderror" name="classroom_description" readonly   autocomplete="classroom_description" autofocus>
{{$complaints['complaint_description']}}
                            </textarea>
                            @error('classroom_description')
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
                            @if($complaints->status === 'pending')
                            <option value="pending">pending</option>
                            <option value="ongoing">ongoing</option>
                            <option value="completed">completed</option>
                            @elseif($complaints->status === 'ongoing')
                            <option value="ongoing">ongoing</option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                            @else
                            <option value="completed">completed</option>
                            <option value="ongoing">ongoing</option>
                            <option value="pending">pending</option>
                            @endif
                        </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Change status</button>
                    <a href="/complaints" class="btn btn-danger btn-sm"> Cancel</a>
                </form>

            </div>
        </div>
      </div>

  </section>

@endsection
