@section('title')
    List Account
@endsection
@extends('admin.main')
@section('content')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.account.list')}}">Account</a>
            </li>
            <li class="breadcrumb-item active">List</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                List User Account</div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $account)
                            <tr>
                                <td>{{$account['id']}}</td>
                                <td>{{$account['name']}}</td>
                                <td>{{$account['email']}}</td>
                                <td>{{$account['created_at']}}</td>
                                <td>
                                    <a href="{{ route('admin.account.edit',$account['id']) }}" class="btn btn-default"><icon class="icon-plus"> Edit</icon></a>
                                    <a href="{{ route('admin.account.delete',$account['id']) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><icon class="icon-plus"> Delete</icon></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group padding-t-10 pull-right">
                        <a href="{{ route('admin.account.add') }}" class="btn btn-success"><icon class="icon-plus"> Add Account</icon></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
