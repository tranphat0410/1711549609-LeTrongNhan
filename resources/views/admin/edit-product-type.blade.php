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
                <form id="editFrm" role="form" method="post" enctype="multipart/form-data" action="/edit-product-type/{{$productType->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product-name">Product name type</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter product name"value="{{$productType->name}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="product-desc" name="desc" rows="3" placeholder="Enter product description" value="{{$productType->description}}">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Product image</label>
                            <div class="input-group">
                                <img id="blah" src="{{asset('source/image/product/' . $productType->image)}}" alt="your image" style="width: 300px; height: 300px;"/>
                            </div><br>
                            <div class="input-group">
                                <input type="file" name="img" required="true" onchange="readURL(this);">
                            </div>
                        </div>
                        
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a id="submitBtn" class="btn btn-success">Update</a>
                        <a class="btn btn-warning" onclick="reset()">Reset</a>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(300);
                };
                reader.readAsDataURL(input.files[0]);
                $('#blah').show();
            }
        }
        function reset(){
            document.getElementById('editFrm').reset();
            $('#blah').attr('src','{{asset('source/image/product/' . $productType->image)}}');
        }
    
    </script>
@endsection