@extends('welcome')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-8">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-center">

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
            Secondary Stock Report
        </div>

        <div class="card-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6 ">

                        <form action="{{url('/secondarystockReport')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div style="margin-bottom:15px; " class="input-group">
                                <label>Report *</label>
                                <select name="category_id" class="form-control" style="width:20%;">
                                    <option>All</option>
                                    @foreach($category as $item)
                                    <option value="{{$item->id}}">{{$item->cat_name}}</option>
                                    @endforeach
                                </select>
                                <label>Stock As on *</label>
                                <input style="width:20%;" class="form-control" type="date" id="todayDate"
                                    name="report_date" />
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

                            <th>Item Catagory</th>
                            <th>Item Name</th>
                            <th>Receive</th>
                            <th>Issue</th>
                            <th>Current Stock</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reports as $item)
                        <tr>
                            <td>{{$item->cat_name}}</td>
                            <td>{{$item->item_name}}</td>
                            <td>{{$item->inqty}}</td>
                            <td>{{$item->ouqty}}</td>
                            <td>{{$item->totalQty}}</td>
                            <td>{{$item->totalAmount}}</td>
                            <td><button class="btn openrecord-button" data-tCode="{{ $item->inventoryID }}"> <i
                                        class="fa fa-eye" aria-hidden="true"></i></button>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


    </div><!-- /.card -->


    @endsection