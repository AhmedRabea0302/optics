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
            <small>Categories</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa-tasks"></i>
            <h3 class="box-title">Categories <small class="badge bg-green">{{ $categories->total() }}</small></h3>
            
            <form action="{{route('dashboard.get-all-categories')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Categories" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href=""  data-toggle="modal" data-target="#myModal" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add Category</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add Category</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($categories->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach($categories as $index => $cat)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$cat->category_name}}</td>
                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="" data-id="{{ $cat->id }}" class="btn btn-info btn-sm  btn-flat update_category" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Update</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @endif
                                                
                                                @if(auth()->user()->hasPermission('delete_users'))
                                                    <form action="{{route('dashboard.delete-admin', $cat->id)}}" method="GET">
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

                        {{ $categories->appends(request()->query())->links() }}
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
                <h3>Add Category</h3>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
                <label for="cat name">Category Name</label>
                <input type="text" name="category_name" class="form-control">
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
                <h3>Update Category</h3>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
                <label for="cat name">Category Name</label>
                <input value="" type="text" name="category_name" class="form-control update_cat_name">
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

        // Add Category 
        $('.modal .modal-footer .button-add').on('click', function(event) {
            event.preventDefault();
            category_name = $('.modal .modal-body input[name="category_name"]').val().trim();
            if(category_name == '') {
                $('.alert-danger').css('display', 'block');
                $('.alert-danger p').html('Please Enter Category Name!');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.add-category")}}',
                    data: {category_name: category_name.trim()},
                    success: function(response) {
                        if(response.message == 'This Categoery Added Before!') {
                            $('.success-message').css('display', 'none');
                            $('.alert-danger').css('display', 'block');
                            $('.alert-danger p').html('This Categoery Added Before!');
                        } else {
                            $('.alert-danger').css('display', 'none');
                            $('.success-message').css('display', 'block');
                            $('.success-message p').html('Category Added Successfully!');
                            setTimeout(function() {location.reload()}, 1900);
                        }
                        
                    },

                });
            }
            
        });

        // Update Category
        let updateBtns = document.querySelectorAll('.update_category');
        updateBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                $cat_id = btn.getAttribute('data-id');
                $cat_name = btn.parentElement.parentElement.previousElementSibling.innerHTML;

                // Set The Update Category modal input with the category name
                document.querySelector('.update_cat_name').value = $cat_name; 
                
                // Update Category Name Ajax Requet
                $('#updateModal .modal-footer .button-update').on('click', function(event) {
                    category_name = $('.update_cat_name').val().trim();
                    if(category_name == '') {
                        $('.alert-danger').css('display', 'block');
                        $('.alert-danger p').html('Please Enter Category Name!');
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type: "POST",
                            url: '{{route("dashboard.update-category")}}',
                            data: {id: $cat_id, category_name: category_name},

                            success: function(response) {
                                if(response.message == 'This Categoery Added Before!') {
                                    $('.success-message').css('display', 'none');
                                    $('.alert-danger').css('display', 'block');
                                    $('.alert-danger p').html('This Categoery Already Exists!');
                                } else {
                                    $('.alert-danger').css('display', 'none');
                                    $('.success-message').css('display', 'block');
                                    $('.success-message p').html('Category Updated Successfully!');
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
            $('.modal .modal-body input[name="category_name"]').focus();
            $('.update_category_name').focus();
        }) 

    })
</script>

@stop