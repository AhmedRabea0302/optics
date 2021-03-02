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
            <small>Brands</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa-trello"></i>
            <h3 class="box-title">Brands <small class="badge bg-green">{{ $brands->total() }}</small></h3>
            
            <form action="{{route('dashboard.get-all-brands')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search brands" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href=""  data-toggle="modal" data-target="#myModal" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add Brand</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add Brand</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($brands->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach($brands as $index => $brand)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$brand->brand_name}}</td>
                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="" data-id="{{ $brand->id }}" class="btn btn-info btn-sm  btn-flat update_brand" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Update</a>
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

                        {{ $brands->appends(request()->query())->links() }}
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
                <h3>Add Brand</h3>
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
                <label for="cat name">Brand Name</label>
                <input type="text" name="brand_name" class="form-control">
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
                <h3>Update Brand</h3>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
                <label for="cat name">Brand Name</label>
                <input value="" type="text" name="brand_name" class="form-control update_brand_name">
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

        // Add Brand 
        $('.modal .modal-footer .button-add').on('click', function(event) {
            event.preventDefault();
            brand_name = $('.modal .modal-body input[name="brand_name"]').val().trim();
            category_id = $('#category_id').val();
            if(brand_name == '') {
                $('.alert-danger').css('display', 'block');
                $('.alert-danger p').html('Please Enter Brand Name!');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{route("dashboard.post-add-brand")}}',
                    data: {brand_name: brand_name.trim(), category_id: category_id},
                    success: function(response) {
                        if(response.message == 'This Brand Added Before!') {
                            $('.success-message').css('display', 'none');
                            $('.alert-danger').css('display', 'block');
                            $('.alert-danger p').html('This Brand Added Before!');
                        } else {
                            $('.alert-danger').css('display', 'none');
                            $('.success-message').css('display', 'block');
                            $('.success-message p').html('Brand Added Successfully!');
                            setTimeout(function() {location.reload()}, 1900);
                        }
                        
                    },

                });
            }
            
        });

        // Update Brand
        let updateBtns = document.querySelectorAll('.update_brand');
        updateBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                $brand_id = btn.getAttribute('data-id');
                $cat_name = btn.parentElement.parentElement.previousElementSibling.innerHTML;

                // Set The Update Brand modal input with the Brand name
                document.querySelector('.update_brand_name').value = $cat_name; 
                
                // Update Brand Name Ajax Requet
                $('#updateModal .modal-footer .button-update').on('click', function(event) {
                    brand_name = $('.update_brand_name').val().trim();
                    if(brand_name == '') {
                        $('.alert-danger').css('display', 'block');
                        $('.alert-danger p').html('Please Enter Brand Name!');
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type: "POST",
                            url: '{{route("dashboard.update-brand")}}',
                            data: {id: $brand_id, brand_name: brand_name},

                            success: function(response) {
                                if(response.message == 'This Brand Added Before!') {
                                    $('.success-message').css('display', 'none');
                                    $('.alert-danger').css('display', 'block');
                                    $('.alert-danger p').html('This Brand Already Exists!');
                                } else {
                                    $('.alert-danger').css('display', 'none');
                                    $('.success-message').css('display', 'block');
                                    $('.success-message p').html('Brand Updated Successfully!');
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
            $('.modal .modal-body input[name="brand_name"]').focus();
            $('.update_brand_name').focus();
        }) 

    })
</script>

@stop