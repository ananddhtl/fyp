@extends('welcome')

@section('content')
<div id="ContainerTopRight" style="margin-top:110px; display:none;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Project Progress</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">Saved successfully!</div>
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

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/projectprogress/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/projectprogress/list">List</a></li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-12">



    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Project Progress </h3>
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
        <form action="{{route('postProjectProgressData')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group ">

                    <div class="row">
                        <div class="col-sm-2">
                            <label for="exampleInputEmail1">Date</label>

                            <input type="date" id="billDate" class="form-control" value="{{date('Y-m-d', strtotime($data[0]->fiscal_year))}}" name="billDate" />
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Project Title:*</label>
                            <input type="hidden" class="form-control" name="project_id" value="{{@$data[0]->project_id }}" id="project_id">

                            <input type="hidden" value="{{@$data[0]->tCode}}" name="tcode" id="tcode">
                            <div class="input-group ">
                                <input type="text" autocomplete="off" class="form-control" name="projectsearchKey" value="{{@$data[0]->project_name }}" onkeyup="searchProject();" id="projectsearchKey" placeholder="Enter project title">


                            </div>
                            <div class="dropdown-content" id="projects_data">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Project Location:*</label>

                            <div class="input-group ">
                                <input type="text" readonly autocomplete="off" value="{{@$data[0]->project_address }}" class="form-control" id="projectlocation" placeholder="Enter project location">

                            </div>

                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <input type="hidden" class="form-control" name="id" id="id">

                    <input type="hidden" autocomplete="off" class="form-control" name="supplierssearchKey" onkeyup="searchSuppliers();" id="supplierssearchKey" placeholder="Enter party">

                    <!-- <div class="col-sm-3">
                        <label for="exampleInputEmail1">Party:</label>
                        <div class="input-group ">


                        </div>
                        <div class="dropdown-content" id="suppliers_data">

                        </div>

                    </div> -->

                    <div class="col-sm-4">

                        <label for="exampleInputEmail1">Project Item:*</label>
                        <input type="hidden" class="form-control" name="activities_id" id="activities_id">

                        <div class="input-group ">
                            <input type="text" autocomplete="off" class="form-control" name="searchKey" onkeyup="searchActivities();" id="searchKeyForActivity" placeholder="Enter item name">



                        </div>

                        <div class="dropdown-content" id="activities_data">

                        </div>

                    </div>



                    <div class="col-sm-2">
                        <label for="exampleInputEmail1">Item Qty:*</label>
                        <input type="number" class="form-control" name="itemQty" id="itemQty" placeholder="Enter Qty">
                    </div>






                    <div class="col-sm-1">
                        <input type="button" style="margin-top: 30px;" value="Add" onclick="displaysubitemsofmainitem();" ; class="btn btn-info "></button>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <table class="table" id="myTable" style="font-size: 12px;">
                            <thead>


                                <th>Sub Items</th>

                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Rate</th>





                            </thead>
                            <tbody>
                                </thead>
                            <tbody id="datatable2">


                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4">

                        <label for="exampleInputEmail1">Total Amount:*</label>
                        <input type="number" class="form-control" name="credit" id="amount" placeholder="Enter Total Amount">

                    </div>
                    <div class="col-sm-1">
                        <input type="button" style="margin-top: 30px;" value="Add Item" onclick=showItems(); class="btn btn-info "></button>
                    </div>
                    <div class="col-sm-1">
                        <input type="button" style="margin-top: 30px;" value="Clear Item" onclick=clearallItems(); class="btn btn-info "></button>
                    </div>
                </div>

                <div>
                    <table class="table ">

                        <thead>


                            <th>Project Items</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="datatable">

                        <tbody>

                    </table>
                </div>




                <div class="form-group row">




                </div>
            </div>


            <div class="card-footer">
                <input type="button" value="Save" onclick="saveDataIntoTable();" class="btn btn-info float-sm-left">
                </button>

            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->

</div>


<script>
    const items = [];
    const itemsWithSubItems = [];
    const itemsWithSubItemsUpdateed = [];
    const itemsWithSubItemsFinal = [];
    var total = 0;
