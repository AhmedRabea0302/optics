@extends('dashboard.layouts.master')
@section('content')

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
                        <table class="table table-bordered table-hover item-table" style="opacity: 0">
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
                                    <button class="btn btn-success full-search btn-flat"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-danger btn-flat"><i class="fa fa-times"></i></button>
                                  </div>

                                <div class="filters-container" style="display: none">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" name="brand_input" id="brand_input" class="form-control brand_input" data-id="">
                                        <button class="btn btn-success filter-brands btn-flat"><i class="fa fa-search"></i></button>
                                        <button class="btn btn-danger btn-flat reset-brand"><i class="fa fa-times"></i></button>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" name="model_input" id="model_input" class="form-control model_input">
                                        <button class="btn btn-success filter-models btn-flat"><i class="fa fa-search"></i></button>
                                        <button class="btn btn-danger btn-flat reset-model"><i class="fa fa-times"></i></button>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" name="size" id="size" class="form-control">
                                        <button class="btn btn-success filter-sizes btn-flat"><i class="fa fa-search"></i></button>
                                        <button class="btn btn-danger btn-flat reset-size"><i class="fa fa-times"></i></button>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" name="color" id="color" class="form-control">
                                        <button class="btn btn-success filter-colors btn-flat"><i class="fa fa-search"></i></button>
                                        <button class="btn btn-danger btn-flat reset-color"><i class="fa fa-times"></i></button>
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
                                  <p class="no-items lead" style="display: none">No Items Found!</p>
                                  <table class="table table-bordered table-hover" style="opacity: 0">
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
                                <table class="table table-bordered table-hover" style="display: none">
                                    <thead>
                                    <tr>
                                        <th>ID#</th>
                                        <th>Branch</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Stock</th>
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



    <script src="{{ asset('assets/js/jquery-2.0.2.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        
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

            // On Changing Category Select Box
            let categorySelector = document.querySelector('#category_id');
            $(categorySelector).on('change', function(e) {
                console.log(categorySelector.value);
                let brand_input = document.querySelector('#brand_input');
                let model_input = document.querySelector('#model_input');
                brand_input.value = '';
                model_input.value = '';
                // Showing Filters Container
                if($(this).val() != '') {
                    let flitersContainer = document.querySelector('.filters-container');
                    flitersContainer.style.display = 'block';
                }

                // Get All Brands Under Certain Category And Set Them In the PickUp Values Section
                $('.filter-brands').on('click', function(e) {
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
                        data: { category_id: category_ID },
                        success: function(response) {
                            console.log(response);
                            table = document.querySelector('.panel.right .panel-body table tbody');
                            document.querySelector('.panel.right .panel-body table').style.opacity = '1';
                            table.innerHTML = '';
                            if(response.length != 0) {
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'none';
                                response.forEach((brand, index) => {
                                    let row = document.createElement('tr');
                                    row.innerHTML += `
                                        <td>
                                            <a href="#" class="translate-brand translate"><i class="fa fa-arrows-h"></i></a>
                                            <p class="text-center"><strong data-id="${ brand.id }">${ brand.brand_name }</strong></p>
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
                $('.filter-models').on('click', function(e) {
                    e.preventDefault();
                    let model_value = document.querySelector('#model_input').value;
                    console.log('HHHH');
                    // Get all Models Under The Choosed Brand

                    category_ID = document.querySelector('#category_id').value;
                    brand_ID = document.querySelector('#brand_input').getAttribute('data-id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-models-by-category-and-brand-id")}}',
                        data: { category_id: category_ID, brand_id: brand_ID },
                        success: function(response) {
                            console.log(response);
                            table = document.querySelector('.panel.right .panel-body table tbody');
                            document.querySelector('.panel.right .panel-body table').style.opacity = '1';
                            table.innerHTML = '';
                            if(response.length != 0) {
                                document.querySelector('.panel.right .panel-body .no-items').style.display = 'none';
                                response.forEach((model, index) => {
                                    let row = document.createElement('tr');
                                    row.innerHTML += `
                                        <td>
                                            <a href="#" class="translate-model translate"><i class="fa fa-arrows-h"></i></a>
                                            <p class="text-center"><strong data-id="${ model.id }">${ model.model_id }</strong></p>
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
            brandTable.addEventListener('click', function(e) {
                console.log(e.target.tagName)
                if(e.target.tagName == 'I' & e.target.parentElement.classList.contains('translate-brand')) {
                    let brandValue = e.target.parentElement.nextSibling.nextSibling.firstChild;
                    let brandID = brandValue.getAttribute('data-id');
                    console.log(brandValue.innerText, brandID);

                    let brandSelect = document.querySelector('#brand_input');
                    brandSelect.value = brandValue.innerText;
                    brandSelect.setAttribute('data-id', brandID);
                }

                if(e.target.tagName == 'I' & e.target.parentElement.classList.contains('translate-model')) {
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

            // Reset Brand Input
            $('.reset-brand').on('click', function(e) {
                e.preventDefault();
                $('#brand_input').val('');
                $('#brand_input').attr('data-id', '');
            });

            // Reset Model Input
            $('.reset-model').on('click', function(e) {
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
