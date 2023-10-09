<?php
$itemName = DB::select("SELECT DISTINCT item_name,id,unit,vatable,normal_rate,stockable from item_settings;");
?>
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
                    <li class="breadcrumb-item active"><a href="/customer/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/customer/list">List</a></li>




                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Goods Return Entry </h3>

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

        <form action="{{url('addgoodsreceivedReturn')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="todayDate" class=" col-form-label"> Date.* </label>
                        <input type="date" class="form-control " autocomplete="off" name="date" id="todayDate"
                            placeholder="Enter Full Name" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="supplierName" class=" col-form-label"> Project Name:*</label>
                        <input type="hidden" name="project_id" id="accno" placeholder="Party Id">
                        <input type="text" class="form-control" id="partyName" onkeyup="searchPartyName()"
                            placeholder="Search Project's Name" autocomplete="off">
                        <div class="dropdown-content" id="partyname_data"></div>
                    </div>
                    <div class="col-sm-4">
                        <label for="partyBillNo" class=" col-form-label"> Party Bill No.* </label>
                        <input type="text" class="form-control " autocomplete="off" name="partyBillNo"
                            onkeypress="return onlyNumberKey(event)" id="partyBillNo" placeholder="Enter Bill No."
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="item_name" class="col-form-label"> Item Name:*</label>
                        <input type="text" class="form-control" autocomplete="off" id="itemName" name="itemName"
                            onkeyup="searchItem();" placeholder="Search Item">
                        <input type="hidden" name="item_id" id="itemId">
                        <div class="dropdown-content" id="itemDropdown">
                            @foreach($itemName as $item)
                            <a href="javascript:void(0);"
                                onclick="updateItem('{{$item->id}}', '{{$item->item_name}}', '{{$item->unit}}', '{{$item->vatable}}','{{$item->normal_rate}}','{{$item->stockable}}');">{{$item->item_name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="unitEqualsTo" class="col-form-label">Unit:*</label>
                        <input type="text" name="unitEqualsTo" class="form-control" autocomplete="off" id="unitInput"
                            placeholder="Unit" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label for="unitEqualsTo" class="col-form-label">Quantity:*</label>
                        <input type="text" name="quantity" autocomplete="off" class="form-control" id="quantityInput"
                            placeholder="Enter Quantity">
                    </div>
                    <div class="col-sm-3">
                        <label for="unitEqualsTo" class="col-form-label">Rate:*</label>
                        <input type="text" id="rateInput" class="form-control" autocomplete="off"
                            placeholder="Enter Rate"></td>
                        <input type="hidden" id="stockableInput">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="amount" class="col-form-label">Amount:*</label>
                        <input type="text" id="amountInput" class="form-control" autocomplete="off"
                            placeholder="Enter Amount" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="vatAmount" class=" col-form-label"> VAT Amount:*</label>
                        <input type="text" autocomplete="off" class="form-control" id="vatableInput" name="vat_amount"
                            placeholder="Enter Vatable Amount" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label for="totalAmount" class=" col-form-label"> Total Amount:*</label>
                        <input type="text" name="unit_cost_rate" class="form-control" autocomplete="off"
                            id="totalAmountInput" value="" placeholder="Enter Total Amount" readonly>
                    </div>
                    <div class="col-sm-1">
                        <button href="javascript:;" style="margin-top:38px;" class="btn btn-info"
                            onclick="displayBasketItemIntoTable()">+</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mt-5">
                        <table class="table " id="itemTable">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Unit</th>
                                    <th>Amount</th>
                                    <th>Vatable Amount</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="itemTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="totalAmount" class=" col-form-label"> Total Amount:*</label>
                        <input type="text" class="form-control" autocomplete="off" id="amountInputSpan" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="totalVatableAmount" class=" col-form-label"> Total Vatable Amount:*</label>
                        <input type="text" class="form-control" id="totalVatableSpan" autocomplete="off" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="totalAmountWithVat" class=" col-form-label"> Total Amount with VAT:*</label>
                        <input type="text" id="totalAmountSpan" class="form-control" autocomplete="off" readonly>
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
<script>
setTodayDate();

function setTodayDate() {
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var year = today.getFullYear();

    var formattedDate = year + '-' + month + '-' + day;
    document.getElementById('todayDate').value = formattedDate;
}

function onlyNumberKey(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        return true;
    }
}

function searchPartyName() {
    var partyName = document.getElementById('partyName').value;


    if (partyName != '') {

        axajUrl = "/searchProjectName/" + partyName;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#partyname_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('partyname_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoTextField(\"" + dataResult[i].id +
                        "\",\"" + dataResult[i].project_name + "\");'>" + dataResult[i].project_name +
                        "</a>";

                    $("#partyname_data").append(str);

                    r++;
                }


            }
        });


    } else {
        document.getElementById('partyname_data').style.display = 'none';
    }


}


