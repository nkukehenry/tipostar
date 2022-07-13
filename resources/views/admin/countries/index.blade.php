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
            <li class="active"><a href="#"><i class="fa fa-flag"></i>Countries</a></li>
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
                                <a class="btn btn-primary btn-flat" href="javascript:void(0)" id="create-new-country">Add Country</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="countries-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Name</th>
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
                                                                                                         
        <div class="modal fade" id="countries-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="countries-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="country-form" name="country-form">
    	                        <div class="alert alert-danger" style="display:none"></div>
                                <input type="hidden" name="country_id" id="country_id">

                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name">
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
        var countriesTable = $('#countries-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.countries') }}",
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
                    data:'country_name',
                    name:'country_name'
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

        /* Create country */
        $('#create-new-country').click(function() {
            $('#saveBtn').val("create-country");
            $('#country_id').val('');
            $('#country-form').trigger("reset");
            $('#countries-modal-heading').html("Add New Country");
            $('#countries-modal').modal('show');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
        });

        /* Edit country */
        $('body').on('click', '.editCountry', function () {
            var country_id = $(this).data('id');
            $.get('/admin/edit-country/' + country_id, function (data) {
                $('#countries-modal-heading').html("Edit Country");
                $('#saveBtn').val("edit-country");
                $('#countries-modal').modal('show');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('#country_id').val(data.id);
                $('#name').val(data.name);
            })
        });

        /* Save/Update country */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#country-form').serialize(),
                url: "{{route('admin.saveCountry')}}",
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
                        $('#country-form').trigger("reset");
                        $('#countries-modal').modal('hide');
                        $('#countries-table').DataTable().draw();                        
                        toastr.success(data.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }); 

        /* Delete country */
        $('body').on('click', '.deleteCountry', function () {
            var country_id = $(this).data('id');
            if(confirm("This record will be lost forever! Proceed?")){
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.deleteCountry') }}",
                    data: {country_id:country_id},
                    success: function (data) {
                        $('#countries-table').DataTable().draw();                        
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