@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">

          <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Daftar Tpe Cost</h3>
                </div>
                <div class="col text-right">
                  <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Stage</button>
                </div>
            </div>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tipe Cost</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('subTipe.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama Sub Tipe</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="name">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Tipe Cost</label>
                        <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="tipe_id">
                            <option value="">PILIH TIPE</option>
                            @foreach ($dataTipe as $item)
                              <option value="{{$item->id}}">{{$item->nama}}</option>    
                            @endforeach
                          </select>
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
                                <th scope="col">{{ __('Nama Sub Tipe')}}</th>
                                <th scope="col">{{ __('Tipe Cost') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataSub as $item)
                              <tr style="text-align: center">
                                <td>{{$item->name}}</td>
                                <td>{{$item->getTipeCost->nama ?? 'kosong'}}</td>
                                <td>
                                  <form action="{{route('subTipe.destroy',$item->id)}}" method="POST">
                                    <a href="{{route('subTipe.edit', $item->id)}}" class="btn btn-success btn-sm" role="button" aria-disabled="true"><i class="fas fa-edit"></i></a>
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
                
            });
        } );
    </script>
@endpush