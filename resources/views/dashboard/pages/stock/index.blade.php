@extends('dashboard.layouts.master')
@section('content')

    <style>
        .bordered-inputs {
            border: 1px solid #3c8dbc;
            box-shadow: 0 -1px 4px 1px #3c8dbc;
        }

        .item-table {
            opacity: 0;
        }

        .modal.in .modal-dialog {
            width: 85%;
        }

        .modal .modal-header {
            color: #fff;
            background: #032524
        }

        .modal .modal-header button {
            background: #8bc340;
            background: #8bc340;
            padding: 1px 6px;
            border-radius: 5px;
            opacity: 0.75;
            transition: ease-in-out all 0.3s;
        }

        .modal .modal-body {
            padding: 15px 15px;
        }

        .modal .modal-footer {
            margin-top: 0
        }

        .panel {
            min-height: 350px;
        }

        .panel.left .panel-heading {
            background-color: #3c8dbc;
            font-size: 16px
        }

        .panel.left .form-group {
            display: flex;
            align-items: center;
        }

        .panel.left .form-group label {
            margin-right: 10px;
            width: 40px;
            display: inline-table
        }

        .panel.left .btn.btn-danger {
            margin-left: 5px
        }

        .panel.left .btn.btn-success {
            margin-left: 10px
        }

        .panel.right .panel-heading {
            background-color: #008d4c;
            font-size: 16px
        }

    </style>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Stock Overview</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip"
                        title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                <button class="btn btn-success btn-sm pull-right" data-target="#myModal" data-toggle="modal"
                        title="Advanced Search" style="margin-right: 5px;"><i class="fa fa-search"></i></button>
            </div>

            <i class="fa fa-stack-overflow"></i>
            <h3 class="box-title">Stock Overview</h3>

            <form method="POST" id="search-item">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Items"
                               value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search For
                            Item
                        </button>
                    </div>
                </div>
                <div class="alert alert-danger" style="display: none; margin: 10px; width: 63%">
                    <p class=""></p>
                </div>
            </form>

        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="item id">Item ID #</label>
                            <input type="text" name="item_id" class="item_id form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descriptipn">Item Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover item-table">
                            <tr>
                                <th>Branch Name</th>
                                <th>Description</th>
                                <th>Stock Amount</th>
                            </tr>

                            <tr>
                                <td class="first-td"></td>
                                <td class="second-td"></td>
                                <td class="third-td"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

    <!-- Add Modal -->
    <div id="myModal" class="modal fade" role="dialog">
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

                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value=""></option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-success filter-categories"><i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select name="brand_id" id="brand_id" disabled
                                                class="form-control modal_brand_id">
                                            <option value=""></option>
                                        </select>
                                        <button class="btn btn-success filter-brands"><i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-close"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <select name="model_id" id="model_id" disabled class="form-control">
                                            <option value=""></option>
                                        </select>
                                        <button class="btn btn-success filter-models"><i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" name="size" id="size" class="form-control">
                                        <button class="btn btn-success filter-sizes"><i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" name="color" id="color" class="form-control">
                                        <button class="btn btn-success filter-colors"><i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-danger filter-brands"><i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Right Panel -->
                        {{-- <div class="col-md-6">
                            <div class="panel panel-primary right">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Pick Up Values</div>
                                <div class="panel-body">
                                  <p></p>
                                </div>

                              </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="panel-table">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID#</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Tax</th>
                                        <th>Total</th>
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

            // Search Item with ID
            $('#search-item').submit(function (event) {
                event.preventDefault();

                product_id = $('.box .box-header input[name="search"]').val().trim();

                if (product_id == '') {
                    $('.alert-danger').css('display', 'block');
                    $('.alert-danger p').html('Please Enter Product ID!');
                } else {

                    let item_input = document.querySelector('.item_id');
                    let description = document.querySelector('.description');

                    let table = document.querySelector('.item-table');
                    let first_td = document.querySelector('.first-td');
                    let second_td = document.querySelector('.second-td');
                    let third_td = document.querySelector('.third-td');

                    table.style.opacity = '0';
                    item_input.value = '';
                    description.innerText = '';

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.search-item")}}',
                        data: {product_id: product_id},
                        success: function (response) {
                            if (response.message == 'No Item Found With this ID!') {
                                $('.success-message').css('display', 'none');
                                $('.alert-danger').css('display', 'block');
                                $('.alert-danger p').html('No Item Found With this ID!');
                            } else {
                                $('.alert-danger').css('display', 'none');
                                item_input.value = response.product_id;
                                description.innerText = response.describtion;

                                // set table TDs
                                first_td.innerText = response.branch_name['branch_name'];
                                second_td.innerText = response.describtion;
                                third_td.innerText = response.amount;

                                setTimeout(function () {
                                    item_input.classList.add('bordered-inputs');
                                    description.classList.add('bordered-inputs');
                                    table.classList.add('bordered-inputs');
                                    table.style.opacity = '1';
                                }, 200)
                            }

                        },

                    });
                }

            });

            // Filter Products With category ID
            $('.filter-categories').on('click', function (e) {
                e.preventDefault();

                let cat_id = document.querySelector('#category_id').value;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.filter-products-cat-id")}}',
                    data: {category_id: cat_id},
                    success: function (response) {
                        console.log(response);
                        table = document.querySelector('.panel-table div table tbody');
                        document.querySelector('.panel-table div table').style.opacity = '1';
                        table.innerHTML = '';
                        if (response.length != 0) {
                            document.querySelector('.no-items').style.display = 'none';
                            response.forEach((product, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML += `
                                    <td>${index + 1}</td>
                                    <td>${product.describtion}</td>
                                    <td>${product.price}</td>
                                    <td>${product.tax}</td>
                                    <td>${product.total}</td>
                                `;
                                table.appendChild(row)
                            });
                        } else {
                            document.querySelector('.panel-table div table').style.opacity = '0';
                            document.querySelector('.no-items').style.display = 'block';
                        }
                    }
                });
            })


            // Filter Products With Brand ID
            $('.filter-brands').on('click', function (e) {
                e.preventDefault();

                let brand_id = document.querySelector('#brand_id').value;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.filter-products-brand-id")}}',
                    data: {brand_id: brand_id},
                    success: function (response) {
                        console.log(response);
                        table = document.querySelector('.panel-table div table tbody');
                        document.querySelector('.panel-table div table').style.opacity = '1';
                        table.innerHTML = '';
                        if (response.length != 0) {
                            document.querySelector('.no-items').style.display = 'none';
                            response.forEach((product, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML += `
                                    <td>${index + 1}</td>
                                    <td>${product.describtion}</td>
                                    <td>${product.price}</td>
                                    <td>${product.tax}</td>
                                    <td>${product.total}</td>
                                `;
                                table.appendChild(row)
                            });
                        } else {
                            document.querySelector('.panel-table div table').style.opacity = '0';
                            document.querySelector('.no-items').style.display = 'block';
                        }
                    }
                });
            })

            // Filter Products With Modle ID
            $('.filter-models').on('click', function (e) {
                e.preventDefault();

                let model_id = document.querySelector('#model_id').value;
                console.log('model ID: ', model_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.filter-products-model-id")}}',
                    data: {model_id: model_id},
                    success: function (response) {
                        console.log(response);
                        table = document.querySelector('.panel-table div table tbody');
                        document.querySelector('.panel-table div table').style.opacity = '1';
                        table.innerHTML = '';
                        if (response.length != 0) {
                            document.querySelector('.no-items').style.display = 'none';
                            response.forEach((product, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML += `
                                    <td>${index + 1}</td>
                                    <td>${product.describtion}</td>
                                    <td>${product.price}</td>
                                    <td>${product.tax}</td>
                                    <td>${product.total}</td>
                                `;
                                table.appendChild(row)
                            });
                        } else {
                            document.querySelector('.panel-table div table').style.opacity = '0';
                            document.querySelector('.no-items').style.display = 'block';
                        }
                    }
                });
            })

            // Filter Products With Size
            $('.filter-sizes').on('click', function (e) {
                e.preventDefault();

                let size = document.querySelector('#size').value;
                console.log(size);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.filter-products-size")}}',
                    data: {size: size},
                    success: function (response) {
                        console.log(response);
                        table = document.querySelector('.panel-table div table tbody');
                        document.querySelector('.panel-table div table').style.opacity = '1';
                        table.innerHTML = '';
                        if (response.length != 0) {
                            document.querySelector('.no-items').style.display = 'none';
                            response.forEach((product, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML += `
                                    <td>${index + 1}</td>
                                    <td>${product.describtion}</td>
                                    <td>${product.price}</td>
                                    <td>${product.tax}</td>
                                    <td>${product.total}</td>
                                `;
                                table.appendChild(row)
                            });
                        } else {
                            document.querySelector('.panel-table div table').style.opacity = '0';
                            document.querySelector('.no-items').style.display = 'block';
                        }
                    }
                });
            })


            // Filter Products With Size
            $('.filter-colors').on('click', function (e) {
                e.preventDefault();

                let color = document.querySelector('#color').value;
                console.log(color);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.filter-products-color")}}',
                    data: {color: color},
                    success: function (response) {
                        console.log(response);
                        table = document.querySelector('.panel-table div table tbody');
                        document.querySelector('.panel-table div table').style.opacity = '1';
                        table.innerHTML = '';
                        if (response.length != 0) {
                            document.querySelector('.no-items').style.display = 'none';
                            response.forEach((product, index) => {
                                let row = document.createElement('tr');
                                row.innerHTML += `
                                    <td>${index + 1}</td>
                                    <td>${product.describtion}</td>
                                    <td>${product.price}</td>
                                    <td>${product.tax}</td>
                                    <td>${product.total}</td>
                                `;
                                table.appendChild(row)
                            });
                        } else {
                            document.querySelector('.panel-table div table').style.opacity = '0';
                            document.querySelector('.no-items').style.display = 'block';
                        }
                    }
                });
            })

            /* ==================================================================================================
            ==================================== Set Select Boxes ===============================================
            ================================================================================================== */

            // Set the brands after choosing the category ID
            let category_ID = document.querySelector('#category_id');
            $(category_ID).on('change', function (e) {
                console.log(category_ID.value);
                if ($(this).val() != '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-brands-by-category-id")}}',
                        data: {category_id: category_ID.value},
                        success: function (response) {
                            let brandSelect = document.querySelector('#brand_id');
                            brandSelect.innerHTML = '<option value=""></option>';
                            response.forEach((brand, index) => {
                                brandSelect.innerHTML += `
                                    <option value="${brand.id}">${brand.brand_name}</option>
                                `;
                            });
                            brandSelect.disabled = false;

                        }
                    });
                } else {
                    let brandSelect = document.querySelector('#brand_id');
                    brandSelect.innerHTML = '';
                    brandSelect.disabled = true;

                    let modelSelect = document.querySelector('#model_id');
                    modelSelect.innerHTML = '';
                    modelSelect.disabled = true;

                }
            });

            // Set The models after choosing the Brand ID
            let modal_brand_ID = document.querySelector('.modal_brand_id');
            $(modal_brand_ID).on('change', function (e) {
                console.log(modal_brand_ID.value);
                if ($(this).val() != '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-models-by-brand-id")}}',
                        data: {brand_id: modal_brand_ID.value},

                        success: function (response) {
                            let modelsSelect = document.querySelector('#model_id');
                            modelsSelect.innerHTML = '<option value=""></option>';
                            response.forEach((model, index) => {
                                modelsSelect.innerHTML += `
                                    <option value="${model.id}">${model.model_id}</option>
                                `;
                            });
                            modelsSelect.disabled = false;

                        }
                    });
                } else {
                    let modelsSelect = document.querySelector('#model_id');
                    modelsSelect.innerHTML = '';
                    modelsSelect.disabled = true;
                }
            });

            // Hide Tableon modal closing
            $('#myModal, #updateModal').on('hidden.bs.modal', function (e) {
                document.querySelector('.panel-table div table').style.opacity = '0';
            })
        });

    </script>

@stop
