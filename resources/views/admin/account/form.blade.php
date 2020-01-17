@section('title')
    List Account
@endsection
@extends('admin.main')
@section('content')
    @if(@$data['status']=="edit")
        @php($action=route('admin.account.update',array($data['id'])))
        @php($status="Update")
        @php($status_header="Edit")
    @else
        @php($action=route('admin.account.insert'))
        @php($status="Save")
        @php($status_header="Add")
    @endif

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.account.list')}}">Account</a>
            </li>
            <li class="breadcrumb-item active">List</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                {{$status_header}} Account</div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="POST" action="{{$action}}"  class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nik">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{(!empty(old('name')))?old('name'):@$data['name']}}" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nik">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{(!empty(old('email')))?old('email'):@$data['email']}}" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd2">Confirm Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" placeholder="Enter password confirmation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">{{$status}}</button>
                        </div>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </div>
@endsection
