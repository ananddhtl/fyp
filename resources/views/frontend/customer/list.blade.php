@extends('welcome')

@section('content')

<div id="toastsContainerTopRight" class="toasts-top-right fixed">
  <div class="toast toast-success" aria-live="polite"></div>
</div>

@if (Session::has('status'))


<div id="containerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added Customer Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('status')}}</div>
  </div>
</div>
@endif
@if (session('message'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Deleted Customer Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('message')}}</div>
  </div>
</div>

@endif
@if (session('messages'))
<div id="ContainerTopRight" style="margin-top:110px; " class="toasts-top-right ">
  <div class="alert alert-info alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Updated Customer Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('messages')}}</div>
  </div>
</div>
@endif


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-8">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-center">

        </ol>
      </div>

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">

          <li class="breadcrumb-item active"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/customer/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/customer/list">List</a></li>

        </ol>
      </div>
    </div>
  </div>
  <!-- Input addon -->

  <!-- /.card -->
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"></h3>
      Customer List
    </div>

    <div class="card-body">
      <div class="col-md-12">

        <div class="row">
          <div class="col-md-6 ">

            <form action="{{url('/customersearch')}}" method="GET" accept-charset="utf-8">
              @csrf
              <div style="margin-bottom:15px; " class="input-group">
                <input type="text" autocomplete="off" name="customer_name" class="form-control form-control-lg" placeholder="Customer name">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-lg btn-info">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div>
          
        </div>
        <table class="table  table-hover text-nowrap" id="mytable">
          <thead>
            <tr>

              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>DOB</th>
              <th>Profession</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            </thead>
          <tbody>
            @foreach($customers as $customer)
            <tr>

              <td>{{ $customer->customer_name }}</td>
              <td>{{ $customer->customer_address }}</td>
              <td>{{ $customer->customer_email }} </td>
              <td>{{ $customer->customer_phonenumber }} </td>
              <td>{{ $customer->dob }} </td>
              <td>{{ $customer->customer_profession}} </td>

              <td>
                <a style="width:40px" href="{{url('edit-customer/'.$customer->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                <button style="width:40px" type="button" class="btn btn-danger btn-sm" onclick="showModal({{$customer->id}})"><i class="fas fa-remove"></i>

                </button>



            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-left">
        <div style="font-size:20px;" class="row">
          {{ $customers->links() }}

        </div>
      </ul>


      <ul class="pagination pagination-sm m-0 float-right">
        <div class="row">

          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
          </form>
          <a href="{{route('customer.export')}}">


            <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

          </a>
        </div>

      </ul>
    </div>

  </div><!-- /.card -->










  <!-- Modal -->
  <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header bg bg-danger">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Customer</i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
          <a href="#" id="deleteItem" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>


  <script>
    function showModal(id) {
      document.getElementById("deleteItem").href = "/delete-customer/" + id;
      $("#exampleModalLong").modal();

    }
  </script>

  @endsection