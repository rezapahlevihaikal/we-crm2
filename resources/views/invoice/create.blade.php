@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Buat Data Invoice Baru</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="{{route('invoice.postCreateInvoice')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="">
                        <div class="col">
                            <label for="formGroupExampleInput2">Size</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="size">
                            </div>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Billed Value / Yang Ditagihkan</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="billed_value">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Perusahaan</label>
                            <select data-live-search="true" id="perusahaan" class="form-control" data-role="select-dropdown" data-profile="minimal" name="company_id" value="" selected="">
                                <option value="">PILIH NAMA PERUSAHAAN</option>
                                @foreach ($dataCompany as $item)
                                <option value="{{ $item->id }}">{{ $item->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Product</label>
                            <select data-live-search="true" id="product" class="form-control" data-role="select-dropdown" data-profile="minimal" name="product_id" value="" selected="">
                                <option value="">PILIH NAMA PRODUCT</option>
                                @foreach ($dataProduct as $item)
                                <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Start Date</label>
                            <input class="form-control" type="date" name="inv_date" id="">
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Expired Date</label>
                            <input class="form-control" type="date" name="exp_inv_date" id="">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Invoice Status</label>
                            <select id="source" class="form-control" data-role="select-dropdown" data-profile="minimal" name="inv_status_id" value="" selected="">
                                <option value="">PILIH STATUS</option>
                                @foreach ($dataStatusInv as $item)
                                <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">PIC / Nama Penerima</label>
                            <input class="form-control" type="text" name="pic_inv" id="">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Pajak</label>
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" value="11" name="ppn" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">PPN 11%</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Deskripsi</label>
                            <textarea class="form-control" name="inv_desc" id="" cols="30" rows="10" ></textarea>
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
        } );
    </script>
@endpush