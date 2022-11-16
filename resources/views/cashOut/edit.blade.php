@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Cash Out</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('cashOut.update', $dataCashOut->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <label for="demo_overview_minimal">Sub Tipe</label>
                            <select data-live-search="true" id="perusahaan" class="form-control" data-role="select-dropdown" data-profile="minimal" name="subtipe_id" value="" selected="">
                                @foreach ($dataSubTipe as $item)
                                <option value="{{ $item->id }}"{{$dataCashOut->subtipe_id == $item->id  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="nominal" value="{{$dataCashOut->nominal}}">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="tanggal_transaksi" id="" value="{{$dataCashOut->tanggal_transaksi}}">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Dibayarkan Kepada</label>
                            <input type="text" class="form-control" name="dibayarkan_kepada" value="{{$dataCashOut->dibayarkan_kepada}}">
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Keterangan Pembayaran</label>
                            <input type="text" class="form-control" name="ket_pembayaran" value="{{$dataCashOut->ket_pembayaran}}">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Produk (Diinput untuk keperluan Event)</label>
                            <select data-live-search="true" id="product" class="form-control" data-role="select-dropdown" data-profile="minimal" name="product_id" value="" selected="">
                                @if (empty($dataCashOut->product_id))
                                    <option value="">Pilih Nama Produk</option>
                                @endif
                                @foreach ($dataProduct as $item)
                                    <option value="{{ $item->id }}"{{$dataCashOut->product_id == $item->id  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Core Bisnis</label>
                            <select data-live-search="true" id="source" class="form-control" data-role="select-dropdown" data-profile="minimal" name="core_bisnis_id" value="" selected="">
                                @if (empty($dataCashOut->core_bisnis_id))
                                    <option value="">Pilih Nama Core Bisnis</option>
                                @endif
                                @foreach ($dataCoreBisnis as $item)
                                    <option value="{{ $item->id }}"{{$dataCashOut->core_bisnis_id == $item->id  ? 'selected' : ''}}>{{ $item->nama_core_bisnis}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">File (Max : 5 MB)</label>
                            <input id="" class="form-control @error('file') is-invalid @enderror" type="file" name="file" value=""/>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <a href="{{route('cashOut.getFileCashOut', $dataCashOut->id)}}">{{$dataCashOut->file}}</a>
                        </div> 
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/cashOut')}}'" type="reset">Back</button>
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
            $('#perusahaan').selectpicker();
            $('#product').selectpicker();
            $('#source').selectpicker();
            $('#stage').selectpicker();
            $('#priority').selectpicker();
        } );


    </script>
@endpush