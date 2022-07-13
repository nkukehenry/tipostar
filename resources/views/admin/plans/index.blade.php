@extends('layouts.backend.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-bar-chart"></i>Plans</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-2">
                                <a class="btn btn-primary btn-flat" href="javascript:void(0)" id="create-new-plan">Add Plan</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="plans-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Signup fee</th>
                                    <th>Currency</th>
                                    <th>Trial period days</th>
                                    <th>Invoice period days</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- append datatable -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
                                                                                                         
        <div class="modal fade" id="plans-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="plans-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="plans-form" name="plans-form">
    	                        <div class="alert alert-danger" style="display:none"></div>
                                <input type="hidden" name="plan_id" id="plan_id">

                                <div class="form-group has-feedback">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="description">Description:</label>
                                    <input type="text" class="form-control" placeholder="Description" name="description"
                                        id="description">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" placeholder="Price Eg 30.00" name="price"
                                        id="price">
                                </div>
                                 <div class="form-group has-feedback">
                                    <label for="invoice-days">Invoice days:</label>
                                    <input type="number" class="form-control" placeholder="Invoice period days Eg 7" name="invoice-days"
                                        id="invoice-days">
                                </div>
                                <div class="form-group" id="plan-status">
                                    <label>Status</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="active" value="1" checked> Active
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="inactive" value="0"> Inactive                                    
                                        </label>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-xs-8"></div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" id="saveBtn" value="create"
                                            class="btn btn-primary btn-block btn-flat">Save changes</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div>
                    <!-- /.register-box -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /. Main content -->
</div>
<!-- /.content-wrapper -->

@endsection


@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        var plansTable = $('#plans-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('plans.index') }}",
            columns: [
                {
                    data:'id', 
                    name:'id', 
                    'visible':false
                },
                {
                    data:'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false,
                    searchable: false
                },
                {
                    data:'name',
                    name:'name'
                },
                {
                    data:'description',
                    name:'description'
                },
                {
                    data:'status',
                    name:'status'
                },
                {
                    data:'price',
                    name:'price'
                },
                {
                    data:'signup_fee',
                    name:'signup_fee'
                },
                {
                    data:'currency',
                    name:'currency'
                },
                {
                    data:'trial_period',
                    name:'trial_period'
                },
                {
                    data:'invoice_period',
                    name:'invoice_period'
                },
                {
                    data:'action',
                    name:'action',
                    orderable: false,
                    searchable: false
                } 
            ],
            order: [[0, 'desc']]
        }); 
    });

    /* Create plans */
    $('#create-new-plan').click(function() {
        $('#plan_id').val('');
        $('#plans-form').trigger("reset");
        $('#plans-modal-heading').html("Add New Plan");
        $('#plans-modal').modal('show');
        $('.alert-danger').html('');
        $('.alert-danger').hide();
        $("#name").prop("readonly", false);
        $("#plan-status").show();
    });

    /* Edit Plans */
    $('body').on('click', '.editPlan', function () {
        var plan_id = $(this).data('id');         
        $.ajax({
            data: {plan_id:plan_id},
            url: "{{route('plans.edit')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $('#plans-modal-heading').html("Edit Plan");
                $('#plans-modal').modal('show');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('#plan_id').val(data.id);
                $('#name').val(data.name); 
                data.slug == 'basic' ? $("#name").prop("readonly", true): $("#name").prop("readonly", false)
                data.slug == 'basic' ? $("#plan-status").hide(): $("#plan-status").show()
                $('#description').val(data.description);   
                $('#price').val(data.price);
                $('#invoice-days').val(data.invoice_period);
                data.is_active === true ? $("#active").prop("checked", true) : $("#inactive").prop("checked", true)
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    /* Save/Update Plans */
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $.ajax({
            data: $('#plans-form').serialize(),
            url: "{{route('plans.store')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.errors)
                {
                    $('.alert-danger').html('');
                    $.each(data.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>'+value+'</li>');
                    });
                }
                else
                {
                    $('#plans-form').trigger("reset");
                    $('#plans-modal').modal('hide');
                    $('#plans-table').DataTable().draw();
                    toastr.success(data.success);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }); 

    /* Delete plans */
    $('body').on('click', '.deletePlan', function () {
        var plan_id = $(this).data('id');
        if(confirm("This record will be lost forever! Proceed?")){
            $.ajax({
                type: "post",
                url: "{{ route('plans.delete') }}",
                data: {plan_id:plan_id},
                success: function (data) {
                    $('#plans-table').DataTable().draw();
                    if(data.success)
                    {
                        toastr.success(data.success);
                    }
                    if(data.errors)
                    {
                        toastr.error(data.errors);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });


</script>
@endsection