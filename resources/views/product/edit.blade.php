@extends('layouts.app')

@section('content')
@include('layouts.headers.header')
    <div class="container-fluid mt--7">
        <div class="card">
            <div class="card-body">
                <form class="" action="{{ route('products.update', $dataProduct->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <p>Nama Product</p>
                            <input id="" class="form-control" type="text" name="name" value="{{$dataProduct->name}}"/>
                        </div>
                        <div class="col">
                            <p>Price List</p>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="" name="price_list" value="{{$dataProduct->price_list}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Jumlah</p>
                            <input id="" class="form-control" type="number" name="quantity" value="{{$dataProduct->quantity}}"/>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" onclick="window.location='{{url('/products')}}'" type="reset">Back</button>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                  </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection