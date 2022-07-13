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
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{route('admin.users')}}"><i class="fa fa-user"></i> Manage Users</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.saveUser') }}" method="post" id="userForm"> 
                        @csrf
                        <input type="text" name="user_id" id="user_id" value="{{$user ? $user->id : ''}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                         
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                           
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            </div>
                            {{-- <div class="form-group">
                                <label>Role</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="inputCheckboxUser" name="roles[]" value="3"
                                            @if($user->id && $user->hasRole(['user'])) checked @endif> User
                                    </label>
                                    <label>
                                        <input type="checkbox" id="inputCheckboxAdministrator" name="roles[]" value="2"
                                            @if($user->id && $user->hasRole(['administrator'])) checked @endif> Administrator
                                    </label>
                                     <div id="role-div-error">
                                        @if ($errors->has('roles'))
                                            <label class="error">{{ $errors->first('roles') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        {{-- @if($user)
                                           <input type="radio" name="is_active" id="inputBasicActive" value="1"> Active
                                        @endif --}}
                                        {{-- <input type="radio" name="is_active" id="inputBasicActive" value="1"
                                            @if($user->id && $user->is_active) checked @endif> Active --}}
                                    </label>
                                </div>
                                {{-- <div class="radio">
                                    <label>
                                        @if(!isset($user))
                                           <input type="radio" name="is_active" id="inputBasicInctive" value="0" checked> Inactive
                                        @endif
                                        @if(isset($user))
                                            <input type="radio" name="is_active" id="inputBasicInctive" value="0"
                                                @if($user->id && !$user->is_active) checked @endif> Inactive
                                        @endif
                                    </label>
                                </div>  --}}
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /. Main content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('javascript')
<script type="text/javascript">
   $(document).ready(function()
    { 
        $("#userForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                @if(!$user->id)
                email:{
                    required: true,
                    email:true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password:{
                    required: true,
                    minlength: 8
                },
                @endif
                "roles[]": {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: 'The first name field is required.'
                },
                last_name: {
                    required: 'The last name field is required.'
                },
                email: {
                    required: 'The email field is required.',
                    email: 'The email must be a valid email address.',
                    remote: 'The email has already been taken.'
                },
                password: {
                    required: 'The password field is required.',
                    minlength: 'The password must be at least 6 characters.'
                },
                "roles[]": {
                    required: 'The role field is required.'
                }
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") == "roles[]") {
                    error.appendTo("#role-div-error");
                }else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endsection

