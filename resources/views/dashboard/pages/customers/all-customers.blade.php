@extends('dashboard.layouts.master')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Users</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>

            <i class="fa fa-users"></i>
            <h3 class="box-title">Customers <small class="badge bg-green">{{$customers->count() ? $customers->total() : ''}}</small></h3>
            
            <form action="{{route('dashboard.get-all-customers')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Users" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{route('dashboard.get-add-customer')}}" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add Customer</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add Customer</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($customers->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Local Name</th>
                                <th>Mobile Number</th>
                                <th>Group</th>
                                <th>Actions</th>
                            </tr>
                            <tbody>
                                @foreach($customers as $index => $customer)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$customer->customer_id}}</td>
                                        <td>{{$customer->english_name}}</td>
                                        <td>{{$customer->local_name}}</td>
                                        <td>{{$customer->mobile_number}}</td>
                                        <td>{{$customer->local_name}}</td>


                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="{{route('dashboard.get-update-customer', $customer->id)}}" class="btn btn-info btn-sm  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @endif
                                                
                                                @if(auth()->user()->hasPermission('delete_users'))
                                                    <form action="{{route('dashboard.delete-customer', $customer->id)}}" method="GET">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger delete btn-sm btn-flat" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
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

                        {{ $customers->appends(request()->query())->links() }}
                    @else
                        <h2>No Records</h2>
                    @endif
                </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

@stop