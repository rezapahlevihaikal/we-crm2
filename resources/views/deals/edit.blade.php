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
                <form class="" action="{{ route('deals.update', $dataDeals->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="padding-top: 10px">
                        {{-- <div class="col">
                            <label for="formGroupExampleInput2">Nama</label>
                            <input id="" class="form-control" type="text" name="name" value="{{$dataDeals->name}}"/>
                        </div> --}}
                        <div class="col">
                            <label for="formGroupExampleInput2">Size</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="size" value="{{$dataDeals->size}}">
                            </div>
                        </div>
                        <div class="col">
                            <label for="">File (Max : 5 MB)</label>
                            <input class="form-control" type="file" name="file" value="{{$dataDeals->file}}">
                            <a href="{{route('deals.downloadFileDeals', $dataDeals->id)}}">{{$dataDeals->file}}</a>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Perusahaan</label>
                            <select data-live-search="true" id="perusahaan" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_company" value="" selected="">
                                @foreach ($dataCompany as $item)
                                <option value="{{ $item->id }}"{{$dataDeals->id_company == $item->id  ? 'selected' : ''}}>{{ $item->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Product</label>
                            <select data-live-search="true" id="product" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_product" value="" selected="">
                                @foreach ($dataProduct as $item)
                                <option value="{{ $item->id }}" {{$dataDeals->id_product == $item->id  ? 'selected' : ''}}>{!! Str::limit($item->name, 60) !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="demo_overview_minimal">Source</label>
                            <select data-live-search="true" id="source" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_source" value="" selected="">
                                @foreach ($dataSource as $item)
                                <option value="{{ $item->id }}" {{$dataDeals->id_source == $item->id  ? 'selected' : ''}}>{{ $item->nama_source}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="demo_overview_minimal">Stage</label>
                            <select data-live-search="true" id="stage" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_stage" value="" selected="">
                                @foreach ($dataStage as $item)
                                <option value="{{ $item->id }}" {{$dataDeals->id_stage == $item->id  ? 'selected' : ''}}>{{ $item->nama_stage}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                            <div class="col">
                                <label for="formGroupExampleInput2">Amount PO (Diinput bila stage sudah WON)</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="amount_po" placeholder="" name="amount_po" value="{{$dataDeals->amount_po ?? 0}}">
                                </div>
                            </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Start Date</label>
                            <input id="" class="form-control" type="date" name="start_date" value="{{$dataDeals->start_date}}"/>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">End Date</label>
                            <input id="" class="form-control" type="date" name="end_date" value="{{$dataDeals->end_date}}"/>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">Expired Date</label>
                            <input id="" class="form-control" type="date" name="expired_date" value="{{$dataDeals->expired_date}}"/>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px;">
                        <div class="col">
                            <label for="formGroupExampleInput2">PPN 11%</label>
                            <select id="ppn" class="form-control" data-role="select-dropdown" data-profile="minimal" name="ppn">
                                @foreach ($dataStatusTax as $item)
                                <option value="{{ $item->value }}" {{$dataDeals->ppn == $item->value  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput2">PPH 23</label>
                            <select class="form-control" data-role="select-dropdown" data-profile="minimal" name="pph_23">
                                @foreach ($dataStatusPph as $item)
                                    <option value="{{ $item->value }}" {{$dataDeals->pph_23 == $item->value  ? 'selected' : ''}}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col">
                            <label for="formGroupExampleInput2">Description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$dataDeals->description}}</textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/deals')}}'" type="reset">Back</button>
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
            $('#inlineFormInputGroup').mask('#.##0', {reverse: true});
            $('#amount_po').mask('#.##0', {reverse: true});
            
        } );

        
    </script>
@endpush