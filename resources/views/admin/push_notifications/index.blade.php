@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Notifications Table</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Push Notification</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content ">
    <div class="container-fluid col-sm-12">


                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title"><b>Notification List</b></h3>
                      </div>
                    <div class="card-body">

                    <a href="{{ route('push_notifications.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i>   Add Notifications</i></a><br><br>

                        <table id="example2" class="table table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">

                          <thead class="thead">
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                          </thead>
                          <tbody>
                            @foreach($push_notifications as $notification)
                            <tr>
                            <td>{{$notification['title']}}</td>
                            <td>{{$notification['body']}}</td>
                            <td style="color:blue">{{$notification['image']}}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">Manage</i></a>
                                <a href="#" class="btn btn-danger  btn-sm"><i class="far fa-trash-alt"></i></a>
                            </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>

            </div>
        </section>

@endsection
