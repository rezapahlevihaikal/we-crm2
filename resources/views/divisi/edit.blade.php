@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Data Divisi</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('divisi.update', $dataDivisi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12">
                            <p>Nama Divisi</p>
                            <input id="" class="form-control" type="text" name="nama_divisi" value="{{$dataDivisi->nama_divisi}}"/>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/divisi')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection