@extends('dashboard.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Show Doctor</small>
        </h1>
    </section>

    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Basic Information</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
        @include('dashboard.partials._errors')
        <!-- form start -->
            <form action="{{route('dashboard.post-update-doctor',['id'=>$doctor->id])}}" method="POST">

                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="row" style="display: flex; align-items:center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="code">Doctor code</label>
                            <input type="text" class="form-control" name="code" value="{{$doctor->code}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Doctor Name</label>
                            <input type="text" class="form-control" name="name" value="{{$doctor->name}}">
                        </div>
                    </div>
                </div>
        </div>


        <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update Doctor</button>
        </div>

        </form>
@endsection

