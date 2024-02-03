@extends('welcome')

@section('content')
<style>
.view-records-modal {
    display: none;
    position: fixed;
    z-index: 99999999999999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    z-index: 999;
    background-color: rgba(0, 0, 0, 0.5);
}

.records-content {
    position: relative;
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    width: 80%;
    animation-name: modal-animation;
    animation-duration: 0.3s;
}

@keyframes modal-animation {
    from {
        top: -300px;
        opacity: 0;
    }

    to {
        top: 0;
        opacity: 1;
    }
}

/* Button Styles */
.open-modal-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

/* Close Button Styles */
.close-modal-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-modal-btn:hover,
.close-modal-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
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
                    <li class="breadcrumb-item active"><a href="/addgoodsreceived">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/goodsreceivedlist">List</a></li>
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
            Goods Received List
        </div>

        <div class="card-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6 ">

                        <form action="{{url('/goodsreceivedlist')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div style="margin-bottom:15px; " class="input-group">
                                <input type="text" autocomplete="off" name="suppliers_name"
                                    class="form-control form-control-lg" placeholder="Enter Suppliers name">&nbsp;
                                <input class="form-control form-control-lg" type="date" name="from" id="todayDate"
                                    placeholder="From">&nbsp;
                                <input class="form-control form-control-lg" type="date" name="to" id="todayDate1"
                                    placeholder="To">
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
                            <th>Date</th>
                            <th>Suppliers Name</th>
                            <th>Bill Number</th>
                            <th>Quantity</th>
                            <th>VAT</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($list->isEmpty())

                        <tr>
                            <td colspan="7" class="no-item-found">No Item Found</td>

                        </tr>
                        @else
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->partyBillNo }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->vat }}</td>
                            <td>{{ $item->gtotal }}</td>
                            <td>
                                <a href="{{ url('editGoodReceived/'.$item->transactionCode) }}"><button
                                        class="btn btn-info btn-sm">Cancel<i class="ri-pencil-line"></i></button></a>
                                &nbsp;
                                <button class="btn btn-info openrecord-button"
                                    onclick="showModal('{{$item->transactionCode}}')">View <i
                                        class="ri-pencil-line"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
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


    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:700px;">
                <div class="modal-header bg bg-info">
                    <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Date: <span id="modal-date"></span></h4>
                    <h4>Suppliers Name: <span id="modal-acname"></span></h4>
                    <h4>Demand Sheet Number: <span id="modal-partyBillNo"></span></h4>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Unit Cost Rate</th>
                                <th>Instock</th>
                                <th>Unit</th>
                                <th>VAT</th>
                                <th>Total Cost</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="modal-items-table-body">
                            <!-- Data will be populated here dynamically -->
                        </tbody>
                    </table>

                    <h4>VAT Total: <span id="modal-vat"></span></h4>
                    <h4>Amount Total: <span id="modal-amount"></span></h4>
                    <h4>Grand Total: <span id="modal-grand-total"></span></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
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
        document.getElementById('todayDate1').value = formattedDate;
    }
        function showModal(transactionCode) {

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "/getGoodReceived/" + transactionCode, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    populateData(responseData);
                    $("#exampleModalLong").modal('show');
                } else if (xhr.readyState === 4 && xhr.status !== 200) {

                }
            };

            xhr.send();
        }

        function populateData(data) {

            document.getElementById('modal-date').textContent = data.goodsReceived.date;
            document.getElementById('modal-acname').textContent = data.goodsReceived.project_name;
            document.getElementById('modal-partyBillNo').textContent = data.goodsReceived.demand_sheet_name;

            var vatTotal = 0;
            var amountTotal = 0;
            var grandTotal = 0;


            var tableBody = document.getElementById('modal-items-table-body');
            tableBody.innerHTML = '';

            for (var i = 0; i < data.list.length; i++) {
                var item = data.list[i];

                var row = document.createElement('tr');
                row.innerHTML = `
    <td>${item.item_name}</td>
    <td>${item.unit_cost_rate}</td>
    <td>${item.instock}</td>
    <td>${item.unit}</td>
    <td>${item.vat}</td>
    <td>${item.unit_cost_rate * item.instock}</td>
    <td>${item.amount}</td>
`;
                tableBody.appendChild(row);
                vatTotal += parseFloat(item.vat);
                amountTotal += parseFloat(item.unit_cost_rate * item.instock);
                grandTotal += parseFloat(item.amount);


            }
            document.getElementById('modal-vat').textContent = vatTotal.toFixed(2);
            document.getElementById('modal-amount').textContent = amountTotal.toFixed(2);
            document.getElementById('modal-grand-total').textContent = grandTotal.toFixed(2);
        }
    </script>

    @endsection
