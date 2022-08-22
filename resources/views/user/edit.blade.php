@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-body">
                <form class="" action="{{ route('userManagement.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <p>Nama</p>
                            <input id="" class="form-control" type="text" name="name" value="{{$dataUser->name}}"/>
                        </div>
                        <div class="col">
                            <p>Inisial</p>
                            <input id="" class="form-control" type="text" name="initial" value="{{$dataUser->initial}}"/>
                        </div>
                        <div class="col">
                            <p>Email</p>
                            <input id="" class="form-control" type="email" name="email" value="{{$dataUser->email}}"/>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Divisi</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_divisi" value="" selected="">
                                @foreach ($dataDivisi as $item)
                                <option value="{{ $item->id }}" {{$dataUser->id_divisi == $item->id  ? 'selected' : ''}}>{{ $item->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Core Bisnis</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_core_bisnis" value="" selected="">
                                @foreach ($dataCoreBisnis as $item)
                                <option value="{{ $item->id }}" {{$dataUser->id_core_bisnis == $item->id  ? 'selected' : ''}}>{{ $item->nama_core_bisnis}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Role Access</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_role" value="" selected="">
                                @foreach ($dataRole as $item)
                                <option value="{{ $item->id }}" {{$dataUser->id_role == $item->id  ? 'selected' : ''}}>{{ $item->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/userManagement')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection