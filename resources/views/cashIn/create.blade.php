@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Buat Cash In Baru</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('cashIn.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <label for="demo_overview_minimal">Invoice Number</label>
                            <select data-live-search="true" id="inv" class="form-control" data-role="select-dropdown" data-profile="minimal" name="inv_id" value="" selected="">
                                <option value="">PILIH INVOICE</option>
                                @foreach ($dataInvoice as $item)
                                <option value="{{ $item->id }}">{{ $item->inv_number}} | {{$item->company_name}} - {{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Tipe Cash In</label>
                            <select data-live-search="true" id="tipe_cash_id" class="form-control" data-role="select-dropdown" data-profile="minimal" name="tipe_cash_id" value="" selected="">
                                <option value="">PILIH TIPE</option>
                                @foreach ($dataTipeCashIn as $item)
                                <option value="{{ $item->id }}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="cash_in_date" id="">
                        </div>
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal Cash In</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="nominal" placeholder="" name="nominal_cash_in">
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal PPN</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="ppn" placeholder="" name="nominal_ppn">
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal PPH</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="pph" placeholder="" name="nominal_pph">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Bank Penerima</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="bank_penerima" required>
                                <option value="">PILIH BANK</option>
                                <option value="BRI">BRI</option>
                                <option value="BCA">BCA</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BNI">BNI</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Bukti Uang Masuk (Max : 5 MB)</label>
                            <input id="" class="form-control @error('file') is-invalid @enderror" type="file" name="file" value=""/>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/cashIn')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Create Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#inv').selectpicker();
            $('#nominal').mask('#.##0', {reverse: true});
            $('#ppn').mask('#.##0', {reverse: true});
            $('#pph').mask('#.##0', {reverse: true});
        } );


    </script>
@endpush