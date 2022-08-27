@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Daftar Deals</h3>
                </div>
                <div class="col text-right">
                  <button type="button" onclick="window.location='{{url('/deals/create')}}'" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Data Deals</button>
                </div>
            </div>
          </div>
            <div class="card bg-secondary-default shadow">
                <div class="" style="padding:20px">
                    <table class="table table-bordered text-center" id="table-os">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name')}}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Stage') }}</th>
                                <th scope="col">{{ __('Priority') }}</th>
                                <th scope="col">{{ __('Core Bisnis') }}</th>
                                <th scope="col">{{ __('Company') }}</th>
                                <th scope="col">{{ __('Size') }}</th>
                                <th scope="col">{{ __('Schedule') }}</th>
                                <th scope="col">{{ __('Source') }}</th>
                                <th scope="col">{{ __('Product') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDeals as $item)
                              <tr style="text-align: center">
                                <td><a href="{{route('deals.edit', $item->id)}}" title="{{$item->name}}">{!! Str::limit($item->name, 45) !!}</a></td>
                                <td>{{$item->author}} <br> {{$item->created_at}} </td>
                                <td>
                                  @if($item->id_stage == 1)
                                    <button type="button" class="btn btn-primary">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 2)
                                    <button type="button" class="btn btn-secondary">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 3)
                                    <button type="button" class="btn btn-success">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 4)
                                    <button type="button" class="btn btn-danger">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 5)
                                    <button type="button" class="btn btn-warning">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 6)
                                    <button type="button" class="btn btn-info">{{$item->getStage->nama_stage}}</button>
                                  @elseif($item->id_stage == 7)
                                    <button type="button" class="btn btn-dark">{{$item->getStage->nama_stage}}</button>
                                  @endif
                                </td>
                                <td>{{$item->getPriority->nama_priority ?? null}}</td>
                                <td>{{$item->getCoreBisnis->nama_core_bisnis ?? null}}</td>
                                <td title="{{$item->getCompany->company_name ?? null}}">{!! Str::limit($item->getCompany->company_name ?? null, 45) !!}</td>
                                <td>
                                    Rp {{number_format($item->size)}}
                                </td>
                                <td>start : {{$item->start_date}}
                                     <br> end : {{$item->end_date}} 
                                     <br> exp : {{$item->expired_date}} 
                                </td>
                                <td>{{$item->getSource->nama_source ?? null}}</td>
                                <td title="{{$item->getProduct->name ?? null}}">{!! Str::limit($item->getProduct->name ?? null, 45) !!}</td>
                                <td>
                                  <form action="{{route('deals.destroy',$item->id)}}" method="POST">
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
                scrollX: true
            });
        } );
    </script>
@endpush