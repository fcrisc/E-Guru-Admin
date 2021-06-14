@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Students QR code</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Generated QR code</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content ">
    <div class="container-fluid col-sm-4">


                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title" ><b>Generated QR code</b></h3>
                      </div>
                    <div class="card-body">

                        {{-- <table id="example1" class="table data table-sm table-bordered table-hover table-responsive{-sm|-md|-lg|-xl}">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SCAN USING EGURU APPILICATION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td>{!! QrCode::format('svg')->size(300)->generate($students->reference_id); !!}</td>
                                </tr>
                                <tr>
                                    <td>{{$students->reference_id}}<td>
                                </tr>
                                <tr>
                                    <td>{{$students->first_name}} {{$students->last_name}}<td>
                                </tr>
                            </tbody>

                        </table> --}}

                        <div class="visible-print text-center">
                            {{-- <p><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate(
                                json_encode([
                                    'ref_id'=>$students->reference_id,
                                    'clasroom_id'=>$students->reference_id
                                    ])
                                )) !!} "></p> --}}

                                <p><img src="{{(QrCode::format('svg')->size(250)->generate(
                                    json_encode([
                                        'ref_id'=>$students->reference_id,
                                        'clasroom_id'=>$students->reference_id,
                                        ])
                                    )) }} "></p>

                            <p>{{$students->reference_id}}</p>
                            <p>{{$students->first_name}} {{$students->last_name}}</p>
                        </div>

                        <a href="/students/qrcode-print/{{ $students['id'] }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

                    </div>

            </div>
        </section>


  @endsection
