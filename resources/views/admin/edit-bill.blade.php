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
                <form role="form" method="post" enctype="multipart/form-data" action="/edit-bill/{{$bill->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                    <div class="form-group">
                    <div class="form-group">
                            <label for="product-name">id</label>
                            <input type="text" class="form-control" id="product-name" name="id1" placeholder="Enter id customer" value="{{$bill->id1}}">
                        </div>
                        <div class="form-group">
                            <label for="product-name">id Customer</label>
                            <input type="text" class="form-control" id="product-name" name="id" placeholder="Enter id customer"value="{{$bill->id}}">
                        </div>
                            <label>Date order</label>
                            <input type="text" class="form-control" id="product-name" name="date_order" placeholder=""value="{{$bill->date_order}}">
                        </div>
                        <div class="form-group">
                            <label for="product-name">Total</label>
                            <input type="text" class="form-control" id="product-name" name="total" placeholder=""value="{{$bill->total}}">
                        </div>
                        <div class="form-group">
                            <label for="product-name">Payment</label>
                            <input type="text" class="form-control" id="product-name" name="payment" placeholder=""value="{{$bill->payment}}">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="product-desc" name="note" rows="3" placeholder=""value="{{$bill->note}}">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="product-name">Status_id</label>
                            <input type="text" class="form-control" id="product-name" name="status_id" placeholder=""value="{{$bill->status_id}}">
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
