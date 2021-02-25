@extends('dashboard.layouts.master')
@section('content')
    
    <style>
        .bordered-inputs {
            border: 1px solid #3c8dbc;
            box-shadow: 0 -1px 4px 1px #3c8dbc inset;
        }

        .item-table {
            opacity: 0;
        }
    </style>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Stock Overview</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            
            <i class="fa fa-stack-overflow"></i>
            <h3 class="box-title">Stock Overview</h3>
            
            <form method="POST" id="search-item">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Items" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search For Item</button>
                    </div>
                </div>
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <div class="alert alert-danger" style="display: none">
                    <p class=""></p>
                </div>
            </form>

        </div><!-- /.box-header -->
        
        <div class="box-body">
                
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="item id">Item ID #</label>
                            <input type="text" name="item_id" class="item_id form-control">
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descriptipn">Item Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover item-table">
                            <tr>
                                <th>Branch Name</th>
                                <th>Description</th>
                                <th>Stock Amount</th>
                            </tr>
    
                            <tr>
                                <td class="first-td"></td>
                                <td class="second-td"></td>
                                <td class="third-td"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

    

    <script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            // Add Model 
            $('#search-item').submit( function(event) {
                event.preventDefault();
        
                product_id = $('.box .box-header input[name="search"]').val().trim();

                if(product_id == '') {
                    $('.alert-danger').css('display', 'block');
                    $('.alert-danger p').html('Please Enter Product ID!');
                } else {

                    let item_input = document.querySelector('.item_id');
                    let description = document.querySelector('.description');

                    let table = document.querySelector('.item-table');
                    let first_td = document.querySelector('.first-td');
                    let second_td = document.querySelector('.second-td');
                    let third_td = document.querySelector('.third-td');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: '{{route("dashboard.search-item")}}',
                        data: { product_id: product_id },
                        success: function(response) {
                            if(response.message == 'No Item Found With this ID!') {
                                $('.success-message').css('display', 'none');
                                $('.alert-danger').css('display', 'block');
                                $('.alert-danger p').html('No Item Found With this ID!');
                            } else {
                                $('.alert-danger').css('display', 'none');
                                item_input.value = response.product_id;
                                description.innerText = response.describtion;

                                // set table TDs
                                first_td.innerText = response.branch_name['branch_name'];
                                second_td.innerText = response.describtion;
                                third_td.innerText = response.amount;

                                setTimeout(function() {
                                    item_input.classList.add('bordered-inputs');
                                    description.classList.add('bordered-inputs');
                                    table.classList.add('bordered-inputs');
                                    table.style.opacity = '1';
                                }, 200)
                            }
                            
                        },

                    });
                }
                
            });
        });

   </script>

@stop