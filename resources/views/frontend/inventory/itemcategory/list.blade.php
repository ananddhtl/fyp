@extends('welcome')

@section('content')

<div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast toast-success" aria-live="polite"></div>
</div>

@if (Session::has('stored'))
<div id="containerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{session('stored')}}</div>
    </div>
</div>
@endif
@if (session('deleted'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{session('deleted')}}</div>
    </div>
</div>

@endif
@if (session('updated'))
<div id="ContainerTopRight" style="margin-top:110px; " class="toasts-top-right ">
    <div class="alert alert-info alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Updated Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{session('updated')}}</div>
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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/itemcategory">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/itemcategorylist">List</a></li>

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
            Category List
        </div>

        <div class="card-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6 ">

                        <form action="{{url('/itemcategorylist')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div style="margin-bottom:15px; " class="input-group">
                                <input type="text" autocomplete="off" name="cat_name" 
                                    class="form-control form-control-lg" placeholder="Enter title name">
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
                            <th>Title</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($list as $item)
                        <tr>

                            <td>{{ $item->cat_name }}</td>
                            <td>
                                <a style="width:40px" href="{{url('edit-category/'.$item->id)}}"
                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                <button style="width:40px" type="button" class="btn btn-danger btn-sm"
                                    onclick="showModal({{$item->id}})"><i class="fas fa-remove"></i>

                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                <div style="font-size:20px;" class="row">
                    {{ $list->links() }}

                </div>
            </ul>


            <ul class="pagination pagination-sm m-0 float-right">
                <div class="row">

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                    </form>
                    <a href="{{route('customer.export')}}">


                        <button type="button" class="btn btn-block btn-info"> <i
                                class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

                    </a>
                </div>

            </ul>
        </div>

    </div><!-- /.card -->










    <!-- Modal -->
    <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header bg bg-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Item</i></h5>
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
        document.getElementById("deleteItem").href = "/deleteCatagory/" + id;
        $("#exampleModalLong").modal();

    }
    </script>

    @endsection