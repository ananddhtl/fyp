<?php

use App\Models\NepaliCurrancyFormat;

$currancyformat = new NepaliCurrancyFormat();
?>
@extends('welcome')

@section('content')

<div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast toast-success" aria-live="polite"></div>
</div>

@if (Session::has('status'))


<div id="containerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added EquipmentCategory  Data</strong>
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
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Deleted Equipment Category Data</strong>
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
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Updated Equipment Category Data</strong>
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
                    <li class="breadcrumb-item active"><a href="/equipment/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/viewequipment">List</a></li>

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
            Equipment List
        </div>

        <div class="card-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6 ">
                        <form action="{{url('/equipmentsearch')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div style="margin-bottom:15px; " class="input-group">
                                <input type="text" autocomplete="off" name="equipment_name" class="form-control form-control-lg" placeholder="Enter equipment name">
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

                            <th>E.Name</th>
                            <th>E.Catagory.Name</th>
                            <th> Purchase Rate</th>
                           


                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>

                            <td>{{ $item->equipment_name }}</td>
                            <td>{{ $item->equipment_catagories_name }}</td>
                            <td>Rs {{ $currancyformat->moneyFormatIndia($item->purchase_rate)}} </td>

                            <td>
                                <a style="width:40px" href="{{url('edit-equipment/'.$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                <button style="width:40px" type="button" class="btn btn-danger btn-sm" onclick="showModal({{$item->id}})" data-toggle="modal" data-target="#exampleModalLong"><i class="fas fa-remove"></i>

                        </tr>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                <div style="font-size:20px;" class="row">


                </div>
            </ul>


            <ul class="pagination pagination-sm m-0 float-right">
                <div class="row">

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                    </form>
                    <a href="{{url('equipment-export')}}">


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
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Equipment</i></h5>
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
            document.getElementById("deleteItem").href = "/delete-equipment/" + id;
            $("#exampleModalLong").modal();

        }
    </script>

    @endsection