function putItemIntoTextField(id, fullname) {
    $("#accno").val(id);
    $("#partyName").val(fullname);
    document.getElementById('partyname_data').style.display = 'none';
}

function searchItem() {
    var input, filter, dropdown, items, i, txtValue;
    input = document.getElementById("itemName");
    filter = input.value.toUpperCase();
    dropdown = document.getElementById("itemDropdown");
    items = dropdown.getElementsByTagName("a");

    if (filter.length > 0) {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }

    for (i = 0; i < items.length; i++) {
        txtValue = items[i].textContent || items[i].innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}

function updateItem(itemId, itemName, unit, vatable, normal_rate, stockable) {
    document.getElementById('itemId').value = itemId;
    document.getElementById('itemName').value = itemName;
    document.getElementById('unitInput').value = unit;
    document.getElementById('rateInput').value = normal_rate;
    document.getElementById('stockableInput').value = stockable;
    const vatableInput = document.getElementById('vatableInput');
    if (vatable === "0") {
        vatableInput.style.display = 'none';
        vatableInput.value = '0';
    } else {
        vatableInput.style.display = 'block';
        vatableInput.value = '';
    }
    document.getElementById('itemDropdown').style.display = 'none';
}
const quantityInput = document.getElementById('quantityInput');
const rateInput = document.getElementById('rateInput');
const amountInput = document.getElementById('amountInput');
const vatableInput = document.getElementById('vatableInput');
const totalAmountInput = document.getElementById('totalAmountInput');

quantityInput.addEventListener('input', updateAmountAndTotalAmount);
rateInput.addEventListener('input', updateAmountAndTotalAmount);
amountInput.addEventListener('input', updateTotalAmount);
vatableInput.addEventListener('input', updateTotalAmount);

function updateAmountAndTotalAmount() {
    const quantity = parseFloat(quantityInput.value) || 0;
    const rate = parseFloat(rateInput.value) || 0;
    const amount = (quantity * rate).toFixed(2);
    amountInput.value = amount;
    updateTotalAmount();
}

function updateTotalAmount() {
    const amount = parseFloat(amountInput.value) || 0;
    const vatable = parseFloat(vatableInput.value) || 0;
    let totalAmount;

    if (vatableInput.style.display === 'none') {
        totalAmount = amount.toFixed(2);
    } else {
        const vatAmount = (amount * 0.13).toFixed(2);
        totalAmount = (amount + parseFloat(vatAmount)).toFixed(2);
        vatableInput.value = vatAmount;
    }

    totalAmountInput.value = totalAmount;
}

var items = [];

function displayBasketItemIntoTable() {
    try {
        event.preventDefault();
        var itemId = document.getElementById('itemId').value;

        var itemName = document.getElementById('itemName').value;
        var unit = document.getElementById('unitInput').value;
        var quantity = document.getElementById('quantityInput').value;
        var stockable = document.getElementById('stockableInput').value;
        var rate = document.getElementById('rateInput').value;
        var amount = parseFloat(quantity) * parseFloat(rate);
        var vatable = document.getElementById('vatableInput').value;
        var totalAmount = document.getElementById('totalAmountInput').value;

        var hasError = false;

        if (itemName.trim() === '') {
            document.getElementById('itemName').style.borderColor = 'red';
            hasError = true;
        } else {
            document.getElementById('itemName').style.borderColor = '';
        }
        if (hasError) {
            return;
        }
        if (itemId === null || itemId.trim() === '') {
            alert("Please select the item  correctly");
            location.reload();
            return;
        }
        if (quantity.trim() === '') {
            document.getElementById('quantityInput').style.borderColor = 'red';
            hasError = true;
        } else {
            document.getElementById('quantityInput').style.borderColor = '';
        }

        if (rate.trim() === '') {
            document.getElementById('rateInput').style.borderColor = 'red';
            hasError = true;
        } else {
            document.getElementById('rateInput').style.borderColor = '';
        }

        if (hasError) {
            return;
        }
        items.push(
            itemId + '{#}' + itemName + '{#}' + unit +
            '{#}' +
            quantity +
            '{#}' +
            rate +
            '{#}' +
            amount +
            '{#}' +
            vatable +
            '{#}' +
            totalAmount +
            '{#}' +
            stockable
        );

        displayItemsInTable();
        clearInputFields();
    } catch (error) {
        console.error("An error occurred while displaying the basket items:", error);
    }
}

function displayItemsInTable() {
    try {
        var datatable = document.getElementById('itemTableBody');
        var totalAmount = 0;
        var totalVatable = 0;
        var amountTotal = 0;

        if (datatable === undefined) {
            throw new Error("Datatable element not found.");
        }

        datatable.innerHTML = "";

        for (let i = 0; i < items.length; i++) {
            var itemDetails = items[i].split('{#}');
            var itemId = itemDetails[0];
            var itemName = itemDetails[1];
            var unit = itemDetails[2];
            var quantity = itemDetails[3];
            var rate = itemDetails[4];
            var amount = itemDetails[5];
            var vatable = itemDetails[6];
            var totalAmountItem = itemDetails[7];
            var stockable = itemDetails[8];

            amountTotal += parseFloat(amount);
            totalAmount += parseFloat(totalAmountItem);
            totalVatable += parseFloat(vatable);

            var str =
                '<tr><td><input type="hidden" name="items[]" value="' +
                itemId + '{#}' + itemName + '{#}' + unit + '{#}' + quantity +
                '{#}' + rate + '{#}' + amount + '{#}' + vatable + '{#}' + totalAmountItem + '{#}' + stockable + '" />' +
                itemName +
                '</td><td>' +
                quantity +
                '</td><td>' +
                rate +
                '</td><td>' +
                unit +
                '</td><td>' +
                amount +
                '</td><td>';

            if (vatable === "0") {
                str += '0';
            } else {
                str += vatable;
            }

            str += '</td><td>' +
                totalAmountItem +

                '</td><td><button class="btn btn-info" onclick="deleteItem(' +
                i +
                ')"><i class="fas fa-times"></i></button></td></tr>';

            datatable.innerHTML += str;
        }
        document.getElementById('amountInputSpan').value = amountTotal.toFixed(2);
        document.getElementById('totalVatableSpan').value = totalVatable.toFixed(2);
        document.getElementById('totalAmountSpan').value = totalAmount.toFixed(2);
    } catch (error) {
        console.error("An error occurred while displaying the basket items:", error);
    }
}

function deleteItem(index) {
    try {
        items.splice(index, 1);
        displayItemsInTable();
    } catch (error) {
        console.error("An error occurred while deleting the item:", error);
    }
}

function clearInputFields() {
    document.getElementById('itemName').value = '';
    document.getElementById('unitInput').value = '';
    document.getElementById('quantityInput').value = '';
    document.getElementById('rateInput').value = '';
    document.getElementById('amountInput').value = '';
    document.getElementById('vatableInput').value = '';
    document.getElementById('totalAmountInput').value = '';
}

function confirmDelete(url) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = url;
    }
}
</script>
@endsection