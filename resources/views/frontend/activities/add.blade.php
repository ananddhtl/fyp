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
                    <li class="breadcrumb-item active"><a href="/activities/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/activities/list">List</a></li>

                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-10">




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
        <form action="{{route('postActivitiesData')}}" method="POST">
            @csrf
            <div class="card-body">


                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="activites_title" class=" col-form-label">Title:*</label>

                        <input type="text" class="form-control" name="activities_title" autocomplete="off" id="activities_title" placeholder="Enter  Title" required>
                    </div>


                    <div class="col-sm-6">
                        <label for="activites_subtitle" class="col-form-label"> SubTitle:* </label>

                        <input type="text" class="form-control" name="activities_subtitle" autocomplete="off" id="activities_subtitle" placeholder="Enter SubTitle " required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="Unit" class=" col-form-label">Unit:* </label>

                        <input type="text" class="form-control" name="unit" autocomplete="off" id="unit" placeholder="Enter Unit" required>
                    </div>


                    <div class="col-sm-6">
                        <label for="activity_catagories_id" class=" col-form-label">Catagory:* </label>

                        <select class="form-control select2 select2-danger" name="activities_cat_ID" id="activities_cat_ID" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                            @foreach($activitiescatagories as $item)
                            <option value="{{$item->id}}">{{$item->activity_catagories_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="Unit" class=" col-form-label">Rate:* </label>
                        <input type="text" class="form-control" name="rate" autocomplete="off" id="rate" placeholder="Enter Rate" required>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="Unit" class=" col-form-label">Title:* </label>
                        <input type="hidden" class="form-control" name="itemid" id="itemid">
                        <input type="text" class="form-control" autocomplete="off" name="title" onkeyup="searchItems();" id="title" placeholder="Enter item name" required>
                        <div class="dropdown-content" id="items_data">

                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="Unit" class=" col-form-label">Unit:* </label>

                        <input type="text" disabled class="form-control" name="sub_unit" autocomplete="off" id="sub_unit" placeholder="Enter Unit" required>
                    </div>

                    <div class="col-sm-2">
                        <label for="Unit" class=" col-form-label">Qty:* </label>

                        <input type="text" class="form-control" name="qty" autocomplete="off" id="qty" placeholder="Enter Qty" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="Unit" class=" col-form-label">Rate:* </label>

                        <input type="text" class="form-control" name="subitemRate" autocomplete="off" id="subitemRate" placeholder="Enter Rate" required>
                    </div>

                    <div class="col-sm-1">
                        <input type="button" style="margin-top: 38px;" value="Add" onclick=showItems(); class="btn btn-info "></button>
                    </div>


                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div>
                            <table class="table ">

                                <thead>
                                    <th>Title</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>

                                    <th>Action</th>
                                </thead>
                                <tbody id="datatable">

                                <tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="card-footer">
                <input type="button" onclick="addItemsData()" value="Save " class="btn btn-info float-sm-left"></button>

            </div>

        </form>
    </div>


</div>

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    .dropdown-content {
        display: none;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>
<script>
    var isBlank = false;
    const items = [];

    function showItems() {
        var itemid = document.getElementById('itemid').value;
        if (itemid == "") {
            alert("Select item name first!")
            return;
        }
        var title = document.getElementById('title').value;
        var sub_unit = document.getElementById('sub_unit').value;
        var qty = document.getElementById('qty').value;
        var rate = document.getElementById('subitemRate').value;

        items.push(title + '{#}' + sub_unit + '{#}' + qty + '{#}' + rate + '{#}' + itemid);

        displayBasketItemIntoTable();
        document.getElementById('title').value = "";
        document.getElementById('sub_unit').value = "";
        document.getElementById('qty').value = "";
        document.getElementById('subitemRate').value = "";
        document.getElementById('itemid').value = "";
    }

    function putItemIntoCustomerTextField(id, itemName, itemUni) {
        $("#itemid").val(id);
        $("#title").val(itemName);
        $("#sub_unit").val(itemUni);
        document.getElementById('items_data').style.display = 'none';

    }

    function searchItems() {
        searchKey = document.getElementById('title').value;

        if (searchKey != '') {
            axajUrl = "/searchitems/" + searchKey;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#items_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('items_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoCustomerTextField(" + dataResult[i].id + ",\"" +
                            dataResult[i].itemName + "\",\"" + dataResult[i].itemUnit + "\");'>" + dataResult[i].itemName + "</a>";

                        $("#items_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('items_data').style.display = 'none';
        }



    }

    function displayBasketItemIntoTable() {
        document.getElementById('datatable').innerHTML = "";
        for (let i = 0; i < items.length; i++) {
            //total += parseFloat(items[i].split("{#}")[2]) * parseFloat(items[i].split("{#}")[3]);

            var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[i].split("{#}")[1] + '</td><td>' + items[
                i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td onclick="removeItem(\'' + items[
                i] + '\')"> <i class="fas fa-remove"></i></td></tr>';

            $('#datatable').append(str);
        }
    }

    function removeItem(data) {

        if (items.includes(data)) {
            var index = items.indexOf(data);
            if (index !== -1) {
                items.splice(index, 1);
            }
        }
        displayBasketItemIntoTable();
    }

    function addItemsData() {


        var rate = document.getElementById('rate').value;
        var activities_title = document.getElementById('activities_title').value;
        var activities_subtitle = document.getElementById('activities_subtitle').value;
        var unit = document.getElementById('unit').value;
        var token = document.getElementsByName('_token')[0].value;
        var activities_cat_ID = document.getElementById('activities_cat_ID').value;

        var subActivity = items.toString();

        axajUrl = "/post/activites";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,

                activities_title: activities_title,
                activities_subtitle: activities_subtitle,
                unit: unit,
                activities_cat_ID: activities_cat_ID,
                subActivity: subActivity,
                rate: rate

            },
            async: false,
            success: function(dataResult) {
                document.getElementById('datatable').innerHTML = "";
                items.splice(0, items.length); //[]
                document.getElementById('ContainerTopRight').style.display = "block";

            }
        });

    }
</script>
@endsection