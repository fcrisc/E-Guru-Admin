@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Add Notifications</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Add Notifications</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content ">

    <div class="container-fluid col-sm-10">

        <div class="card ">
            <div class="card-header">
                <h3 class="card-title"><b>Add Notification</b></h3>
              </div>
            <div class="card-body">

                <form action="{{ route('push_notifications.store') }}" method="POST" >
                    @csrf
                    <div class="form-group ">
                        <label for="title" >{{ __('Title') }}</label>

                        <div class="input-group">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"   autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="body" >{{ __('Message') }}</label>

                        <div class="input-group">
                            <textarea id="body" rows="3" type="text" class="form-control @error('body') is-invalid @enderror" name="body"   autocomplete="body" autofocus>
                            </textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
{{--
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="customFile"  >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                      </div> --}}

                      <button type="submit" class="btn btn-primary btn-sm">Push announcement</button><br><br>
                      <a href="/all-notifications" class="btn btn-danger  btn-sm"> Back</a>

                </form>

            </div>
        </div>

    </div>


  </section>



 @endsection
