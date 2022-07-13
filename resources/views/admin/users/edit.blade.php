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
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.saveUser') }}" method="post" id="userForm"> 
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="box-body">
                            <div class= "form-group" >
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" value="{{$user->first_name}}" placeholder="First Name">
                                    @if ($errors->has('first_name'))
                                        <label for="first_name" class="error">{{ $errors->first('first_name') }}</span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" value="{{$user->last_name}}" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <label for="last_name" class="error">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" readonly value="{{$user->email}}" placeholder="Email Address">
                                @if ($errors->has('email'))
                                    <label for="email" class="error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_active" id="inputBasicActive" value="1" @if($user->is_active) checked @endif> Active
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_active" id="inputBasicInctive" value="0" @if(!$user->is_active) checked @endif> Inactive                                    
                                    </label>
                                </div> 
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
                }
            },
            messages: {
                first_name: {
                    required: 'The first name field is required.'
                },
                last_name: {
                    required: 'The last name field is required.'
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    });
</script>
@endsection

