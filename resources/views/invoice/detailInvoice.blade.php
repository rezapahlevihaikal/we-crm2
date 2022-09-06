@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-header">
                Detail Invoice From Deals
            </div>
            <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            {{-- <tr>
                                <th scope="col">Nama Deals</th>
                                <td>{{$dataDealsIn->name}}</td>
                            </tr> --}}
                            <tr>
                                <th scope="col">Perusahaan</th>
                                <td>
                                    {{$dataDealsIn->getCompany->company_name ?? 'Belum dilengkapi'}}
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Author</th>
                                <td>
                                    {{$dataDealsIn->author}}
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Size</th>
                                <td>Rp {{number_format($dataDealsIn->size)}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Pajak</th>
                                <td>Rp {{number_format($dataDealsIn->ppn)}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Produk</th>
                                <td>{{$dataDealsIn->getProduct->name ?? 'Belum dilengkapi'}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Source</th>
                                <td>{{$dataDealsIn->getSource->nama_source ?? 'Belum dilengkapi'}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Stage</th>
                                <td>{{$dataDealsIn->getStage->nama_stage ?? 'Belum dilengkapi'}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Start Date</th>
                                <td>{{$dataDealsIn->start_date ?? 'Belum dilengkapi'}}</td>
                            </tr>
                            <tr>
                                <th scope="col">End Date</th>
                                <td>{{$dataDealsIn->end_date ?? 'Belum dilengkapi'}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Expired Date</th>
                                <td>{{$dataDealsIn->expired_date ?? 'Belum dilengkapi'}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row" style="padding-top: 10px">
                        <button class="btn btn-success" onclick="window.location='{{url('/request-invoice-deals')}}'" type="reset">Back</button>
                    <form action="{{route('createInvoice',$dataDealsIn->id)}}" method="POST">
                        @csrf
                        @method('post')
                        @if($dataDealsIn->id_stage == 3)
                            <button class="btn btn-warning">Create invoice</button>
                        @endif
                    </form>
                    </div>
                    
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection