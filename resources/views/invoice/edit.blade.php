@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Data Invoice</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{route('invoice.updateRequest', $dataInvoice->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="">
                        <div class="col-3">
                            <label for="demo_overview_minimal">Nama AE</label>
                            <input class="form-control" type="text" name="inv_numbers" id="disabledTextInput" value="{{$dataInvoice->getUser->name ?? 'tidak ada'}}" readonly>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Amount PO</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="amount_po" placeholder="" name="amount_po" value="@currency($dataInvoice->amount_po)" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-3">
                            <label for="demo_overview_minimal">Nomor Invoice</label>
                            <input class="form-control" type="text" name="inv_number" id="disabledTextInput" value="{{$dataInvoice->inv_number}}">
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput2">Harga Pokok</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="based_value" value="@currency($dataInvoice->based_value)" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput2">Nilai PPH</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="based_value" value="@currency($dataInvoice->pph)" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="formGroupExampleInput2">Nilai PPN</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="based_value" value="@currency($dataInvoice->ppn)" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-6">
                            <label for="demo_overview_minimal">Perusahaan</label>
                            <select data-live-search="true" id="perusahaan" class="form-control" data-role="select-dropdown" data-profile="minimal" name="company_id" value="" selected="">
                                <option value="">PILIH PERUSAHAAN</option>
                                @foreach ($dataCompany as $item)
                                <option value="{{ $item->id }}" {{$dataInvoice->company_id == $item->id  ? 'selected' : ''}}>{{ $item->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Alamat NPWP Perusahaan</label>
                            <input class="form-control" type="text" name="address_npwp" id="disabledTextInput" value="{{$dataInvoice->address_npwp}}">
                        </div>
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">PPN</label>
                            <select class="form-control" data-role="select-dropdown" data-profile="minimal" name="ppn_id" value="" selected="">
                                @foreach ($dataPpn as $item)
                                    <option value="{{ $item->value }}" {{$dataInvoice->ppn_id == $item->value  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">PPH 23</label>
                            <select class="form-control" data-role="select-dropdown" data-profile="minimal" name="pph_id" value="" selected="">
                                @foreach ($dataPph as $item)
                                <option value="{{ $item->value }}" {{$dataInvoice->pph_id == $item->value  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-6">
                            <label for="demo_overview_minimal">Produk</label>
                            <select data-live-search="true" id="product" class="form-control" data-role="select-dropdown" data-profile="minimal" name="product_id" value="" selected="">
                                <option value="">PILIH PRODUK</option>
                                @foreach ($dataProduct as $item)
                                <option value="{{ $item->id }}" {{$dataInvoice->product_id == $item->id  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">UP</label>
                            <input class="form-control" type="text" name="pic_inv" id="" value="{{$dataInvoice->pic_inv}}" >
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Kode Kustomer</label>
                            <input class="form-control" type="text" name="no_order" id="disabledTextInput" value="{{$dataInvoice->no_order}}">
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Nomor Faktur Pajak</label>
                            <input class="form-control" type="text" name="faktur_pajak" value="{{$dataInvoice->faktur_pajak}}">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Start Date</label>
                            <input class="form-control" type="date" name="inv_date" id="" value="{{$dataInvoice->inv_date}}" >
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Aging Date</label>
                            <input class="form-control" type="date" name="exp_inv_date" id="" value="{{$dataInvoice->exp_inv_date}}" >
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Invoice Status</label>
                            <select id="source" class="form-control" data-role="select-dropdown" data-profile="minimal" name="inv_status_id" value="" selected="">
                                <option value="">PILIH STATUS</option>
                                @foreach ($dataStatusInv as $item)
                                <option value="{{ $item->id }}" {{$dataInvoice->inv_status_id == $item->id  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Deskripsi</label>
                            <textarea class="form-control" name="inv_desc" id="" cols="30" rows="10" >{{$dataInvoice->inv_desc}}</textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/invoice')}}'" type="reset">Back</button>
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
            $('#stage').selectpicker();
            // $('#amount_po').mask('#.##0', {reverse: true})
        } );
    </script>
@endpush