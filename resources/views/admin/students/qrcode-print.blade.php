@extends('layouts.adminlte')

@section('content')

<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12" style="margin:center;">
          <h2 class="page-header">
            <img src="{{asset('/dist/img/logo/e-guru-icon.png')}}" width="100" alt="E-Guru Logo" class="brand-image img-circle "> E-GURU System
            <small class="float-right">{{date('d-m-Y')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div><br><br><br>


      <!-- QR Table  -->
      <div class="visible-print text-center">
        <p>
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(700)->generate(
            json_encode([
                'ref_id'=>$students->reference_id,
                'clasroom_id'=>$students->reference_id
                ])
            )) !!} ">
        </p><br>
        <p><b>Student Name:</b> {{$students->first_name}} {{$students->last_name}}</p>
        <p><b>Reference ID:</b> {{$students->reference_id}}</p>
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  <!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
  </script>

  @endsection
