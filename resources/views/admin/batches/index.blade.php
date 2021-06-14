@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Years Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Years Table</li>
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
                        <h3 class="card-title"><b>Years List</b></h3>
                      </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-batches">
                        <i class="fas fa-plus-circle"></i>   Add New Year
                    </button><br><br>
                        <table id="example2" class="table table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                          <thead class="thead">
                        <tr>

                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                          </thead>
                          <tbody>
                            @foreach($batches as $batch)
                            <tr>

                            <td>{{$batch['batch']}}</td>
                            <td><div class="row">
                                <div class="column">&nbsp;&nbsp;
                                <a href="/batches/{{ $batch['id'] }}/edit" class="btn btn-default bg-lightblue btn-sm"><i class="fas fa-user-edit"></i></a>
                                </div>
                                <div class="column">
                                <form action="{{route('batches.destroy', [$batch->id])}}" method="POST">
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
 <div class="modal fade" id="modal-batches">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title"><b>Add Year</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <form action="{{ route('batches.store') }}" method="POST" >
        @csrf
        <div class="form-group ">
            <label for="batch" >{{ __('Year') }}</label>

            <div class="input-group">
                <input id="batch" type="text" class="form-control @error('batch') is-invalid @enderror" name="batch"   autocomplete="batch" autofocus>

                @error('batch')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Add Year</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
