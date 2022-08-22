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
                  <h5 class="modal-title" id="exampleModalLabel">Add Data Contacts</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('contacts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="name">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nomor Telepon</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="phone_number">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Email</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="email">
                      </div>
                      <div class="form group">
                        <label for="formGroupExampleInput2">Perusahaan</label>
                        <select id="dd" class="form-control" data-live-search="true" data-role="select-dropdown" data-profile="minimal" name="id_company">
                            <option value="">PILIH PERUSAHAAN</option>
                            @foreach ($dataCompanies as $item)
                                <option value="{{$item->id}}">{{$item->company_name}}</option>    
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Alamat</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="address">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Note</label>
                        <textarea name="note" id="" class="form-control" cols="30" rows="3"></textarea>
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
                                <th scope="col">{{ __('Nama')}}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Telepon') }}</th>
                                <th scope="col">{{ __('Perusahaan') }}</th>
                                <th scope="col">{{ __('Alamat') }}</th>
                                <th scope="col">{{ __('Divisi') }}</th>
                                <th scope="col">{{ __('Core Bisnis') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataContact as $item)
                              <tr style="text-align: center">
                                <td><a href="{{route('contacts.edit', $item->id)}}" title="">{{$item->name}}</a></td>
                                <td>{{$item->author}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->getCompany->company_name ?? null}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->getDivisi->nama_divisi ?? null}}</td>
                                <td>{{$item->getCoreBisnis->nama_core_bisnis ?? null}}</td>
                                <td>
                                  <form action="{{route('contacts.destroy',$item->id)}}" method="POST">
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
                scrollX:true
            });
        } );
        $(document).ready( function () {
            $('#dd').selectpicker();
        } );
    </script>
@endpush