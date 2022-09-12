@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Edit Data Deals</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Size</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="size" value="{{$dataInvoice->size}}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Nomor Invoice</label>
                            <input class="form-control" type="text" name="inv_number" id="disabledTextInput" value="{{$dataInvoice->inv_number}}" readonly>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Author</label>
                            <input class="form-control" type="text" name="inv_numbers" id="disabledTextInput" value="{{$dataInvoice->getUser->name ?? 'tidak ada'}}" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Perusahaan</label>
                            <input class="form-control" type="text" name="company_id" id="disabledTextInput" value="{{$dataInvoice->getCompany->company_name ?? 'tidak ada'}}" readonly>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Product</label>
                            <input class="form-control" type="text" name="product_id" id="disabledTextInput" value="{{$dataInvoice->getProduct->name ?? 'tidak ada'}}" readonly>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Nomor Order</label>
                            <input class="form-control" type="text" name="no_order" id="disabledTextInput" value="{{$dataInvoice->no_order ?? 'tidak ada'}}" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Pajak</label>
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" value="11" name="ppn" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">PPN 11%</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Billed Value</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="billed_value" value="{{$dataInvoice->billed_value}}">
                            </div>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Nomor Faktur Pajak</label>
                            <input class="form-control" type="text" name="faktur_pajak" value="{{$dataInvoice->faktur_pajak}}">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Invoice Status</label>
                            <select data-live-search="true" id="source" class="form-control" data-role="select-dropdown" data-profile="minimal" name="inv_status_id" value="" selected="">
                                @foreach ($dataStatusInv as $item)
                                <option value="{{ $item->id }}" {{$dataDeals->id_source == $item->id  ? 'selected' : ''}}>{{ $item->nama_source}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Stage</label>
                            {{-- <select data-live-search="true" id="stage" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_stage" value="" selected="">
                                @foreach ($dataStage as $item)
                                <option value="{{ $item->id }}" {{$dataDeals->id_stage == $item->id  ? 'selected' : ''}}>{{ $item->nama_stage}}</option>
                                @endforeach
                            </select> --}}
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
            $('#source').selectpicker();
            $('#stage').selectpicker();
        } );
    </script>
@endpush