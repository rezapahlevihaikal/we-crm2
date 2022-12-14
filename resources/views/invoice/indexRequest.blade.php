@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Daftar Deals Request</h3>
                </div>
            </div>
          </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    {{-- <div class="row" style="padding-bottom: 20px">
                      <div class="col-4">
                        <label for="demo_overview_minimal">From</label>
                        <input class="form-control" type="text" name="min" id="min">
                      </div>
                      <div class="col-4">
                        <label for="demo_overview_minimal">To</label>
                        <input class="form-control" type="text" name="max" id="max">
                      </div>
                    </div> --}}
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Company') }}</th>
                                <th scope="col">{{ __('Size') }}</th>
                                <th scope="col">{{ __('Date') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDealsIn as $item)
                              <tr style="text-align: center">
                                {{-- <td>
                                  <a href="{{route('detailInvoice', $item->id)}}" title="">{{$item->name}}</a>
                                  <br>
                                  Author : {{$item->author}}
                                </td> --}}
                                <td>
                                  <a href="{{route('detailInvoice', $item->id)}}">{{$item->getCompany->company_name ?? "Belum Dilengkapi"}}</a>
                                  <br>
                                  AE Name : {{$item->author}} <br>
                                  Event : {{$item->getProduct->name ?? 'Kosong'}}
                                </td>
                                <td>Rp{{number_format($item->size)}}</td>
                                <td>@date($item->created_at)</td>
                                <td>
                                  @if($item->id_stage == 1)
                                    <button type="button" class="btn-sm btn-primary">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 2)
                                    <button type="button" class="btn-sm btn-secondary">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 3)
                                    <button type="button" class="btn-sm btn-success">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 4)
                                    <button type="button" class="btn-sm btn-danger">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 5)
                                    <button type="button" class="btn-sm btn-warning">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 6)
                                    <button type="button" class="btn-sm btn-info">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 7)
                                    <button type="button" class="btn-sm btn-dark">{{$item->getStage->nama_stage}}</button>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
@push('js')
    <script type="text/javascript">
       $(document).ready( function () {
            $('#table-os').DataTable({
                scrollX: true
                // ordering: false,
            });
        } );
    </script>
@endpush