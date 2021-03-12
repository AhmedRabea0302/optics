@extends('dashboard.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Create Customer Invoice</small>
        </h1>
    </section>


    <div class="row">
        <!-- CUSTOMER SEARCH SECTION ============================ -->
        <div class="col-md-6">
            <!-- CUSTOMER SEARCH SECTION ============================ -->
            <div class="box box-warning" style="width: 100%">
                <div class="box-header">
                    <h3 class="box-title">Customer</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="customer_id">ID</label>
                                <input type="text" class="form-control" name="customer_id"
                                       value="{{$customer->customer_id}}" id="customer_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Name</label>
                                <input type="text" class="form-control" name="customer_name"
                                       value="{{$customer->english_name.' / '.$customer->local_name}}"
                                       id="customer_name">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm pull-right" data-target="#customerModal"
                                        data-toggle="modal" title="Customer Search" id="customerSearch"
                                        style="margin-top:27px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- DOCTOR SEARCH SECTION ============================ -->
            <div class="box box-warning" style="width: 100%">
                <div class="box-header">
                    <h3 class="box-title">Doctor</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="doctor_id">ID</label>
                                <input type="text" class="form-control" name="doctor_id" value="" id="doctor_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_name">Name</label>
                                <input type="text" class="form-control" name="doctor_name"
                                       value="" id="doctor_name">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm pull-right" data-target="#myModal"
                                        data-toggle="modal" title="Advanced Search" id="search"
                                        style="margin-top:27px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning" style="width: 100%">
                <div class="box-header">
                    <h3 class="box-title">Select Items</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="customer_id">Quantity</label>
                                <input type="text" class="form-control" name="product_quantity"
                                       value="" id="product_quantity">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_id">ID</label>
                                <input type="text" class="form-control" name="product_id"
                                       value="" id="product_id">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm pull-right" data-target="#searchModal"
                                        data-toggle="modal" title="Product Search" id="productSearch"
                                        style="margin-top:27px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                    </thead>

                    @foreach($customers as $key => $item)
                        <tbody>
                        <td>
                            <input type="radio" id="customer-{{$key++}}" name="customer_details"
                                   value="{!! $item->customer_id !!}">
                            {{$item->customer_id}}
                        </td>
                        <td>
                            {{$item->english_name.' / '.$item->local_name}}
                        </td>
                        </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div id="customerModal" class="modal fade" role="dialog">
        <div class="modal-dialog box-item">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header box-item-head">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Select Customer</h3>
                </div>

                <div class="modal-body  box-item-content">
                    <div class="row">
                        <!-- Left Panel -->
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Customers</div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                        </tr>
                                        </thead>

                                        @foreach($customers as $key => $item)
                                            <tbody>
                                            <td>
                                                <input type="radio" id="customer-{{$key++}}" name="customer_details"
                                                       value="{!! $item->customer_id !!}">
                                                {{$item->customer_id}}
                                            </td>
                                            <td>
                                                {{$item->english_name.' / '.$item->local_name}}
                                            </td>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            let customer_details = document.querySelector('input[name="customer_details"]:checked');
            $(customer_details).on('change', function (e) {
                console.log(customer_details);
            });
        });
    </script>
@endsection
