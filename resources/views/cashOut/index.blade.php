@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Daftar Cash Out</h3>
                    </div>
                    <div class="col text-right">
                      <button type="button" onclick="window.location='{{url('/cashOut/create')}}'" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Cash Out</button>
                    </div>
                </div>
            </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Type / Subtype')}}</th>
                                <th scope="col">{{ __('Payments')}}</th>
                                <th scope="col">{{ __('Price')}}</th>
                                <th scope="col">{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataCashOut as $item)
                            <tr style="text-align: center">
                                <td>
                                    <a href="{{route('cashOut.edit', $item->id)}}">{{$item->getSubTipe->name ?? 'not available'}}</a>
                                </td>
                                <td>
                                    date : {{$item->tanggal_transaksi}} <br>
                                    To : {{$item->dibayarkan_kepada}} <br>
                                    For : {{$item->ket_pembayaran}}
                                </td>
                                <td>
                                    @currency($item->nominal)
                                </td>
                                <td>
                                    <form action="{{route('cashOut.destroy',$item->id)}}" method="POST">
                                      @csrf
                                      @method('post')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yang bener?');"><i class="fas fa-trash"></i></button></td>
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