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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="firstname">Product ID</label>
                                <input type="text" class="form-control" name="product_id" style="font-weight: bold " value="{{ $productID }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select name="category" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>      
                                    @endforeach
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    @foreach ($branches as $branche)
                                        <option value="{{ $branche->id }}">{{ $branche->branch_name }}</option>      
                                    @endforeach
                                </select>                            
                            </div>
                        </div>

                    </div>

                    <!-- =============================== -->

                    <div class="row" style="display: flex; align-items:center" >
            
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lastname">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ old('descriptipn') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lastname">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lastname">Tax</label>
                                <input type="text" class="form-control" name="tax" value="{{ old('tax') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lastname">Amount</label>
                                <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
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
@endsection