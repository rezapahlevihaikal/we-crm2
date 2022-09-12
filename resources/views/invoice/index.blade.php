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
                    <div class="col text-right">
                      <button type="button" onclick="window.location='{{url('#')}}'" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Invoice</button>
                    </div>
                </div>
            </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Product')}}</th>
                                <th scope="col">{{ __('Company')}}</th>
                                <th scope="col">{{ __('Size')}}</th>
                                <th scope="col">{{ __('Billed Value')}}</th>
                                <th scope="col">{{ __('Status')}}</th>
                                <th scope="col">{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataInvoice as $item)
                              <tr style="text-align: center">
                                <td><a href="{{route('invoice.editRequest', $item->id)}}" title="">{{$item->getProduct->name ?? 'Belum dilengkapi'}}</a>
                                </td>
                                <td>{{$item->getCompany->company_name ?? 'Belum dilengkapi'}}</td>
                                <td>Rp {{number_format($item->size)}}</td>
                                <td>
                                    Rp {{number_format($item->billed_value)}}
                                </td>
                                <td>{{$item->getStatus->name ?? 'Belum ada status'}}</td>
                                <td>#</td>
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
            });
        } );
    </script>
@endpush