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
            <li class="active"><a href="#"><i class="fa fa-trophy"></i>Leagues</a></li>
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
                                <a class="btn btn-primary btn-flat" href="javascript:void(0)" id="create-new-league">Add League</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="leagues-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>League</th>
                                    <th>Country</th>
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
                                                                                                         
        <div class="modal fade" id="league-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="league-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="league-form" name="league-form">

    	                        <div class="alert alert-danger" style="display:none"></div>

                                <input type="hidden" name="league_id" id="league_id">

                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="" id="loading">Loading...</option>
                                    </select>
                                </div>

                                <div class="form-group has-feedback">
                                    <label>League</label>
                                    <input type="text" class="form-control" placeholder="League Name" name="name"
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
    var countries; 
    $(document).ready(function(){
        var leaguesTable = $('#leagues-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('leagues.index') }}",
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
                    data:'league_name',
                    name:'league_name'
                },
                {
                    data:'country',
                    name:'country'
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

        /* Fetch all countries */
        $.ajax({
            url: "{{route('countries.getData')}}",
            type: "get",
            dataType: 'json',
            success: function(data){
                countries = data;
                $.each(data,function(index,data){
                    $("#country").append($("<option></option>").attr("value", data.id).text(data.name));
                });
                // Change the text of the default "loading" option
                $('#loading').text('Select Country Name');
            }
        });
    });

        /* Create league */
        $('#create-new-league').click(function() {
            $('#saveBtn').val("create-league");
            $('#league_id').val('');
            $('#league-form').trigger("reset");
            $('#league-modal-heading').html("Add New League");
            $('#league-modal').modal('show');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
        });

        /* Edit league */
        $('body').on('click', '.editLeague', function () {
            var league_id = $(this).data('id');         
            $.ajax({
                data: {league_id:league_id},
                url: "{{route('leagues.edit')}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#league-modal-heading').html("Edit League");
                    $('#saveBtn').val("edit-league");
                    $('#league-modal').modal('show');
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('#league_id').val(data.id);
                    $('#name').val(data.name);   
                    // Set the league country in the select element
                    const leagueCountry = countries.find(country=>country.id === data.country_id);
                    document.getElementById('country').value=leagueCountry.id;
                },
                error: function (data) {
                    $('#errorDiv').append(data);
                }
            });
        });

        /* Save/Update League */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#league-form').serialize(),
                url: "{{route('leagues.store')}}",
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
                        $('#league-form').trigger("reset");
                        $('#league-modal').modal('hide');
                        // deselect all elements 
                        document.getElementById('country').selectedIndex = "-1"; 
                        $('#leagues-table').DataTable().draw();
                        toastr.success(data.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }); 

        /* Delete league */
        $('body').on('click', '.deleteLeague', function () {
            var league_id = $(this).data('id');
            if(confirm("This record will be lost forever! Proceed?")){
                $.ajax({
                    type: "post",
                    url: "{{ route('leagues.delete') }}",
                    data: {league_id:league_id},
                    success: function (data) {
                        $('#leagues-table').DataTable().draw();
                        if(data.success)
                  	    {
                            toastr.success(data.success);
                        }
                        if(data.errors)
                        {
                            toastr.error(data.errors);
                        }
                    },
                    error: function (errors) {
                        console.log('Error:', errors);
                    }
                });
            }
        });
    
</script>
@endsection