@extends('dashboard.layouts.master')
@section('content')
    
    <style>
            
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
            padding: 35px 15px;
        }

        .modal .form-action {
            background: #032524;
        }


        .modal .form-action .button-add, .modal .form-action .button-update {
            padding: 5px 25px;
            border-radius: 4px;
            background: #8bc340;
            color: #fff;
            border: none;
            transition: all ease-in-out .3s;
        }

        .modal .form-action .button-update:hover, .modal .form-action .button-add:hover {
            background: #3c763d;
        }

    </style>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Products</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa-tasks"></i>
            <h3 class="box-title">Products <small class="badge bg-green">{{ $products->total() }}</small></h3>
            
            <form action="{{route('dashboard.get-all-products')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Products" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{ route('dashboard.get-add-product') }}" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add Product</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add Product</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($products->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Prpduct Tax</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <th><a href="">{{ $product->product_id }}</a></th>
                                        <td>{{ $product->describtion }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->tax }}</td>
                                        <td>{{ $product->total }}</td>
                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="" class="btn btn-info btn-sm  btn-flat" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Update</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @endif
                                                
                                                @if(auth()->user()->hasPermission('delete_users'))
                                                    <form action="{{route('dashboard.delete-admin', $product->id)}}" method="GET">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger delete btn-sm btn-flat disabled" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </form>
                                                @else 
                                                    <button type="submit" class="btn btn-danger btn-sm disabled btn-flat delete" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $products->appends(request()->query())->links() }}
                    @else
                        <h2>No Records</h2>
                    @endif
                </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

@stop