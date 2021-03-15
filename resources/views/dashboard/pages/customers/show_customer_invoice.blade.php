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
                                <input type="text" class="form-control" disabled name="customer_id"
                                       value="{{$customer->customer_id}}" id="customer_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Name</label>
                                <input type="text" class="form-control" name="customer_name"
                                       value="{{$customer->english_name}}"
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
                                <input type="text" class="form-control" disabled name="doctor_id" value="" id="doctor_id">
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
                                <button class="btn btn-success btn-sm pull-right" data-target="#DoctorModal"
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
                                <input type="number" class="form-control" name="product_quantity"
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
                <div class="product_invoice_table">
                    <table class="table table-bordered table-hover" style="opacity:0;">
                        <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Item #</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount Type</th>
                            <th>Discount</th>
                            <th>Net</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Stock</th>
                            <th>Branch</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Customers Modal -->
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
                                                <button name="customerId" id="customerId" style="height: 15px;"
                                                        value="{!! $item->customer_id !!}"></button>
                                                {{$item->customer_id}}

                                            </td>
                                            <td>
                                                {{$item->english_name}}
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
    <!-- Add Modal -->
    <div id="DoctorModal" class="modal fade" role="dialog">
        <div class="modal-dialog box-item">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header box-item-head">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Select Doctor</h3>
                </div>

                <div class="modal-body  box-item-content">
                    <div class="row">
                        <!-- Left Panel -->
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Doctors</div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                        </tr>
                                        </thead>

                                        @foreach($doctors as $key => $item)
                                            <tbody>
                                            <td>
                                                <button name="doctorId" id="doctorId" style="height: 15px;"
                                                        value="{!! $item->id !!}"></button>
                                                {{$item->code}}
                                            </td>
                                            <td>
                                                {{$item->name}}
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

    <div id="searchModal" class="modal fade" role="dialog">
        <div class="modal-dialog box-item">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header box-item-head">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Advanced Search</h3>
                </div>

                <div class="modal-body  box-item-content">

                    <div class="row">
                        <!-- Left Panel -->
                        <div class="col-md-6">
                            <div class="panel panel-primary left">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Group</div>
                                <div class="panel-body">
                                    <div class="form-group">

                                        <select name="category_id" id="category_id"
                                                class="form-control">
                                            <option value=""></option>
                                            @foreach($categories as $cat)
                                                <option
                                                    value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-success full-search btn-flat"><i
                                                class="fa fa-search"></i></button>
                                        <button class="btn btn-danger btn-flat"><i
                                                class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="filters-container" style="display: none">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" name="brand_input" id="brand_input"
                                                   class="form-control brand_input" data-id="">
                                            <button class="btn btn-success filter-brands btn-flat">
                                                <i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-danger btn-flat reset-brand"><i
                                                    class="fa fa-times"></i></button>
                                        </div>

                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" name="model_input" id="model_input"
                                                   class="form-control model_input">
                                            <button class="btn btn-success filter-models btn-flat">
                                                <i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-danger btn-flat reset-model"><i
                                                    class="fa fa-times"></i></button>
                                        </div>

                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" name="size" id="size"
                                                   class="form-control">
                                            <button class="btn btn-success filter-sizes btn-flat"><i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-danger btn-flat reset-size"><i
                                                    class="fa fa-times"></i></button>
                                        </div>

                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="text" name="color" id="color"
                                                   class="form-control">
                                            <button class="btn btn-success filter-colors btn-flat">
                                                <i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-danger btn-flat reset-color"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Right Panel -->
                        <div class="col-md-6">
                            <div class="panel panel-primary right">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Pick Up Values</div>
                                <div class="panel-body">
                                    <p class="no-items lead" style="display: none">No Items
                                        Found!</p>
                                    <table class="table table-bordered table-hover"
                                           style="opacity: 0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel-table">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" style="disblay: none">
                                    <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>Item #</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount Type</th>
                                        <th>Discount</th>
                                        <th>Net</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Stock</th>
                                        <th>Branch</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <h3 class="text-center no-items" style="display: none">No Items Found!</h3>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#customerId', function (e) {
                e.preventDefault();
                let customer_id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "GET",
                    url: '{{route("dashboard.get-customer-details")}}',
                    data: {customer_id: customer_id},
                    success: function (response) {
                        console.log(response.customer.english_name);
                        document.getElementById('customer_id').value = response.customer.customer_id;
                        document.getElementById('customer_name').value = response.customer.english_name + ' / ' + response.customer.local_name;
                        $('#customerModal').modal('hide');
                    }
                });

            })

            $(document).on('click', '#doctorId', function (e) {
                e.preventDefault();
                let doctor_id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "GET",
                    url: '{{route("dashboard.get-doctor-details")}}',
                    data: {doctor_id: doctor_id},
                    success: function (response) {
                        console.log(response.doctor.name);
                        document.getElementById('doctor_id').value = response.doctor.code;
                        document.getElementById('doctor_name').value = response.doctor.name;
                        $('#DoctorModal').modal('hide');
                    }
                });

            })

            // On Changing Category Select Box
            let categorySelector = document.querySelector('#category_id');
            $(categorySelector).on('change', function (e) {
                console.log(categorySelector.value);
                let brand_input = document.querySelector('#brand_input');
                let model_input = document.querySelector('#model_input');
                brand_input.value = '';
                model_input.value = '';
                // Showing Filters Container
                if ($(this).val() != '') {
                    let flitersContainer = document.querySelector('.filters-container');
                    flitersContainer.style.display = 'block';
                }

                // Get All Brands Under Certain Category And Set Them In the PickUp Values Section
                $('.filter-brands').on('click', function (e) {
                    e.preventDefault();
                    let brand_value = document.querySelector('#brand_input').value;

                    // Get all Brands Under The Choosed Category

                    category_ID = document.querySelector('#category_id').value;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-brands-by-category-id")}}',
                        data: {category_id: category_ID},
                        success: function (response) {
                            console.log(response);
                            table = document.querySelector('.panel.right .panel-body table tbody');
                            document.querySelector('.panel.right .panel-body table').style.opacity = '1';
                            table.innerHTML = '';
                            if (response.length != 0) {
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'none';
                                response.forEach((brand, index) => {
                                    let row = document.createElement('tr');
                                    row.innerHTML += `
                                        <td>
                                            <a href="#" class="translate-brand translate"><i class="fa fa-arrows-h"></i></a>
                                            <p class="text-center"><strong data-id="${brand.id}">${brand.brand_name}</strong></p>
                                        </td>
                                    `;
                                    table.appendChild(row)
                                });
                            } else {
                                document.querySelector('.panel.right .panel-body table').style.opacity = '0';
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'block';
                            }
                        }
                    });
                });

                // Filter Models
                $('.filter-models').on('click', function (e) {
                    e.preventDefault();
                    let model_value = document.querySelector('#model_input').value;

                    // Get all Models Under The Choosed Brand

                    category_ID = document.querySelector('#category_id').value;
                    brand_ID = document.querySelector('#brand_input').getAttribute('data-id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-models-by-category-and-brand-id")}}',
                        data: {category_id: category_ID, brand_id: brand_ID},
                        success: function (response) {
                            console.log(response);
                            table = document.querySelector('.panel.right .panel-body table tbody');
                            document.querySelector('.panel.right .panel-body table').style.opacity = '1';
                            table.innerHTML = '';
                            if (response.length != 0) {
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'none';
                                response.forEach((model, index) => {
                                    let row = document.createElement('tr');
                                    row.innerHTML += `
                                        <td>
                                            <a href="#" class="translate-model translate"><i class="fa fa-arrows-h"></i></a>
                                            <p class="text-center"><strong data-id="${model.id}">${model.model_id}</strong></p>
                                        </td>
                                    `;
                                    table.appendChild(row)
                                });
                            } else {
                                document.querySelector('.panel.right .panel-body table').style.opacity = '0';
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'block';
                            }
                        }
                    });

                });

            });

            // Translate Brand to left box
            let brandTable = document.querySelector('.panel.right .panel-body table');
            brandTable.addEventListener('click', function (e) {
                console.log(e.target.tagName)
                if (e.target.tagName == 'I' & e.target.parentElement.classList.contains('translate-brand')) {
                    let brandValue = e.target.parentElement.nextSibling.nextSibling.firstChild;
                    let brandID = brandValue.getAttribute('data-id');
                    console.log(brandValue.innerText, brandID);

                    let brandSelect = document.querySelector('#brand_input');
                    brandSelect.value = brandValue.innerText;
                    brandSelect.setAttribute('data-id', brandID);
                }

                if (e.target.tagName == 'I' & e.target.parentElement.classList.contains('translate-model')) {
                    let modelValue = e.target.parentElement.nextSibling.nextSibling.firstChild;
                    let modelID = modelValue.getAttribute('data-id');
                    console.log(modelValue.innerText, modelID);

                    let modelSelect = document.querySelector('#model_input');
                    modelSelect.value = modelValue.innerText;
                    modelSelect.setAttribute('data-id', modelID);
                }
            });

            // Full Search
            $('.full-search').on('click', function(e) {
                let category_id = document.querySelector('#category_id').value;
                let brand_input_id = document.querySelector('#brand_input').getAttribute('data-id');
                let model_input_id = document.querySelector('#model_input').getAttribute('data-id');
                let color = document.querySelector('#color').value;
                let size = document.querySelector('#size').value;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.full-search")}}',
                    data: { 
                        category_id: category_id,
                        brand_id: brand_input_id,
                        model_id: model_input_id,
                        color: color,
                        size: size 
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.length == 0) {
                            let table = document.querySelector('.panel-table');
                            table.querySelector('.no-items').style.display = 'block';
                            table.querySelector('table').style.display = 'none';

                        } else {
                            let table = document.querySelector('.panel-table');
                            table.querySelector('table tbody').innerHTML = '';
                            table.style.opacity = '1';
                            // set table TDs
                            response.forEach((resp, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${resp.branch_name['branch_name']}</td>
                                    <td>${resp.describtion}</td>
                                    <td>${resp.total}</td>
                                    <td>${resp.amount}</td>
                                `
                                table.querySelector('table tbody').appendChild(row);
                            });
                            table.querySelector('table').style.display = 'inline-table';
                            table.querySelector('.no-items').style.display = 'none';
                        }
                    }
                });


                console.log(category_id, brand_input_id, model_input_id)
            });

            $(document).on('click', '#productId', function (e) {
                e.preventDefault();
                let product_id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "GET",
                    url: '{{route("dashboard.get-product-details")}}',
                    data: {product_id: product_id},
                    success: function (resp) {
                        console.log(resp.product[0]);
                        let table = document.querySelector('.product_invoice_table table');
                        table.querySelector('tbody').innerHTML = '';
                        table.style.opacity = '1';
                        // set table TDs
                        let row = document.createElement('tr');
                        row.innerHTML = `
                                    <td>${resp.product[0].id}</td>
                                    <td>${resp.product[0].product_id}</td>
                                    <td>${resp.product[0].describtion}</td>
                                    <td>${resp.product[0].amount}</td>
                                    <td>${resp.product[0].price}</td>
                                    <td></td>
                                    <td></td>
                                    <td>${resp.product[0].price}</td>
                                    <td>${resp.product[0].price}</td>
                                    <td>${resp.product[0].total}</td>
                                    <td></td>
                                    <td>${resp.product[0].branch_name}</td>
                                `
                        table.querySelector('tbody').appendChild(row);

                        $('#searchModal').modal('hide');
                    }
                });

            })
            // Reset Brand Input
            $('.reset-brand').on('click', function (e) {
                e.preventDefault();
                $('#brand_input').val('');
                $('#brand_input').attr('data-id', '');
            });

            // Reset Model Input
            $('.reset-model').on('click', function (e) {
                e.preventDefault();
                $('#model_input').val('');
                $('#model_input').attr('data-id', '');
            });

            // Hide Products Table on modal closing
            $('#myModal, #updateModal').on('hidden.bs.modal', function (e) {
                document.querySelector('.panel-table div table').style.opacity = '0';
            })


        });
    </script>
@stop
