@extends('admin.master')
@section('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
endsection
@section('header')
   List product
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">List Product</li>
@endsection
@section('main-content')
<div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>type</th>
                  <th>Unit Price</th>
                  <th>Promotion Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $item)
                <tr>
                  <td>{{$item->name}}</td>
                  <td>{{$item->id_type}}</td>
                  <td>{{$item->unit_price}}</td>
                  <td>{{$item->promotion_price}}</td>
                  <td> 
                  <a href="/edit-product/{{$item->id}}" class="btn btn-primary">Edit</a>
                  <a href="/delete-product/{{$item->id}}" class="btn btn-danger">Remove</a>
                  </td>
                </tr>
                @endforeach
                
               
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- DataTables -->


@endsection
@section('script')
<!-- datatable -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection