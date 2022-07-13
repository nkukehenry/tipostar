@extends('layouts.backend.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Tipsters
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
          
             <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-users"></i>Tipsters</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                  
                    <div class="box-body">
                        <table id="teams-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                    <th>Tips</th>
                                    <th>Subscribers</th>
                                    <th>Accuracy</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- append datatable -->
                                @foreach($tipsters as $row)

                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->since }}</td>
                                        <td>{{ $row->tips_count }}</td>
                                        <td>{{ $row->subscribers }}</td>
                                        <td>{{ $row->win_rate }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

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
    </section>

</div>
      
@endsection