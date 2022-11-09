@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Tipe</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('subTipe.update', $dataSub->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12">
                            <p>Nama Sub Tipe</p>
                            <input id="" class="form-control" type="text" name="name" value="{{$dataSub->name}}"/>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Tipe Cost</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="tipe_id" value="" selected="">
                                @foreach ($dataTipe as $item)
                                    <option value="{{ $item->id }}" {{$dataSub->tipe_id == $item->id  ? 'selected' : ''}}>{{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/tipeCost')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection