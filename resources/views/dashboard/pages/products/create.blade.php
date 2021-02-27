@extends('dashboard.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Add Product</small>
        </h1>
    </section>

    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Add Product</h3>
        </div><!-- /.box-header -->
        <form action="{{route('dashboard.post-add-product')}}" method="POST">

            <div class="box-body">
                @include('dashboard.partials._errors')
                <!-- form start -->

                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    
                    <div class="row" style="display: flex; align-items:center" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstname">Product ID</label>
                                <input type="text" class="form-control" name="product_id" style="font-weight: bold " value="{{ $productID }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>      
                                    @endforeach
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand</label>
                                <select name="brand" id="brand" class="form-control" disabled>
                                    <option value=""></option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Model</label>
                                <select name="model" id="model" class="form-control" disabled>
                                    <option value=""></option>
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" name="color" value="{{ old('color') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Size">Size</label>
                                <input type="text" class="form-control" name="size" value="{{ old('size') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    @foreach ($branches as $branche)
                                        <option value="{{ $branche->id }}">{{ $branche->branch_name }}</option>      
                                    @endforeach
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">Amount</label>
                                <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ old('descriptipn') }}">
                            </div>
                        </div>


                    </div>

                    <!-- =============================== -->

                    <div class="row" style="display: flex; align-items:center" >

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Tax</label>
                                <input type="text" class="form-control" name="tax" value="{{ old('tax') }}">
                            </div>
                        </div>

                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</button>
                </div>
            </div><!-- /.box -->
        </form>
    </div>

    <script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>
    <script>

        // Set the brands after choosing the category ID
        let category_ID = document.querySelector('#category');
            $(category_ID).on('change', function(e) {
                console.log(category_ID.value);
                if($(this).val() != '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-brands-by-category-id")}}',
                        data: { category_id: category_ID.value },
                        success: function(response) {
                            let brandSelect = document.querySelector('#brand');
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
                    let brandSelect = document.querySelector('#brand');
                    brandSelect.innerHTML = '';
                    brandSelect.disabled = true;

                    let modelSelect = document.querySelector('#model');
                    modelSelect.innerHTML = '';
                    modelSelect.disabled = true;

                }
            });

            // Set The models after choosing the Brand ID
            let modal_brand_ID = document.querySelector('#brand');
            $(modal_brand_ID).on('change', function(e) {
                console.log(modal_brand_ID.value);
                if($(this).val() != '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.filter-models-by-brand-id")}}',
                        data: { brand_id: modal_brand_ID.value },
                        
                        success: function(response) {
                            let modelsSelect = document.querySelector('#model');
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
                    let modelsSelect = document.querySelector('#model');
                    modelsSelect.innerHTML = '';
                    modelsSelect.disabled = true;
                }
            });
            

    </script>
@endsection