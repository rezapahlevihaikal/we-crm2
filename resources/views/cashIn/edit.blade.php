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
                <form class="" action="{{ route('cashIn.update', $dataCashIn->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <label for="demo_overview_minimal">Invoice Number</label>
                            <select data-live-search="true" id="inv" class="form-control" data-role="select-dropdown" data-profile="minimal" name="inv_id" value="" selected="">
                                <option value="">PILIH INVOICE</option>
                                @foreach ($dataInvoice as $item)
                                    <option value="{{ $item->id }}"{{$dataCashIn->inv_id == $item->id  ? 'selected' : ''}}>{{ $item->inv_number}} - {{$item->getCompany->company_name ?? 'kosong'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="cash_in_date" id="" value="{{$dataCashIn->cash_in_date}}">
                        </div>
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal Cash In</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="nominal" placeholder="" name="nominal_cash_in" value="{{$dataCashIn->nominal_cash_in}}">
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal PPN</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="ppn" placeholder="" name="nominal_ppn" value="{{$dataCashIn->nominal_ppn}}">
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Nominal PPH</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="pph" placeholder="" name="nominal_pph" value="{{$dataCashIn->nominal_pph}}">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Bank Penerima</label>
                            <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="bank_penerima" required>
                                <option value="">PILIH BANK</option>
                                <option value="BRI" {{$dataCashIn->bank_penerima == "BRI"  ? 'selected' : ''}}>BRI</option>
                                <option value="BCA" {{$dataCashIn->bank_penerima == "BCA"  ? 'selected' : ''}}>BCA</option>
                                <option value="Mandiri" {{$dataCashIn->bank_penerima == "Mandiri"  ? 'selected' : ''}}>Mandiri</option>
                                <option value="BNI" {{$dataCashIn->bank_penerima == "BNI"  ? 'selected' : ''}}>BNI</option>
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
                            {{$dataCashIn->file}}
                        </div> 
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10">{{$dataCashIn->deskripsi}}</textarea>
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