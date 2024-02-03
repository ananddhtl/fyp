@extends('welcome')

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/itemcategory">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/itemcategorylist">List</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-8 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Item Category</h3>
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

        <form action="{{ url('/addCatagoryData') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="title" class=" col-form-label"> Title:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="cat_name" 
                            id="cat_name" placeholder="Enter Full Name" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Save" class="btn btn-info float-sm-left"></button>
            </div>
        </form>
    </div>
</div>



@endsection