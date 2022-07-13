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
            <li class="active"><a href="#"><i class="fa fa-soccer-ball-o"></i>Matches</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <a class="btn btn-primary btn-flat btn-block" href="javascript:void(0)" id="create-new-match"><i class="fa fa-plus"></i> Match</a>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <button class="btn btn-primary btn-flat btn-block" id="supersingle"><i class="fa fa-gear"></i> Supersingle</button>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <button class="btn btn-primary btn-flat btn-block" id="multibet"><i class="fa fa-plus"></i> Multibet</button>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <button class="btn btn-primary btn-flat btn-block" id="maxstake"><i class="fa fa-plus"></i> Maxstake</button>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <button class="btn btn-danger btn-flat btn-block" id="delete-selected"><i class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="matches-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Match Day</th>
                                    <th>Game</th>
                                    <th>Odd Type</th>
                                    <th>Supersingle</th>
                                    <th>Outcome</th>
                                    <th>Tag</th>
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

        
        <div class="modal fade" id="matches-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="matches-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="match-form" name="match-form">

    	                        <div class="alert alert-danger" style="display:none"></div>

                                <input type="hidden" name="match_id" id="match_id">

                                 <div class="form-group new-match-fields">
                                    <label>Match Date and Time</label>
                                    <div class='input-group date' id='match-date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' name="match-date" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group new-match-fields">
                                    <label>Home League</label>
                                    <select class="form-control" name="home-league" id="home-league">
                                        <option value="" id="">Home Team League</option>
                                    </select>
                                </div>

                                <div class="form-group new-match-fields">
                                    <label>Home Team</label>
                                    <select class="form-control" name="home-team" id="home-team">
                                    </select>
                                </div>

                                 <div class="form-group new-match-fields">
                                    <label>Away League</label>
                                    <select class="form-control" name="away-league" id="away-league">
                                        <option value="" id="">Away Team League</option>
                                    </select>
                                </div>

                                <div class="form-group new-match-fields">
                                    <label>Away Team</label>
                                    <select class="form-control" name="away-team" id="away-team">
                                    </select>
                                </div>

                                 <div class="form-group new-match-fields">
                                    <label>Odd Type(s)</label>
                                    <select class="form-control select2" id="odds" name="odds[]" multiple="multiple" data-placeholder="Select odds"
                                            style="width: 100%;">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Outcome</label>
                                    <select class="form-control" name="outcome" id="outcome">
                                        <option value="In progress" id="">In progress</option>
                                        <option value="Lost" id="">Lost</option>
                                        <option value="Won" id="">Won</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Match Tag</label>
                                    <select class="form-control" name="tag" id="tag">
                                        <option value="Free" id="">Free</option>
                                        <option value="Premium" id="">Premium</option>
                                    </select>
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

    var matchesTable;

    $(document).ready(function(){
        //Date time picker
        $('#match-date').datetimepicker();

        //Initialize Select2 Elements
        $('.select2').select2()

        matchesTable = $('#matches-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('matches.index') }}",
            order: [[1, 'desc']],  
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                    'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            columns: [
                {
                    data:'id',
                    name:'id',
                },
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
                    data:'match_date',
                    name:'match_date'
                },
                {
                    data:'game',
                    name:'game'
                },
                {
                    data:'odd_type',
                    name:'odd_type'
                },
                {
                    data:'supersingle',
                    name:'supersingle'
                },
                {
                    data:'outcome',
                    name:'outcome'
                },
                {
                    data:'tag',
                    name:'tag'
                },
                {
                    data:'action',
                    name:'action',
                    orderable: false,
                    searchable: false
                } 
            ]
        }); 

     
        /* Fetch all leagues */
        $.ajax({
            url: "{{route('leagues.getData')}}",
            type: "get",
            dataType: 'json',
            success: function(data){
                $.each(data,function(index,data){
                    $("#home-league").append($("<option></option>").attr("value", data.id).text(data.name));
                    $("#away-league").append($("<option></option>").attr("value", data.id).text(data.name));
                });
            }
        });

        /* Fetch all odd types */
         $.ajax({
            url: "{{route('odds.getData')}}",
            type: "get",
            dataType: 'json',
            success: function(data){
                $.each(data,function(index,data){
                    $("#odds").append($('<option class="oddSelectOptions"></option>').attr("value", data.id).text(data.name));
                });
            }
        });
    });

    function ajaxCall(url)
    {
        var matches = [];
        var rows_selected = matchesTable.column(0).checkboxes.selected();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId){
            matches.push(rowId);
        });
        $.ajax({
            data:{matches:matches},
            url:url,
            type:'POST',
            daataType:'json',
            success: function(data){
                matchesTable.draw();
                data.success ? toastr.success(data.success) : toastr.error(data.errors);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    /*
    * Handle multibet, supersingle, maxstake create button
    */
    $('#multibet').click(function(){
        var url = "{{route('multibet.store')}}";
        ajaxCall(url);
    });
    $('#supersingle').click(function(){
        var url = "{{route('matches.makeSupersingle')}}";
        ajaxCall(url);
    });
    $('#maxstake').click(function(){
        var url = "{{route('maxstake.store')}}";
        ajaxCall(url);
    });
    $('#delete-selected').click(function(){
        var url = "{{route('matches.deleteSelected')}}";
        if(confirm("This records will be lost forever! Proceed?"))
        {
            ajaxCall(url);
        }
    });


    /* Fetch all teams under home league */
    function getHomeTeamUnderLeague()
    {
        $(".homeTeamSelectOptions").remove();
        var LeagueId = jQuery('#home-league').val();
        console.log(LeagueId);
        $.ajax({
            data:{LeagueId:LeagueId},
            url: "{{route('teams.teamLeague')}}",
            type: "GET",
            dataType: 'json',
            success: function(data){
                console.log(data);
                $.each(data,function(index,data){
                    $("#home-team").append($('<option class="homeTeamSelectOptions"></option>').attr("value", data.id).text(data.name));
                }); 
            },
            error: function(data){}  
        });
    }
    jQuery('select[name="home-league"]').change(getHomeTeamUnderLeague);


    /* Fetch all teams under away league */
    function getAwayTeamUnderLeague()
    {
        $(".awayTeamSelectOptions").remove();
        var LeagueId = jQuery('#away-league').val();
        console.log(LeagueId);
        $.ajax({
            data:{LeagueId:LeagueId},
            url: "{{route('teams.teamLeague')}}",
            type: "GET",
            dataType: 'json',
            success: function(data){
                console.log(data);
                $.each(data,function(index,data){
                    $("#away-team").append($('<option class="awayTeamSelectOptions"></option>').attr("value", data.id).text(data.name));
                }); 
            },
            error: function(data){}  
        });
    }
    jQuery('select[name="away-league"]').change(getAwayTeamUnderLeague);


        /* Create match */
        $('#create-new-match').click(function() {
            $('#saveBtn').val("create-match");
            $('#match_id').val('');
            $('#match-form').trigger("reset");
            $('#matches-modal-heading').html("Add New Match");
            $('#matches-modal').modal('show');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.new-match-fields').show();
            $(".homeTeamSelectOptions").remove();
            $(".awayTeamSelectOptions").remove();
        });

        /* Edit Match */
        $('body').on('click', '.editMatch', function () {
            var match_id = $(this).data('id');         
            $.ajax({
                data: {match_id:match_id},
                url: "{{route('matches.edit')}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#matches-modal-heading').html("Edit Match");
                    $('#saveBtn').val("edit-match");
                    $('#matches-modal').modal('show');
                    $('.new-match-fields').hide();
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('#match_id').val(data.id);
                    // Set the league country in the select element
                    {{-- const leagueCountry = countries.find(country=>country.id === data.country_id);
                    document.getElementById('country').value=leagueCountry.id; --}}
                },
                error: function (data) {
                    $('#errorDiv').append(data);
                }
            });
        });

        /* Save/Update Match */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#match-form').serialize(),
                url: "{{route('matches.store')}}",
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
                        $('#match-form').trigger("reset");
                        // deselect all elements
                        document.getElementById('home-league').selectedIndex = "0"; 
                        document.getElementById('away-league').selectedIndex = "0"; 

                        $(".homeTeamSelectOptions").remove();
                        $(".awayTeamSelectOptions").remove();
                        $('#matches-modal').modal('hide');
                        $('#matches-table').DataTable().draw();
                        toastr.success(data.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }); 

        /* Delete Match */
        $('body').on('click', '.deleteMatch', function () {
            var match_id = $(this).data('id');
            if(confirm("This record will be lost forever! Proceed?")){
                $.ajax({
                    type: "post",
                    url: "{{ route('matches.delete') }}",
                    data: {match_id:match_id},
                    success: function (data) {
                        $('#matches-table').DataTable().draw();
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