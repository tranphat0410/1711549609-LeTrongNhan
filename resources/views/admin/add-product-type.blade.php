@extends('admin.master')
@section('header')
    Add Product type
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
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('add-product-type')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product-name">Product name type</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter product name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="product-desc" name="desc" rows="3" placeholder="Enter product description">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Product type image</label>
                            <div class="input-group">
                                <input type="file" name="img" required="true">
                            </div>
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
