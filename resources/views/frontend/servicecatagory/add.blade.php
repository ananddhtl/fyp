@extends('welcome')

@section('content')
@if (session('text'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;This catagory name is already exist.</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('text')}}</div>
  </div>
</div>

@endif


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="/servicecatagory/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/servicecatagory/list">List</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-md-6">



  <!-- Input addon -->

  <!-- /.card -->
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Add Service Catagory</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if($errors->any())
    <div class="m-2 p-2">
      <ul>
        @foreach ($errors->all() as $error)
        <div class="form-control form-control is-invalid">{{$error}}</div>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{route('postServiceCatagoryData')}}" method="POST">
      @csrf
      <div class="card-body">


        <div class="form-group row">
          <!-- <label for="service_catagory_name" class="col-sm-2 col-form-label"> Title</label> -->

          <div class="col-sm-12">
          <label for="service_catagory_name" class=" col-form-label"> Catagory Name:*</label>
            <input type="text" name="service_catagory_name" autocomplete="off"class="form-control" id="service_catagory_name" placeholder="Enter  Category Name"required  >
          </div>
        </div>

      </div>
     
      <div class="card-footer">
        <input type="submit" value="Save " class="btn btn-info float-sm-left"></button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>



@endsection