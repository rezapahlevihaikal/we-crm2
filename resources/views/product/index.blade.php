@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">

          <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fas fa-plus"></i> Add Data</button>

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Data Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama Product</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="name">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Price List</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="price_list">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Jumlah</label>
                        <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="" name="quantity">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                      </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>

            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:25px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name')}}</th>
                                <th scope="col">{{ __('Price List') }}</th>
                                <th scope="col">{{ __('QTY') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataProduct as $item)
                              <tr style="">
                                <td style="text-align: left"><a href="{{route('products.edit', $item->id)}}" title="">{!! Str::limit($item->name, 60) !!}</a></td>
                                <td>Rp {{number_format($item->price_list)}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                  <form action="{{route('products.destroy',$item->id)}}" method="POST">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yang bener?');"><i class="fas fa-trash"></i></button></td>
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
                
            });
        } );
    </script>
@endpush