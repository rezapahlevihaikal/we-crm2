@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-body">
                <form class="" action="{{ route('companies.update', $dataCompanies->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <p>Nama Perusahaan</p>
                            <input id="" class="form-control" type="text" name="company_name" value="{{$dataCompanies->company_name}}"/>
                        </div>
                        <div class="col">
                            <p>Nomor Telepon Perusahaan</p>
                            <input id="" class="form-control" type="text" name="phone_number_company" value="{{$dataCompanies->phone_number_company}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Alamat</p>
                            <input id="" class="form-control" type="text" name="address" value="{{$dataCompanies->address}}"/>
                        </div>
                        <div class="col">
                            <p>Kode Pos</p>
                            <input id="" class="form-control" type="text" name="zipcode" value="{{$dataCompanies->zipcode}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Situs Web</p>
                            <input id="" class="form-control" type="text" name="website" value="{{$dataCompanies->website}}"/>
                        </div>
                        <div class="col">
                            <p>Nama Dirut</p>
                            <input id="" class="form-control" type="text" name="nama_dirut" value="{{$dataCompanies->nama_dirut}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Note</p>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note_1" value="">{{$dataCompanies->note_1}}</textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/companies')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection