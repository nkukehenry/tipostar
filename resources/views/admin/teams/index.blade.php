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
            <li class="active"><a href="#"><i class="fa fa-users"></i>Teams</a></li>
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
                                <a class="btn btn-primary btn-flat" href="javascript:void(0)" id="create-new-team">Add Team</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="teams-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Team</th>
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
                                                                                                         
        <div class="modal fade" id="team-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="team-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="team-form" name="team-form">

    	                        <div class="alert alert-danger" style="display:none"></div>

                                <input type="hidden" name="team_id" id="team_id">

                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="" id="loading-country">Loading...</option>
                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Team</label>
                                    <input type="text" class="form-control" placeholder="Team Name" name="name"
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
    var leagues;
     $(document).ready(function(){
        var teamsTable = $('#teams-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('teams.index') }}",
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
                    data:'team_name',
                    name:'team_name'
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
                $('#loading-country').text('Select Country Name');
            }
        });

         /* Fetch all leagues */
        $.ajax({
            url: "{{route('leagues.getData')}}",
            type: "get",
            dataType: 'json',
            success: function(data){
                leagues = data;
            }
        });
    });


    /*Fetch all leagues under country*/
    function getLeagueUnderCountry()
    {
        $(".leagueSelectOptions").remove();
        var countryId = jQuery('#country').val();
        console.log(countryId);
        $.ajax({
            data:{countryId:countryId},
            url: "{{route('leagues.leagueCountry')}}",
            type: "GET",
            dataType: 'json',
            success: function(data){
                console.log(data);
                $.each(data,function(index,data){
                    $("#league").append($('<option class="leagueSelectOptions"></option>').attr("value", data.id).text(data.name));
                }); 
                 // Change the text of the default "loading" option
                $('#loading-league').text('Select League Name');
            },
            error: function(data){}
        });
    }
    jQuery('select[name="country"]').change(getLeagueUnderCountry);


    /* Create team */
    $('#create-new-team').click(function() {
        $('#saveBtn').val("create-team");
        $('#team-form').trigger("reset");
        $('#team_id').val('');
        $('#team-modal-heading').html("Add Team");
        $('#team-modal').modal('show');
        $('.alert-danger').html('');
        $('.alert-danger').hide();
    });   

        /* Edit team */
        $('body').on('click', '.editTeam', function () {
            var team_id = $(this).data('id');         
            $.ajax({
                data: {team_id:team_id},
                url: "{{route('teams.edit')}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#team-modal-heading').html("Edit Team");
                    $('#saveBtn').val("edit-team");
                    $('#team-modal').modal('show');
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('#team_id').val(data.id);
                    $('#name').val(data.name); 
  
                    // League of the team
                    //const teamLeague = leagues.find(league=>league.id === data.league_id); 
                    //var leagueCountryId = teamLeague.country_id;
                    // Country of the League of the team
                    //const leagueCountry = countries.find(country=>country.id === leagueCountryId);
                    /* Set the team league and country in the select elements */
                    //document.getElementById('country').value=leagueCountry.id;
                    //document.getElementById('league').value=teamLeague.id;
                },
                error: function (data) {
                    $('#errorDiv').append(data);
                }
            });
        });


        /* Save/Update Team */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#team-form').serialize(),
                url: "{{route('teams.store')}}",
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
                        $('#team-form').trigger("reset");
                        $(".leagueSelectOptions").remove();
                        $('#team-modal').modal('hide');
                        // deselect all elements 
                        document.getElementById('country').selectedIndex = "-1"; 
                        document.getElementById('league').selectedIndex = "-1"; 
                        $('#teams-table').DataTable().draw();
                        toastr.success(data.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);                
                }
            });
        }); 


        /* Delete team */
        $('body').on('click', '.deleteTeam', function () {
            var team_id = $(this).data('id');
            if(confirm("This record will be lost forever! Proceed?")){
                $.ajax({
                    type: "POST",
                    url: "{{ route('teams.delete') }}",
                    data: {team_id:team_id},
                    success: function (data) { 
                        $('#teams-table').DataTable().draw();
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