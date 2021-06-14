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
            <li class="breadcrumb-item active">User Feedback</li>
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


        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Feedback List</b></h3>
              </div>
            <div class="card-body">

                <table id="example2" class="table table-bordered table-hover table-sm table-responsive{-sm|-md|-lg|-xl}">

                  <thead class="thead">
                <tr>

                    <th>Teacher</th>
                    <th>Feedback Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
                  </thead>
                  <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                    <td>{{$complaint->user->first_name}} {{$complaint->user->last_name}}</td>
                    <td>{{$complaint['complaint_type']}}</td>
                    <td>{{$complaint['complaint_description']}}</td>
                    <td>{{$complaint['status']}}</td>
                    <td><div class="row">
                        <div class="column">&nbsp;&nbsp;
                        <a href="/complaints/{{ $complaint['id'] }}/edit" class="btn btn-default bg-lightblue  btn-sm"><i class="fas fa-user-edit"></i></a>
                        </div>
                        <div class="column">
                        <form action="{{route('complaints.destroy', [$complaint->id])}}" method="POST">
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
    </div>


  </section>



@endsection
