@extends('dashboard.layouts.master')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Doctors</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip"
                        title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>

            <i class="fa fa-users"></i>
            <h3 class="box-title">Doctors <small
                    class="badge bg-green">{{$doctors->count() ?? ''}}</small></h3>

            <form action="{{route('dashboard.get-all-doctors')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Doctors"
                               value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search
                        </button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{route('dashboard.get-add-doctor')}}" class="btn btn-primary  btn-flat"
                               style="color: #fff"><i class="fa fa-plus"></i> Add Doctor</a>
                        @else
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i>
                                Add Doctor</a>
                        @endif

                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="box-body no-padding ">
                @if($doctors->count() > 0)
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Doctor Code</th>
                            <th>Doctor Name</th>
                            <th>Actions</th>
                        </tr>
                        <tbody>
                        @foreach($doctors as $index => $doctor)
                            <tr>
                                <th>{{$doctor->id}}</th>
                                <th>
                                    <a href="{{route('dashboard.show-doctor',['id' => $doctor->id])}}">{{$doctor->code}}</a>
                                </th>
                                <td>{{$doctor->name}}</td>
                                <td>
                                    <div style="display: flex">
                                        <a href="{{route('dashboard.get-update-doctor', $doctor->id)}}"
                                           class="btn btn-info btn-sm  btn-flat"><i class="fa fa-pencil"></i> Update</a>

                                        <form action="{{route('dashboard.delete-doctor', $doctor->id)}}"
                                              method="GET">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm btn-flat"
                                                    style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{--                    {{ $customers->appends(request()->query())->links() }}--}}
                @else
                    <h2>No Records</h2>
                @endif
            </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

@stop
