@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Daftar Cash In</h3>
                    </div>
                    <div class="col text-right">
                      <button type="button" onclick="window.location='{{url('/cashIn/create')}}'" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Cash In</button>
                    </div>
                </div>
            </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Invoice')}}</th>
                                <th scope="col">{{ __('Payments')}}</th>
                                <th scope="col">{{ __('Info')}}</th>
                                <th scope="col">{{ __('Bank')}}</th>
                                <th scope="col">{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataCashIn as $item)
                            <tr style="text-align: center">
                                <td>
                                    {{$item->inv_number ?? 'kosong'}} <br>
                                    {{$item->cash_in_date}}
                                </td>
                                <td>
                                    @currency($item->nominal_cash_in) <br>
                                    PPN : @currency($item->nominal_ppn) <br>
                                    PPH : @currency($item->nominal_pph)
                                </td>
                                <td>
                                    {{$item->company_name}}
                                    <br>
                                    {{$item->name}}
                                    <br>
                                    Type : {{$item->name}}
                                </td>
                                <td>
                                    {{$item->bank_penerima}}
                                </td>
                                <td>
                                    <a href="{{route('cashIn.edit', $item->id)}}" class="btn btn-success btn-sm" role="button" aria-disabled="true"><i class="fas fa-edit"></i></a>
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
                // scrollX: true,
                ordering: false,
            });
        } );
    </script>
@endpush