@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Daftar Invoice</h3>
                    </div>
                    {{-- <div class="col text-right">
                      <button type="button" onclick="window.location='{{url('/invoice/createSingleInvoice')}}'" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Invoice</button>
                    </div> --}}
                </div>
            </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Product')}}</th>
                                <th scope="col">{{ __('Date')}}</th>
                                <th scope="col">{{ __('Company')}}</th>
                                <th scope="col">{{ __('Amount PO')}}</th>
                                <th scope="col">{{ __('Harga Pokok')}}</th>
                                <th scope="col">{{ __('Remarks')}}</th>
                                <th scope="col">{{ __('Status')}}</th>
                                <th scope="col">{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataInvoice as $item)
                              <tr style="text-align: center">
                                <td>
                                    <a href="{{route('invoice.editRequest', $item->id)}}" title="{{$item->getProduct->name}}">
                                        {{-- {{$item->getProduct->name ?? 'Belum dilengkapi'}} --}}
                                        {!! Str::limit($item->getProduct->name, 60 ?? 'belum dilengkapi') !!}
                                    </a>
                                    <br>
                                    AE Name : {{$item->getUser->name ?? 'Belum Dilengkapi'}} <br>
                                </td>
                                <td style="text-align: left">
                                    Start : {{ $item->inv_date ?? 'Kosong' }} <br>
                                    Aging / Cash In : {{ $item->exp_inv_date ?? 'Kosong' }}
                                </td>
                                <td>{{$item->getCompany->company_name ?? 'Belum dilengkapi'}}</td>
                                
                                {{-- <td>Rp {{$item->getDeals->amount_po ?? '0'}}</td> --}}
                                <td>@currency($item->getDeals->amount_po ?? '0')</td>
                                <td>@currency($item->based_value)</td>
                                <td>{{$item->remarks}}</td>
                                <td>
                                    @if ($item->inv_status_id == 1)
                                        <button type="button" class="btn-sm btn-primary">{{$item->getStatus->name ?? 'Belum ada status'}}</button>
                                    @elseif($item->inv_status_id == 2)
                                        <button type="button" class="btn-sm btn-secondary">{{$item->getStatus->name ?? 'Belum ada status'}}</button>
                                    @elseif($item->inv_status_id == 3)
                                        <button type="button" class="btn-sm btn-warning">{{$item->getStatus->name ?? 'Belum ada status'}}</button>
                                    @elseif($item->inv_status_id == 4)
                                        <button type="button" class="btn-sm btn-success">{{$item->getStatus->name ?? 'Belum ada status'}}</button>
                                    @endif
                                </td>
                                <td>
                                    
                                        <form action="{{route('invoice.delete',$item->id)}}" method="POST">
                                            <a class="btn-sm btn-info" href="{{route('generateDeals', $item->id)}}" role="button"><i class="fas fa-file-pdf"></i></a>
                                            <a class="btn-sm btn-success" href="{{route('getMediaOrder', $item->id)}}" role="button"><i class="fas fa-file-invoice"></i></a>
                                            @csrf
                                            @method('post')
                                            @if ($item->inv_status_id == 1)
                                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Yang bener?');"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </form>
                                    
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
                scrollX: true,
                ordering: false,
            });
        } );
    </script>
@endpush