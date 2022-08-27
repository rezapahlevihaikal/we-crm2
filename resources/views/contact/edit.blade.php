@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Data Contact PIC Perusahaan</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('contacts.update', $dataContact->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="padding-top: 10px">
                        <div class="col-6">
                            <p>Nama</p>
                            <input id="" class="form-control" type="text" name="name" value="{{$dataContact->name}}"/>
                        </div>
                        <div class="col-6">
                            <p>Nomor Telepon</p>
                            <input id="" class="form-control" type="text" name="phone_number" value="{{$dataContact->phone_number}}"/>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-6">
                            <p>Email</p>
                            <input id="" class="form-control" type="text" name="email" value="{{$dataContact->email}}"/>
                        </div>
                        <div class="col-6">
                            <label for="demo_overview_minimal">Perusahaan</label>
                            <select data-live-search="true" id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_company" value="" selected="">
                                @foreach ($dataCompanies as $item)
                                <option value="{{ $item->id }}" {{$dataContact->id_company == $item->id  ? 'selected' : ''}}>{{ $item->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-6">
                            <p>Alamat</p>
                            <input id="" class="form-control" type="text" name="email" value="{{$dataContact->address}}"/>
                        </div>
                        <div class="col-6">
                            <p>Note</p>
                            <textarea name="note" id="" class="form-control" cols="30" rows="3" value="{{$dataContact->note}}"></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/contacts')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#demo_overview_minimal').selectpicker();
        } );
    </script>
@endpush