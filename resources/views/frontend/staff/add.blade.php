@extends('welcome')

@section('content')
@if (session('text'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Same Contact Number</strong>
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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/staff/add">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/staff/list">List</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-8 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Staff </h3>

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

        <form action="{{url('postStaffData')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-6">

                        <label for="customer_name" class="col-form-label"> Full Name:* </label>



                        <input type="text" class="form-control " autocomplete="off" name="staff_name" id="staff_name"
                            placeholder="Enter Full Name" required>

                    </div>
                    <div class="col-sm-6">
                        <label for="customer_address" class="col-form-label"> Address:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="staff_address"
                            id="staff_address" placeholder="Enter Address" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="customer_email" class=" col-form-label"> Email:*</label>

                        <input type="email" class="form-control" autocomplete="off" name="staff_email" id="staff_email"
                            placeholder="Enter Email">
                    </div>
                    <div class="col-sm-6">
                        <label for="customer_phonenumber" class=" col-form-label">Contact No:*</label>

                        <input type="number" class="form-control" autocomplete="off" name="staff_phonenumber"
                            id="staff_phonenumber" placeholder="Enter Contact Number" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="customer_position" class="col-form-label">Position:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="staff_position"
                            id="staff_position" placeholder="Enter  Position" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="dob" class="col-form-label">Date Of Birth:*</label>

                        <input type="date" class="form-control" name="dob" id="dob" placeholder=" Enter Date Of Birth">
                    </div>


                    <div class="col-sm-4">
                        <label for="customer_profession" class=" col-form-label"> Profession:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="staff_profession"
                            id="staff_profession" placeholder=" Enter Profession">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <input type="submit" value="Save" class="btn btn-info float-sm-left"></button>


            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>



@endsection