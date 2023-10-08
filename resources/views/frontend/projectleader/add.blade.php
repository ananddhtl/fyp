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
                    <li class="breadcrumb-item"><a href="/projectleader/add">Add</a></li>
                    <li class="breadcrumb-item"><a href="/projectleader/list">List</a></li>



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
            <h3 class="card-title">Add Project Leader </h3>
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
        <form action="{{route('postProjectLeaderData')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="project_leader_name" class=" col-form-label"> Name:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="project_leader_name"
                            id="project_leader_name" placeholder="Enter Leader Name" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="project_leader_mobilenumber" class=" col-form-label"> Contact:* </label>

                        <input type="number" class="form-control" autocomplete="off" name="project_leader_mobilenumber"
                            id="project_leader_mobilenumber" placeholder="Contact number " required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="project_leader_address" class="col-form-label"> Address:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="project_leader_address"
                            id="project_leader_address" placeholder="Enter Leader Address">
                    </div>
                    <div class="col-sm-6">
                        <label for="project_leader_profession" class=" col-form-label"> Profession:*</label>

                        <input type="text" class="form-control" autocomplete="off" name="project_leader_profession"
                            id="project_leader_profession" placeholder="Enter Leader Profession">
                    </div>
                </div>
            </div>


            <div class="card-footer">
                <input type="submit" value="Save " class="btn btn-info float-sm-left"> </button>

            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->

</div>



@endsection