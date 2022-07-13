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
            <li class="active"><a href="#"><i class="fa fa-users"></i>Users</a></li>
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
                                <a class="btn btn-primary btn-flat" href="{{ route('admin.createUser') }}" id="createNewUser">Add User</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="users-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>country</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
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
                                                                                                         
        <div class="modal fade" id="modal-default" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-heading">Create new user</h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="user-form" name="user-form">
                                @csrf
                                <div id="errorDiv1"></div>

                                <input type="hidden" name="user_id" id="user_id">

                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="First name" name="first_name"
                                        id="first_name">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                        id="last_name">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
   $(document).ready(function()
    { 
        var usersTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users') }}",
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
                    data:'first_name',
                    name:'first_name'
                },
                {
                    data:'last_name',
                    name:'last_name'
                },
                {
                    data:'country',
                    name:'country'
                },
                {
                    data:'email',
                    name:'email'
                },
                {
                    data:'userRoles',
                    name:'userRoles'
                },
                {
                    data:'status',
                    name:'status'
                },
                {
                    data:'created_at',
                    name:'created_at'
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

        $('body').on('click', '.deleteUser', function () {
            var user_id = $(this).data('id');
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.deleteUser') }}",
                    data: {user_id:user_id},
                    success: function (data) {
                        usersTable.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        }); 
    });
</script>
@endsection

