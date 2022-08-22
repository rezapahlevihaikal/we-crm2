@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-body">
                <form class="" action="{{ route('coreBisnis.update', $dataCoreBisnis->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <p>Nama Core Bisnis</p>
                            <input id="" class="form-control" type="text" name="nama_core_bisnis" value="{{$dataCoreBisnis->nama_core_bisnis}}"/>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Divisi</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_divisi" value="" selected="">
                                @foreach ($dataDivisi as $item)
                                <option value="{{ $item->id }}" {{$dataCoreBisnis->id_divisi == $item->id  ? 'selected' : ''}}>{{ $item->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/coreBisnis')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection