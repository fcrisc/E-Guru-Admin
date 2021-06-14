@extends('layouts.adminlte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Student</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Manage Student</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid col-sm-5 ">

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"><b>Update Student</b></h3>
        </div>
        <div class="card-body box-profile">

            <form action="{{ route('students.update', $students->id) }}" method="POST" >
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group ">
                        <label for="first_name" >{{ __('First Name') }}</label>

                        <div class="input-group">
                            <input id="first_name" value="{{$students->first_name}}" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"   autocomplete="first_name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="form-group ">
                        <label for="last_name" >{{ __('Last Name') }}</label>

                        <div class="input-group">
                            <input id="last_name" value="{{$students->last_name}}" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"   autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="form-group ">
                        <label for="ic_number" >{{ __('IC Number') }}</label>

                        <div class="input-group">
                            <input id="ic_number" value="{{$students->ic_number}}" placeholder="Format: XXXXXX-XX-XXXX" type="text" class="form-control @error('ic_number') is-invalid @enderror" name="ic_number"   autocomplete="ic_number" autofocus>

                            @error('ic_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group ">
                            <label for="gender" >{{ __('Gender') }}</label>

                            <div class="input-group">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender"   autocomplete="gender" autofocus>
                                    @if($students->gender === 'Male')
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    @else
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                    @endif
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-group ">
                            <label for="dob" >{{ __('Date of Birth') }}</label>

                            <div class="input-group">
                                <input id="dob" value="{{$students->dob}}" type="date" data-date-format="mm/dd/yyyy" class="form-control datepicker @error('dob') is-invalid @enderror" name="dob"   autocomplete="dob" autofocus>

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        </div>

                <div class="form-group">
                    <label for="status" >{{ __('Status') }}</label>

                    <div class="input-group">
                    <select id="status"  class="custom-select" name="status" >
                        @if($students->status == 1)
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        @else
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                        @endif
                    </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="remarks" >{{ __('Remark') }}</label>

                    <div class="input-group">
                        <textarea id="remarks" rows="3" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks"   autocomplete="remarks" autofocus>
                            {{$students->remarks}}
                        </textarea>
                        @error('remarks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update Student</button>
                <a href="/students" class="btn btn-danger btn-sm"> Cancel</a>
            </form>

        </div>
    </div>
  </div>

@endsection
