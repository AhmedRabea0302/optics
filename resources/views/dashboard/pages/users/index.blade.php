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
            <h3 class="box-title">Users <small class="badge">{{$users->total()}}</small></h3>
            
            <form action="{{route('dashboard.users.index')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Users" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{route('dashboard.users.create')}}" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add User</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add User</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <!-- form start -->
            <form role="form">
                
                <div class="box-body no-padding ">
                    @if($users->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>action</th>
                            </tr>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td style="display: flex">
                                            @if(auth()->user()->hasPermission('update_users'))
                                                <a href="{{route('dashboard.users.edit', $user->id)}}" class="btn btn-info btn-sm  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                            @else
                                                <a href="{{route('dashboard.users.edit', $user->id)}}" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                            @endif
                                            <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}

                                                @if(auth()->user()->hasPermission('delete_users'))
                                                    <button type="submit" class="btn btn-danger btn-sm btn-flat delete" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @else 
                                                    <button type="submit" class="btn btn-danger btn-sm disabled btn-flat delete" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->appends(request()->query())->links() }}
                    @else
                        <h2>No Records</h2>
                    @endif
                </div><!-- /.box-body -->
            </form>
        </div>

    </div><!-- /.box -->

@stop