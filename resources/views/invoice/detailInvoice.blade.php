@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-header">
                Detail Sales Order
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
                                <th scope="col">AE Name</th>
                                <td>
                                    {{$dataDealsIn->getUser->name ?? 'Belum Dilengkapi'}}
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Amount</th>
                                <td>@currency($dataDealsIn->amount_po)</td>
                            </tr>
                            <tr>
                                <th scope="col">PPN 11%</th>
                                <td>
                                    @if ($dataDealsIn->ppn == 1)
                                        <button type="button" class="btn btn-primary btn-sm disabled">Include</button>
                                    @elseif ($dataDealsIn->ppn == 0)
                                        <button type="button" class="btn btn-success btn-sm disabled">Exlude</button>
                                    @elseif ($dataDealsIn->ppn == 3)
                                        <button type="button" class="btn btn-info btn-sm disabled">0%</button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm disabled">Tidak ada keterangan</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">PPH 23</th>
                                <td>
                                    @if ($dataDealsIn->pph_23 == 1)
                                        <button type="button" class="btn btn-primary btn-sm disabled">Dengan PPH 23</button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm disabled">Tidak Dengan PPH 23</button>
                                    @endif
                                </td>
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
                            <tr>
                                <th scope="col">file</th>
                                <td><a href="{{route('downloadMediaOrder', $dataDealsIn->id)}}">{{$dataDealsIn->file ?? 'Belum dilengkapi'}}</a></td>
                            </tr>
                            <tr>
                                <th scope="col">Note</th>
                                <td>{{$dataDealsIn->description ?? 'Belum dilengkapi'}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row" style="padding-top: 10px">
                        <button class="btn btn-success" onclick="window.location='{{url('/request-invoice-deals')}}'" type="reset">Back</button>
                    <form action="{{route('createInvoice',$dataDealsIn->id)}}" method="POST">
                        @csrf
                        @method('post')
                        @if($dataDealsIn->id_stage == 3)
                            <button class="btn btn-warning">Generate</button>
                        @endif
                    </form>
                    </div>
                    
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection