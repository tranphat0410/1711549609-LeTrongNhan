@extends('admin.master')
@section('header')
    Add Bill
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Bill</li>
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
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('add-bill')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="product-name">id Customer</label>
                            <input type="text" class="form-control" id="product-name" name="id" placeholder="Enter id customer">
                        </div>
                            <label>Date order</label>
                            <input type="text" class="form-control" id="product-name" name="date_order" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product-name">Total</label>
                            <input type="text" class="form-control" id="product-name" name="total" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product-name">Payment</label>
                            <input type="text" class="form-control" id="product-name" name="payment" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="product-desc" name="note" rows="3" placeholder="">
                            </textarea>
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
