@extends('admin.master')
@section('header')
    Add Customer
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">List customer</li>
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
                <form id="editFrm" role="form" method="post" enctype="multipart/form-data" action="/edit-customer/{{$customer->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                    <div class="form-group">
                            <label for="product-name"> id</label>
                            <input type="text" class="form-control" id="product-name" name="id" placeholder="Enter your name" value="{{$customer->id}}">
                        </div>
                        <div class="form-group">
                            <label for="product-name"> name</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter your name" value="{{$customer->name}}">
                        </div>
                        <div class="form-group">
                            <label>Gender</label></br>
                            
                                <input type="radio" name="gender" value="Nam">Nam</input>
                                <input type="radio" name="gender" value="Nữ">Nữ</input>
                                
                                
                            
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <textarea class="form-control" id="product-desc" name="email" rows="1" placeholder="Enter your email"value="{{$customer->email}}">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>address</label>
                            <textarea class="form-control" id="product-desc" name="address" rows="2" placeholder="Enter your address"value="{{$customer->address}}">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="product-name"> Phone number</label>
                            <input type="text" class="form-control" id="product-name" name="phone" placeholder="Enter your phone number"value="{{$customer->phone_number}}">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="product-desc" name="note" rows="3" placeholder=""value="{{$customer->note}}">
                            </textarea>
                        </div>
                        
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a id="submitBtn" class="btn btn-success">Update</a>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $("#submitBtn").click(function(){
                if (confirm("Click OK to continue?")){
                    $('#editFrm').submit();
                }
            });
        });
       
     </script>
@endsection
    

