@extends('admin.master')
@section('header')
    Add Product
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Product type</li>
@endsection
@section('main-content')
{{--    tao form them san pham--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('add-product')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product-name">Product name</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter product name">
                        </div>
                        <div class="form-group">
                            <label>Product type</label>
                            <select class="form-control" id="product-type" name="type">
                                <option value="1">CÀ PHÊ CHỒN CAO CẤP</option>
                                <option value="2">CÀ PHÊ CON SÓC</option>
                                <option value="3">CAFE TRUNG NGUYÊN</option>
                                <option value="4">TRÀ</option>
                                <option value="5">Phụ kiện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="product-desc" name="desc" rows="3" placeholder="Enter product description">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Unit price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" id="unit-price" name="price">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Promotion price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" id="promotion-price" name="promotion">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product-unit">Unit</label>
                            <input type="text" class="form-control" id="product-unit" name="unit" placeholder="Enter product unit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Product image</label>
                            <div class="input-group">
                                <input type="file" name="img" required="true">
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="new-product" name="new">
                            <label class="form-check-label" for="exampleCheck1">Check as a New product</label>
                        </div>
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
