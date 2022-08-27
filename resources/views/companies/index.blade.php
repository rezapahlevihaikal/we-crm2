@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Daftar Perusahaan</h3>
                </div>
                <div class="col text-right">
                  <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Perusahaan</button>
                </div>
            </div>
        </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Data Companies</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('companies.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="company_name">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nomor Telepon Perusahaan</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="phone_number_company">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Alamat</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="address">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Kode Pos</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="zipcode">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Situs Web Perusahaan</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="website">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama Dirut</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="nama_dirut">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Note</label>
                        <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note_1" value=""></textarea>
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
                                <th scope="col">{{ __('Nama Perusahaan')}}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Telepon') }}</th>
                                <th scope="col">{{ __('Alamat') }}</th>
                                <th scope="col">{{ __('Kode Pos') }}</th>
                                <th scope="col">{{ __('Situs Web') }}</th>
                                <th scope="col">{{ __('Nama Dirut') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataCompanies as $item)
                              <tr style="text-align: center">
                                <td><a href="{{route('companies.edit', $item->id)}}" title="">{!! Str::limit($item->company_name, 40) !!}</a></td>
                                <td>{{$item->author}} <br> {{$item->created_at}} </td>
                                <td>{{$item->phone_number_company}}</td>
                                <td>{!! Str::limit($item->address, 40) !!}</td>
                                <td>{{$item->zipcode}}</td>
                                <td>{{$item->website}}</td>
                                <td>{{$item->nama_dirut}}</td>
                                <td>
                                  <form action="{{route('companies.destroy',$item->id)}}" method="POST">
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
                scrollX:true,
            });
        } );
    </script>
@endpush