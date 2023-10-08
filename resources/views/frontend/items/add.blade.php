@extends('welcome')

@section('content')
<div id="ContainerTopRight" style="margin-top:110px; display:none;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Data</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">Saved successfully!</div>
    </div>
</div>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/items/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/items/list">List</a></li>

                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-8">




    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Items </h3>
        </div>

        @if($errors->any())
        <div class="m-2 p-2">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="form-control form-control is-invalid">{{$error}}</div>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{url('items/store')}}" method="POST">
            @csrf
            <div class="card-body">



                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="Unit" class=" col-form-label">Title:* </label>

                        <input type="text" class="form-control" name="itemName" autocomplete="off" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="Unit" class=" col-form-label">Unit:* </label>

                        <input type="text" class="form-control" name="itemUnit" autocomplete="off" id="sub_unit" placeholder="Enter Unit" required>
                    </div>


                </div>

            </div>

            <div class="card-footer">
                <input type="submit" value="Save " class="btn btn-info float-sm-left"></button>

            </div>

        </form>
    </div>


</div>


@endsection