</script>
@foreach($subdata as $item)
<script>
    itemsWithSubItemsFinal.push('{{$item->itemName}}' + '{#}' + '{{$item->itemUnit}}' + '{#}' + '{{$item->qty}}' + '{#}' + '{{$item->rate}}' + '{#}' + '{{$item->sub_activity_id}}' + '{#}' + '{{$item->activities_id}}');
</script>
@endforeach
@foreach($data as $item)
<script type="text/javascript">
    items.push('{{$item->activities_title}}' + '{#}' + '{{$item->activities_id}}' + '{#}' + '{{$item->quantity_out}}' + '{#}' + '{{$item->amount}}' + '{#}' + '{#}');
</script>
@endforeach
<script type="text/javascript">
    window.onload = function(e) {
        displayBasketItemIntoTable();
        // getDate();

    }


    function updatesubitemswithrateandqty() {


        document.getElementById("itemQty").disabled = true;
        document.getElementById("searchKeyForActivity").disabled = true;

        itemsWithSubItemsUpdateed.splice(0, itemsWithSubItemsUpdateed.length);
        for (let i = 0; i < itemsWithSubItems.length; i++) {

            // alert(itemsWithSubItems[i].split("{#}")[0]);
            var qtyid = "qty" + i + "";
            var rateid = "rate" + i + "";
            var qty = document.getElementById(qtyid).value;
            var rate = document.getElementById(rateid).value;
            itemsWithSubItemsUpdateed.push(itemsWithSubItems[i].split("{#}")[0] + '{#}' + itemsWithSubItems[i].split("{#}")[1] + '{#}' + qty + '{#}' + rate + '{#}' + itemsWithSubItems[i].split("{#}")[4] + '{#}' + itemsWithSubItems[i].split("{#}")[5]);

        }
        itemsWithSubItems.splice(0, itemsWithSubItems.length);
        itemsWithSubItems.push.apply(itemsWithSubItems, itemsWithSubItemsUpdateed);

        displaysubitemsofmainitemUpdated();

    }


    function displaysubitemsofmainitemUpdated() {

        var totalamt = 0;
        var qty = document.getElementById("itemQty").value;
        document.getElementById('datatable2').innerHTML = "";
        for (let i = 0; i < itemsWithSubItemsUpdateed.length; i++) {
            var str = '<tr><td>' + itemsWithSubItemsUpdateed[i].split("{#}")[0] + '</td><td>' + itemsWithSubItemsUpdateed[i].split("{#}")[1] +
                '</td><td><input onchange="updatesubitemswithrateandqty();"  type="number" id="qty' + i + '" value="' + itemsWithSubItemsUpdateed[i].split("{#}")[2] +
                '"></td><td><input  onchange="updatesubitemswithrateandqty();" type="number" id="rate' + i + '" value="' + itemsWithSubItemsUpdateed[i].split("{#}")[3] +
                '"></td>';

            totalamt += itemsWithSubItemsUpdateed[i].split("{#}")[2] * itemsWithSubItemsUpdateed[i].split("{#}")[3];
            $('#datatable2').append(str);
        }

        document.getElementById('amount').value = totalamt;


    }

    function displaysubitemsofmainitem() {
        // alert(itemsWithSubItems.toString());

        var totalamt = 0;
        var qty = document.getElementById("itemQty").value;
        document.getElementById('datatable2').innerHTML = "";
        for (let i = 0; i < itemsWithSubItems.length; i++) {
            var str = '<tr><td>' + itemsWithSubItems[i].split("{#}")[0] + '</td><td>' + itemsWithSubItems[i].split("{#}")[1] +
                '</td><td><input onchange="updatesubitemswithrateandqty();"  type="number" id="qty' + i + '" value="' + itemsWithSubItems[i].split("{#}")[2] * qty +
                '"></td><td><input  onchange="updatesubitemswithrateandqty();" type="number" id="rate' + i + '" value="' + itemsWithSubItems[i].split("{#}")[3] +
                '"></td>';

            totalamt += itemsWithSubItems[i].split("{#}")[2] * itemsWithSubItems[i].split("{#}")[3];
            $('#datatable2').append(str);
        }

        document.getElementById('amount').value = totalamt;


    }


    function clearallItems() {
        document.getElementById("itemQty").disabled = false;
        document.getElementById("searchKeyForActivity").disabled = false;
        itemsWithSubItems.splice(0, itemsWithSubItems.length);
        itemsWithSubItemsUpdateed.splice(0, itemsWithSubItemsUpdateed.length);
        document.getElementById('datatable2').innerHTML = "";
        document.getElementById('activities_id').value = "";
        document.getElementById('searchKeyForActivity').value = "";
        document.getElementById('itemQty').value = "";
        document.getElementById('amount').value = "";
        document.getElementById('supplierssearchKey').value = "";
        document.getElementById('id').value = "";
    }


    function showItems() {
        updatesubitemswithrateandqty();
        itemsWithSubItemsFinal.push.apply(itemsWithSubItemsFinal, itemsWithSubItems);
        document.getElementById('datatable2').innerHTML = "";
        var isBlank = false;
        if (document.getElementById("activities_id").value == '') {

            document.getElementById("searchKeyForActivity").focus();
            isBlank = true;
        } else if (document.getElementById("itemQty").value == '' && document.getElementById("credit").value == '') {
            document.getElementById("itemQty").focus();
            isBlank = true;
        }

        if (isBlank == false) {
            if (document.getElementById('activities_id').value != '') {

                var activities_id = document.getElementById('activities_id').value;
                var activities_Name = document.getElementById('searchKeyForActivity').value;
                var itemQty = document.getElementById('itemQty').value;
                var amount = document.getElementById('amount').value;

                var vendor_id = document.getElementById('id').value;
                var vendor = document.getElementById('supplierssearchKey').value;
                items.push(activities_Name + '{#}' + activities_id + '{#}' + itemQty + '{#}' + amount + '{#}' + vendor_id +
                    '{#}' + vendor);

                displayBasketItemIntoTable();
                clearallItems();

                document.getElementById('supplierssearchKey').value = "";
                document.getElementById('id').value = "";
            }
        }

    }


    function saveDataIntoTable() {
        if (document.getElementById("project_id").value == '') {
            document.getElementById("searchKey").focus();
        } else if (items.length == 0) {
            document.getElementById("searchKeyForActivity").focus();
        } else

        {

            var transactionDate = document.getElementById('billDate').value;
            var project_id = document.getElementById('project_id').value;

            var token = document.getElementsByName('_token')[0].value;
            var tcode = document.getElementById('tcode').value;
            //alert(token);
            var activities = items.toString();
            var subactivities = itemsWithSubItemsFinal.toString();
            axajUrl = "/update/projectprogress";
            $.ajax({
                type: "POST",
                url: axajUrl,
                data: {
                    _token: token,
                    fiscal_year: transactionDate,
                    project_id: project_id,

                    activities: activities,
                    subactivities: subactivities,
                    tcode: tcode,
                },
                async: false,
                success: function(dataResult) {
                    document.getElementById('datatable').innerHTML = "";
                    items.splice(0, items.length); //[]
                    document.getElementById('ContainerTopRight').style.display = "block";
                    itemsWithSubItemsFinal.splice(0, itemsWithSubItemsFinal.length); //[]
                    // window.location.href = "/projectprogress/list";
                }
            });

        }




    }

    function removeItem(data, activities_id) {
        document.getElementById('activities_id').value = data.split("{#}")[1];
        document.getElementById('searchKeyForActivity').value = data.split("{#}")[0];
        document.getElementById('itemQty').value = data.split("{#}")[2];
        if (items.includes(data)) {
            var index = items.indexOf(data);
            if (index !== -1) {
                items.splice(index, 1);
            }
        }
        removeSubItemsFromList(activities_id);
        displayBasketItemIntoTable();
    }


    function removeSubItemsFromList(activities_id) {
        // alert(itemsWithSubItemsFinal.toString());
        itemsWithSubItems.splice(0, itemsWithSubItems.length);
        var newlist = [];
        var listforedit = [];
        for (let r = 0; r < itemsWithSubItemsFinal.length; r++) {
            if (activities_id == itemsWithSubItemsFinal[r].split("{#}")[5]) {
                listforedit.push(itemsWithSubItemsFinal[r]);
            } else {
                newlist.push(itemsWithSubItemsFinal[r]);
            }
        }
        itemsWithSubItems.push.apply(itemsWithSubItems, listforedit);
        listforedit.splice(0, listforedit.length);
        displaysubitemsofmainitem();
        // itemsWithSubItems.splice(0, itemsWithSubItems.length);
        itemsWithSubItemsFinal.splice(0, itemsWithSubItemsFinal.length);
        itemsWithSubItemsFinal.push.apply(itemsWithSubItemsFinal, newlist);

    }

    function displayBasketItemIntoTable() {

        document.getElementById('datatable').innerHTML = "";
        for (let i = 0; i < items.length; i++) {
            var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[
                i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td onclick="removeItem(\'' + items[
                i] + '\',' + items[i].split("{#}")[1] + ')"> <i class="fas fa-edit"></i></td></tr>';
            $('#datatable').append(str);
        }

    }

    function getDate() {
        var todaydate = new Date();
        var day = todaydate.getDate();

        var month = todaydate.getMonth() + 1;
        var year = todaydate.getFullYear();

        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }

        var datestring = year + "-" + month + "-" + day

        document.getElementById("billDate").value = datestring;
    }
    let searchKey = '';

    function searchCustomer() {
        searchKey = document.getElementById('searchKey').value;
        // setTimeout(function() {

        // }, 500);

        if (searchKey != '') {
            axajUrl = "/searchCustomerForCustomerId/" + searchKey;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#customers_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('customers_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoCustomerTextField(" + dataResult[i].id +
                            ",\"" +
                            dataResult[i].customer_name + "\");'>" + dataResult[i].customer_name + " - " +
                            dataResult[i].customer_phonenumber + "</a>";

                        $("#customers_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('customers_data').style.display = 'none';
        }



    }



    function searchProjectLeader() {
        var searchProjectLeader = document.getElementById('projectLeaderName').value;
        // setTimeout(function() {

        // }, 500);

        if (searchProjectLeader != '') {
            axajUrl = "/searchProjectLeaderForLeaderId/" + searchProjectLeader;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#projectLeader_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('projectLeader_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoTextFieldForProjectLeader(" + dataResult[
                                i].id + ",\"" + dataResult[i].project_leader_name + "\");'>" + dataResult[i]
                            .project_leader_name + " - " + dataResult[i].project_leader_mobilenumber +
                            "</a>";

                        $("#projectLeader_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('projectLeader_data').style.display = 'none';
        }


    }

    function searchProject() {
        searchKey = document.getElementById('projectsearchKey').value;
        if (searchKey != '') {
            axajUrl = "/searchProjectForProjectId/" + searchKey;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#projects_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('projects_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {
                        var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" +
                            dataResult[i].project_name + "\",\"" + dataResult[i].project_address + "\");'>" + dataResult[i].project_name + " - " +
                            dataResult[i].project_address + "</a>";
                        $("#projects_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('projects_data').style.display = 'none';
        }
    }

    function searchSuppliers() {
        searchKey = document.getElementById('supplierssearchKey').value;
        // setTimeout(function() {

        // }, 500);

        if (searchKey != '') {
            axajUrl = "/searchSuppliersForSuppliersId/" + searchKey;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#suppliers_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('suppliers_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoTextFieldSuppliers(" + dataResult[i].id +
                            ",\"" + dataResult[i].fullname + "\");'>" + dataResult[i].fullname + " - " +
                            dataResult[i].address + "</a>";

                        $("#suppliers_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('suppliers_data').style.display = 'none';
        }
    }

    function searchActivities() {
        searchKey = document.getElementById('searchKeyForActivity').value;
        // setTimeout(function() {

        // }, 500);

        if (searchKey != '') {
            axajUrl = "/searchActivityForActivityId/" + searchKey;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#activities_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('activities_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoActivityTextField(" + dataResult[i].id +
                            ",\"" + dataResult[i].activities_title + "\");'>" + dataResult[i].activities_title +
                            "</a>";

                        $("#activities_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('activities_data').style.display = 'none';
        }




    }

    function putItemIntoCustomerTextField(id, customerName) {
        $("#customer_id").val(id);
        $("#searchKey").val(customerName);
        document.getElementById('customers_data').style.display = 'none';

    }

    function putItemIntoTextFieldForProjectLeader(id, projectLeaderName) {
        $("#project_leader_id").val(id);
        $("#projectLeaderName").val(projectLeaderName);
        document.getElementById('projectLeader_data').style.display = 'none';
    }

    function putItemIntoActivityTextField(id, activitiesTitle) {
        serviceItems(id);
        $("#activities_id").val(id);
        $("#searchKeyForActivity").val(activitiesTitle);
        document.getElementById('activities_data').style.display = 'none';
    }

    function putItemIntoTextField(id, projectName, projectlocation) {

        $("#project_id").val(id);
        $("#projectsearchKey").val(projectName);
        $("#projectlocation").val(projectlocation);
        document.getElementById('projects_data').style.display = 'none';
    }

    function putItemIntoTextFieldSuppliers(id, fullname) {
        $("#id").val(id);
        $("#supplierssearchKey").val(fullname);
        document.getElementById('suppliers_data').style.display = 'none';
    }

    function saveProjectItemsData() {

        var token = document.getElementsByName('_token')[0].value;
        var activities_title = document.getElementById('activities_title').value;
        var activities_subtitle = document.getElementById('activities_subtitle').value;
        var unit = document.getElementById('unit').value;
        var activities_cat_ID = document.getElementById('activities_cat_ID').value;

        //alert(token);
        var activities = items.toString();

        axajUrl = "/post/activites";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,
                activities_title: activities_title,
                activities_subtitle: activities_subtitle,
                activities_cat_ID: activities_cat_ID,
                unit: unit,
            },
            async: false,
            success: function(dataResult) {
                var data = JSON.parse(dataResult);

                document.getElementById('activities_id').value = data.activities_id;
                document.getElementById('searchKeyForActivity').value = data.activities_name;

                document.getElementById('ContainerTopRight').style.display = "block";

                $('#exampleModal').modal('hide');


            }
        });

    }

    function saveSuppliersItemsData() {

        var token = document.getElementsByName('_token')[0].value;
        var fullname = document.getElementById('fullname').value;
        var address = document.getElementById('address').value;
        var email = document.getElementById('email').value;
        var contact_number = document.getElementById('contact_number').value;

        //alert(token);


        axajUrl = "/post/suppliers";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,
                fullname: fullname,
                address: address,
                email: email,
                contact_number: contact_number,
            },
            async: false,
            success: function(dataResult) {
                var data = JSON.parse(dataResult);
                document.getElementById('id').value = data.suppliers_id;
                document.getElementById('supplierssearchKey').value = data.full_name;

                document.getElementById('ContainerTopRight').style.display = "block";

                $('#exampleModal2').modal('hide');


            }
        });





    }

    function saveProjectData() {

        var token = document.getElementsByName('_token')[0].value;
        var project_name = document.getElementById('project_name').value;
        var project_address = document.getElementById('project_address').value;
        var project_city = document.getElementById('project_city').value;
        var customer_id = document.getElementById('customer_id').value;
        var project_leader_id = document.getElementById('project_leader_id').value;
        var project_fiscal_year = document.getElementById('project_fiscal_year').value;
        var project_duration = document.getElementById('project_duration').value;
        var project_costestimation = document.getElementById('project_costestimation').value;

        //alert(token);


        axajUrl = "/post/projectdata";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,
                project_name: project_name,
                project_address: project_address,
                project_city: project_city,
                customer_id: customer_id,
                project_leader_id: project_leader_id,
                project_fiscal_year: project_fiscal_year,
                project_duration: project_duration,
                project_costestimation: project_costestimation,

            },
            async: false,
            success: function(dataResult) {
                var data = JSON.parse(dataResult);
                document.getElementById('id').value = data.project_id;
                document.getElementById('projectsearchKey').value = data.project_name;

                document.getElementById('ContainerTopRight').style.display = "block";

                $('#exampleModal3').modal('hide');


            }
        });





    }

    function serviceItems(id) {

        axajUrl = "/searchSubActivity/" + id;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#datatable2").empty();

                response = dataResult;

                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);

                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {


                    itemsWithSubItems.push(dataResult[i].itemName + '{#}' + dataResult[i].itemUnit + '{#}' + dataResult[i].qty + '{#}' + dataResult[i].rate + '{#}' + dataResult[i].itemId + '{#}' + dataResult[i].activity_id);

                    r++;

                }
            }
        });


    }
</script>

@endsection