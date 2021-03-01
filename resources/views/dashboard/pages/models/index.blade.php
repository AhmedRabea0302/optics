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
            <small>Models</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa-check-square-o"></i>
            <h3 class="box-title">Models <small class="badge bg-green">{{ $models->total() }}</small></h3>
            
            <form action="{{route('dashboard.get-all-models')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Models" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href=""  data-toggle="modal" data-target="#myModal" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add Model</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add Model</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($models->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Modle ID</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach($models as $index => $model)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$model->model_id}}</td>
                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="" data-id="{{ $model->id }}" class="btn btn-info btn-sm  btn-flat update_model" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Update</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @endif
                                                
                                                @if(auth()->user()->hasPermission('delete_users'))                                                  
                                                    <button type="submit" class="btn btn-danger delete btn-sm btn-flat disabled" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @else 
                                                    <button type="submit" class="btn btn-danger btn-sm disabled btn-flat delete" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $models->appends(request()->query())->links() }}
                    @else
                        <h2>No Records</h2>
                    @endif
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
                <h3>Add Model</h3>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
                <div class="form-group">
                    <label for="Category">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Brands">Brands</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>


                <label for="cat name">Model ID</label>
                <input type="text" name="model_id" class="form-control add-modal-id">
            </div>

            <div class="modal-footer form-action">
                <button type="submit" class="btn btn-success button-add"><i class="fa fa-plus" style="margin-right: 5px"></i> Add</button>                
            </div>
        </div>

    </div>
</div>

<!-- Update Modal -->
<div id="updateModal" class="modal fade" role="dialog">
    <div class="modal-dialog box-item">

        <!-- Modal content-->
        <div class="modal-content">
            
            <div class="modal-header box-item-head">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Update Model</h3>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
                <label for="Model ID">Model ID</label>
                <input value="" type="text" name="model_id" class="form-control update_model_id">
            </div>

            <div class="modal-footer form-action">
                <button type="submit" class="btn btn-success button-update"><i class="fa fa-pencil" style="margin-right: 5px"></i> Update</button>                
            </div>
        </div>

    </div>
</div>

<script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        // Add Model 
        $('.modal .modal-footer .button-add').on('click', function(event) {
            event.preventDefault();
            category_id = $('#category_id').val();
            brand_id    = $('#brand_id').val();
            model_id = $('.modal .modal-body input[name="model_id"]').val().trim();
            if(model_id == '') {
                $('.alert-danger').css('display', 'block');
                $('.alert-danger p').html('Please Enter Model ID!');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.post-add-model")}}',
                    data: {model_id: model_id.trim(), category_id: category_id, brand_id: brand_id},
                    success: function(response) {
                        if(response.message == 'This Model Added Before!') {
                            $('.success-message').css('display', 'none');
                            $('.alert-danger').css('display', 'block');
                            $('.alert-danger p').html('This Model Added Before!');
                        } else {
                            $('.alert-danger').css('display', 'none');
                            $('.success-message').css('display', 'block');
                            $('.success-message p').html('Model Added Successfully!');
                            setTimeout(function() {location.reload()}, 1900);
                        }
                        
                    },

                });
            }
            
        });

        // Update Model
        let updateBtns = document.querySelectorAll('.update_model');
        updateBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                model_id_int = btn.getAttribute('data-id');
                model_id_text = btn.parentElement.parentElement.previousElementSibling.innerHTML;

                // Set The Update Category modal input with the category name
                document.querySelector('.update_model_id').value = model_id_text; 
                
                // Update Category Name Ajax Requet
                $('#updateModal .modal-footer .button-update').on('click', function(event) {
                    model_id_text = $('.update_model_id').val().trim();
                    if(model_id_text == '') {
                        $('.alert-danger').css('display', 'block');
                        $('.alert-danger p').html('Please Enter Model ID!');
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type: "POST",
                            url: '{{route("dashboard.update-model")}}',
                            data: {id: model_id_int, model_id: model_id_text},

                            success: function(response) {
                                if(response.message == 'Please enter model ID!') {
                                    $('.success-message').css('display', 'none');
                                    $('.alert-danger').css('display', 'block');
                                    $('.alert-danger p').html('Please enter model ID!');
                                } else {
                                    $('.alert-danger').css('display', 'none');
                                    $('.success-message').css('display', 'block');
                                    $('.success-message p').html('Model Updated Successfully!');
                                    setTimeout(function() {location.reload()}, 1900);
                                }
                                
                            },

                        })
                    }
                });
            })
        })

        // Clear Messages After Modal Closing
        $('#myModal, #updateModal').on('hidden.bs.modal', function (e) {
            $('.alert-danger').css('display', 'none');
            $('.success-message').css('display', 'none');
        })

        // Focus On Beanch Input on modal Opening
        $('#myModal, #updateModal').on('shown.bs.modal', function () {
            $('.modal .modal-body input[name="model_id"]').focus();
            $('.update_model_id').focus();
        });
    })

</script>

@stop