@extends('admin.master')
@section('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
endsection
@section('header')
   List customer
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">List Customer</li>
@endsection
@section('main-content')
<div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone number</th>
                  <th>Note</th>

                </tr>
                </thead>
                <tbody>
                @foreach($customer as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->gender}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->address}}</td>
                  <td>{{$item->phone_number}}</td>
                  <td>{{$item->note}}</td>
                  
                  <td> 
                  <a href="/edit-customer/{{$item->id}}" class="btn btn-primary">Edit</a>
                  
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