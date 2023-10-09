@extends('welcome')

@section('content')
<style>
.view-records-modal {
    display: none;
    position: fixed;
    z-index: 1;
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

@if (Session::has('status'))


<div id="containerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added Customer Data</strong>
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
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Deleted Customer Data</strong>
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
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Updated Customer Data</strong>
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
                    <li class="breadcrumb-item active"><a href="/customer/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/customer/list">List</a></li>

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

                        <form action="{{url('/customersearch')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div style="margin-bottom:15px; " class="input-group">
                                <input type="text" autocomplete="off" name="customer_name"
                                    class="form-control form-control-lg" placeholder="Customer name">
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
                                <button class="view-button openrecord-button"
                                    data-tCode="{{ $item->transactionCode }}">View
                                    <i class="ri-pencil-line"></i></button>




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


    <div id="record-modal" class="view-records-modal">
        <div class="records-content">
            <span class="close-modal-btn">&times;</span>
            <div class="table-heading">
                <table class="input-table">
                    <tr>
                        <th>Date</th>
                        <th>Supplier's Name</th>
                        <th>Bill Number</th>
                    </tr>
                    <tr>
                        <td><input type="date" id="modal-date" readonly></td>
                        <td><input type="text" id="modal-acname" readonly></td>
                        <td><input type="text" id="modal-partyBillNo" readonly></td>
                    </tr>
                </table>
                <div class="whole-table-slide" style="width: 100%; margin-top: 10px; margin-bottom: 10px;">
                    <table class="responsive-slider table-datas" id="modal-items-table">
                        <tr>
                            <th>Item Name</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Vat</th>
                            <th>Amount</th>
                            <th>Total Amount</th>

                        </tr>
                        <tbody id="modal-items-table-body"></tbody>
                    </table>
                </div>
                <table class="input-table">
                    <tr>
                        <th>Total VAT</th>
                        <th>Total Amount</th>
                        <th>Grand Total</th>
                    </tr>
                    <tr>
                        <td><input type="text" id="modal-vat" readonly></td>
                        <td><input type="text" id="modal-amount" readonly></td>
                        <td><input type="text" id="modal-grand-total" readonly></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <script>
    var recordModal = document.getElementById("record-modal");
    var openRecordButtons = document.querySelectorAll(".openrecord-button");
    var closeModalBtn = document.querySelector(".close-modal-btn");

    openRecordButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var tCode = this.getAttribute("data-tCode");
            recordModal.style.display = "block";


            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    populateData(data);
                }
            };
            xhr.open("GET", "/getGoodReceived/" + tCode, true);
            xhr.send();
        });
    });

    closeModalBtn.addEventListener("click", function() {
        recordModal.style.display = "none";
    });

    function populateData(data) {

        document.getElementById('modal-date').value = data.goodsReceived.date;
        document.getElementById('modal-acname').value = data.goodsReceived.fullname;
        document.getElementById('modal-partyBillNo').value = data.goodsReceived.partyBillNo;

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
        document.getElementById('modal-vat').value = vatTotal.toFixed(2);
        document.getElementById('modal-amount').value = amountTotal.toFixed(2);
        document.getElementById('modal-grand-total').value = grandTotal.toFixed(2);
    }
    </script>

    @endsection