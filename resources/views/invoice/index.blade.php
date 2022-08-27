@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">

          {{-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fas fa-plus"></i> Add Data</button>

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Data Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('divisi.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama Divisi</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="nama_divisi">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div> --}}

            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Nama Deals')}}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Company') }}</th>
                                <th scope="col">{{ __('Size/PPN') }}</th>
                                <th scope="col">{{ __('No. Faktur Pajak') }}</th>
                                <th scope="col">{{ __('No. Invoice') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDealsIn as $item)
                              <tr style="text-align: center">
                                <td><a href="#" title="">{{$item->name}}</a></td>
                                <td>{{$item->author}}</td>
                                <td>{{$item->getCompany->company_name ?? null}}</td>
                                <td>
                                    Rp {{number_format($item->size)}}
                                    <br>
                                    PPN = Rp {{number_format($item->ppn)}}
                                </td>
                                <td>{{$item->no_faktur_pajak}}</td>
                                <td>{{$item->invoice_number}}</td>
                                <td>
                                  {{-- <button type="submit" onclick="window.location='{{url('/generateDeals')}}'" class="btn btn-success"><i class="far fa-file-alt"></i></button> --}}
                                  <a href="/generateDeals">e</a>
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
            });
        } );
    </script>
@endpush