<?php
$category = DB::table('item_categories')->select('*')->get();
?>
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
                    <li class="breadcrumb-item active"><a href="/additemssettings">Add</a></li>
                    <li class="breadcrumb-item "><a href="/itemslist">List</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Items</h3>
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

        <form action="{{ url('/addItemSettingsData') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="title" class=" col-form-label"> Item Name:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="item_name" id="item_name"
                            placeholder="Enter Item Name" required >
                    </div>
                    <div class="col-sm-4">
                        <label for="title" class=" col-form-label"> Item Details:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="item_details"
                            id="item_details" placeholder="Enter Item Details" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="title" class=" col-form-label"> Item Category:* </label>
                        <select name="cat_id" class="form-control">
                            @foreach($category as $item)
                            @if(old('cat_id') == $item->id)
                            <option value="{{$item->id}}" selected>{{$item->cat_name}}</option>
                            @endif
                            @endforeach
                            @foreach($category as $item)
                            @if(old('cat_id') != $item->id)
                            <option value="{{$item->id}}">{{$item->cat_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="normal_rate" class=" col-form-label"> Normal Rate:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="normal_rate" id="normal_rate"
                            placeholder="Enter Normal Rate" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="title" class=" col-form-label"> Item Image:* </label>
                        <input type="file" name="cover_image" accept="image/*" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="unit" class=" col-form-label"> Unit:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="unit" id="unit"
                            placeholder="Enter Unit" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="normal_rate" class=" col-form-label"> Unit Value:* </label>
                        <input type="number" class="form-control " autocomplete="off" name="equals" id="equals"
                            placeholder="Enter Unit Value" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="sub_unit" class=" col-form-label"> Sub Unit* </label>
                        <input type="text" class="form-control " autocomplete="off" name="subunit" id="subunit"
                            placeholder="Enter SUb Unit " required>
                    </div>
                    <div class="col-sm-4">
                        <label for="sub_unit_value" class=" col-form-label"> Sub Unit Value:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="equal_value" id="equal_value"
                            placeholder="Enter Sub Unit Value" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="normal_rate" class=" col-form-label"> Is  vatable amount :* </label>
                        <input type="hidden" class="form-control " name="vatable" value="0">
                        <input type="checkbox" class="form-control " name="vatable" value="1" >
                    </div>
                    <div class="col-sm-3">
                        <label for="sub_unit" class=" col-form-label"> Discount in percentage* </label>
                        <input type="text" class="form-control " autocomplete="off" name="discount_in_percent" id="discount_in_percent"
                            placeholder="Discount %" >
                    </div>
                    <div class="col-sm-3">
                        <label for="sellrate" class=" col-form-label"> Sell Rate:* </label>
                        <input type="text" class="form-control " autocomplete="off" name="sellrate" id="sellrate"
                            placeholder="Enter Sell Rate" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="normal_rate" class=" col-form-label"> Is stockable:* </label>
                        <input type="hidden" class="form-control " name="stockable" value="0">
                        <input type="checkbox" class="form-control " name="stockable" value="1" >
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