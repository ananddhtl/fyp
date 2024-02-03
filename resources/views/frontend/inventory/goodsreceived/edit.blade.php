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
                    <li class="breadcrumb-item active"><a href="/addgoodsreceived">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/goodsreceivedlist">List</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Goods Received </h3>

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

        <form action="{{ url('/updateGoodsReceived', $goodsReceived->tCode) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="todayDate" class=" col-form-label"> Date.* </label>
                        <input name="date" class="form-control" type="date" id="billDate"
                            value="{{ $goodsReceived->date }}" placeholder="Date" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="supplierName" class=" col-form-label"> Suppliers Name:*</label>
                        <input type="hidden" name="party_id" id="sn" class="form-control" placeholder="Party Id"
                            value="{{ $goodsReceived->Sid }}" readonly>
                        <input type="text" autocomplete="off" class="form-control" id="partyName"
                            onkeyup="searchPartyName()" placeholder="Search Name" value="{{ $goodsReceived->fullname }}"
                            readonly>
                        <div class="dropdown-content" id="partyname_data"></div>
                    </div>
                    <div class="col-sm-4">
                        <label for="partyBillNo" class=" col-form-label"> Party Bill No.* </label>
                        <input type="text" autocomplete="off" class="form-control" id="partyBillNo" name="partyBillNo"
                            placeholder="Bill No." value="{{ $goodsReceived->partyBillNo }}" readonly>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-12 mt-5">
                        <table class="table " id="itemTable">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>VAT Amount</th>
                                    <th>Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody id="itemTableBody">
                                @php
                                $sumVatableAmount = 0;
                                $sumTotalAmount = 0;
                                $unitcostrate = 0;
                                $totalAmount = 0;
                                $sumAmount = 0;
                                @endphp

                                @foreach($list as $item)
                                @php
                                $totalAmount = $item->unit_cost_rate * $item->instock;
                                $totalAmountWithVAT = $item->unit_cost_rate * $item->instock + $item->vat;
                                $sumVatableAmount += $item->vat;
                                $sumTotalAmount += $totalAmountWithVAT;
                                $unitcostrate += $item->unit_cost_rate;
                                $item->totalAmount = $totalAmount;
                                $sumAmount += $totalAmount;
                                @endphp
                                <tr>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->unit_cost_rate }}</td>
                                    <td>{{ $item->instock }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->vat }}</td>
                                    <td>{{ $item->totalAmount }}</td>
                                    <td>{{ $totalAmountWithVAT }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="totalAmount" class=" col-form-label"> Amount:*</label>
                        <input type="text" class="form-control" value="{{$sumAmount}}" autocomplete="off" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="totalVatableAmount" class=" col-form-label">Vatable :*</label>
                        <input type="text" class="form-control" value="{{$sumVatableAmount}}" autocomplete="off"
                            readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="totalAmountWithVat" class=" col-form-label">Grand Total:*</label>
                        <input type="text" class="form-control" value="{{$sumTotalAmount}}" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="totalAmount" class=" col-form-label"> Cancellation Reason</label>
                        <textarea type="text" class="form-control" style="width:100%; height:100px;"  name="cancellation_reason"  required></textarea>
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

@endsection