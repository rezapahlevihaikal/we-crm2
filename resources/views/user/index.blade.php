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
                  <h5 class="modal-title" id="exampleModalLabel">Add Data User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('userManagement.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Nama</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="name">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Inisial</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="initial">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Email</label>
                        <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="name@gmail.com" name="email">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Divisi</label>
                        <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_divisi">
                          <option value="">PILIH DIVISI</option>
                          @foreach ($dataDivisi as $item)
                            <option value="{{$item->id}}">{{$item->nama_divisi}}</option>    
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Core Bisnis</label>
                        <select id="dd" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_core_bisnis" data-live-search="true">
                          <option value="">PILIH CORE BISNIS</option>
                          @foreach ($dataCoreBisnis as $item)
                            <option value="{{$item->id}}">{{$item->nama_core_bisnis}}</option>    
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Role Access</label>
                        <select id="demo_overview_minimal" class="form-control" data-role="select-dropdown" data-profile="minimal" name="id_role">
                          <option value="">PILIH ROLE ACCESS</option>
                          @foreach ($dataRole as $item)
                            <option value="{{$item->id}}">{{$item->nama_role}}</option>    
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Password</label>
                        <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="" name="password">
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
                                <th scope="col">{{ __('Divisi') }}</th>
                                <th scope="col">{{ __('Core Bisnis') }}</th>
                                <th scope="col">{{ __('Role') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataUser as $item)
                              <tr style="text-align: center">
                                <td><a href="{{route('userManagement.edit', $item->id)}}" title="">{{$item->name}} <br> {{$item->initial}} </a></td>
                                <td>{{$item->getDivisiUser->nama_divisi ?? null}}</td>
                                <td>{{$item->getCoreBisnisUser->nama_core_bisnis ?? null}}</td>
                                <td>{{$item->getRole->nama_role ?? null}}</td>
                                <td>
                                  <form action="{{route('userManagement.destroy',$item->id)}}" method="POST">
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
        $(document).ready( function () {
            $('#dd').selectpicker();
        } );
        
    </script>
@endpush