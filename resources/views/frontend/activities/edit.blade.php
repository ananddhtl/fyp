@extends('welcome')

@section('content')



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
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-8">



    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Activity</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->


        <div class="card-body">


            <div class="form-group row">
                <div class="col-sm-6">
                
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" value="{{@$data[0]->id}}" id="id" name="id">
                    
                    <label for="activites_title" class="col-form-label"> Title:*</label>

                    <input type="text" class="form-control" name="activities_title"
                        value="{{$data[0]->activities_title}}" id="activities_title" placeholder="Activities Title">
                </div>


                <div class="col-sm-6">
                    <label for="activites_subtitle" class="col-form-label"> Sub Title:* </label>

                    <input type="text" class="form-control" name="activities_subtitle"
                        value="{{$data[0]->activities_subtitle}}" id="activities_subtitle"
                        placeholder="Activities SubTitle Title">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="activity_catagories_id" class=" col-form-label">Catagory:*</label>

                    <select class="form-control select2 select2-danger" id="activities_cat_ID" name="activities_cat_ID"
                        data-dropdown-css-class="select2-danger" style="width: 100%;">


                        @foreach($data as $item)
                        @if($data[0]->activities_cat_ID==$item->activities_id)
                        <option value="{{$item->activities_id}}" selected>{{$item->activity_catagories_name}}</option>
                        @else
                        <option value="{{$item->activities_id}}">{{$item->activity_catagories_name}}</option>
                        @endif

                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="activites_subtitle" class="col-form-label"> Unit:* </label>

                    <input type="text" class="form-control" name="unit" value="{{$data[0]->unit}}" id="unit"
                        placeholder="Unit">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="Unit" class=" col-form-label">Title:* </label>

                    <input type="text" class="form-control" name="title" autocomplete="off" id="title"
                        placeholder="Enter Title" required>
                </div>
                <div class="col-sm-3">
                    <label for="Unit" class=" col-form-label">Unit:* </label>

                    <input type="text" class="form-control" name="sub_unit" autocomplete="off" id="sub_unit"
                        placeholder="Enter Unit" required>
                </div>

                <div class="col-sm-2">
                    <label for="Unit" class=" col-form-label">Qty:* </label>

                    <input type="text" class="form-control" name="qty" autocomplete="off" id="qty"
                        placeholder="Enter Qty" required>
                </div>
                <div class="col-sm-2">
                    <label for="Unit" class=" col-form-label">Rate:* </label>

                    <input type="text" class="form-control" name="rate" autocomplete="off" id="rate"
                        placeholder="Enter Rate" required>
                </div>

                <div class="col-sm-1">
                    <input type="button" style="margin-top: 38px;" value="Add" onclick=showItems();
                        class="btn btn-info "></button>
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

        <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                </div> -->
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="button" value="Update" onclick=addItemsData(); class="btn btn-info"></input>

        </div>
        <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->
</div>

<script>
var isBlank = false;
const items = [];
</script>
@foreach($subactivity as $item)
<script type="text/javascript">
  //  items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + amount + '{#}' + vendor_id +
  //         '{#}' + vendor);

  items.push('{{$item->title}}' + '{#}' + '{{$item->sub_unit}}' + '{#}' + '{{$item->qty}}' + '{#}' + '{{$item->rate}}' + '{#}' + '{#}');
  // items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + credit);
</script>

@endforeach
<!-- {{$subactivity}} -->
<script>
  window.onload = function(e) {
    displayBasketItemIntoTable();
    getDate();

  }
function showItems() {
    var title = document.getElementById('title').value;
    var sub_unit = document.getElementById('sub_unit').value;
    
    var qty = document.getElementById('qty').value;
    var rate = document.getElementById('rate').value;

    items.push(title  + '{#}' +sub_unit + '{#}' + qty + '{#}' + rate);

    displayBasketItemIntoTable();
    document.getElementById('title').value = "";
   
    document.getElementById('sub_unit').value = "";
    document.getElementById('qty').value = "";
    document.getElementById('rate').value = "";

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

    
    var activities_title = document.getElementById('activities_title').value;
    var activities_subtitle = document.getElementById('activities_subtitle').value;
    var id = document.getElementById('id').value
    var unit = document.getElementById('unit').value;
    var token = document.getElementsByName('_token')[0].value;
    var activities_cat_ID = document.getElementById('activities_cat_ID').value;
    var subActivity = items.toString();
   

    axajUrl = "/update-activities";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,
                id: id,
                activities_title: activities_title,
                activities_subtitle: activities_subtitle,
                unit: unit,
                activities_cat_ID: activities_cat_ID,
                subActivity: subActivity,

            },
            async: false,
            success: function(dataResult) {
                document.getElementById('datatable').innerHTML = "";
                items.splice(0, items.length); //[]
                document.getElementById('ContainerTopRight').style.display = "block";

            }
        });

    }



// function addItemsData() {
//     if (document.getElementById('activities_title').value == "0") {
//         document.getElementById('activities_title').focus();
//         isblank = true;
//     } else if (document.getElementById('activities_subtitle').value == "0") {
//         document.getElementById('activities_subtitle').focus();
//         isblank = true;
//     } else if (document.getElementById('unit').value == "0") {
//         document.getElementById('unit').focus();
//         isblank = true;

//         var activities_title = document.getElementById('activities_title').value;
//         var activities_subtitle = document.getElementById('activities_subtitle').value;
//         var unit = document.getElementById('unit').value;
//         var token = document.getElementsByName('_token')[0].value;
//         var activities_cat_ID = document.getElementById('activities_cat_ID').value;
//         var subActivity = items.toString();

//         axajUrl = "update-activities";
//         $.ajax({
//             type: "POST",
//             url: axajUrl,
//             data: {
//                 _token: token,

//                 activities_title: activities_title,
//                 activities_subtitle: activities_subtitle,
//                 unit: unit,
//                 activities_cat_ID: activities_cat_ID,
//                 subActivity: subActivity,

//             },
//             async: false,
//             success: function(dataResult) {
//                 document.getElementById('datatable').innerHTML = "";
//                 items.splice(0, items.length); //[]
//                 document.getElementById('ContainerTopRight').style.display = "block";

//             }
//         });

//     }
// }
</script>

@endsection