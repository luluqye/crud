@section('title')
    List Data
@endsection
@extends('admin.main')
@section('content')
    @if(@$data['status']=="edit")
        @php($action=route('admin.data.update',array($data['id'])))
        @php($status="Update")
        @php($status_header="Edit")
    @else
        @php($action=route('admin.data.insert'))
        @php($status="Save")
        @php($status_header="Add")
    @endif

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.data.list')}}">Data</a>
            </li>
            <li class="breadcrumb-item active">List</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                {{$status_header}} Data</div>
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
                        <label class="control-label col-sm-2" for="date">Date Of Birth:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="date" id="date" value="{{(!empty(old('date')))?old('date'):@$data['date_of_birth']}}" placeholder="Enter date of birth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="no_telp">No Telp:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="no_telp" value="{{(!empty(old('no_telp')))?old('no_telp'):@$data['no_telp']}}" id="no_telp" placeholder="Enter no telp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sel1">Gender:</label>
                        <div class="col-sm-10">
                            <select name="gender" class="form-control" id="sel1" required>
                                <option value="">--Pilih Gender--</option>
                                <option value="male" {{(@$data['gender']=="male")?"selected":""}}>Male</option>
                                <option value="female" {{(@$data['gender']=="female")?"selected":""}}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="no_telp">Foto:</label>
                        <div class="col-sm-10 pb-2">
                            @if(!empty(@$data['foto']))
                                <img class="photo" width="250" height="250" id="img-foto"src="{{@$data['foto']}}">
                            @else
                                <img class="photo" width="250" height="250" id="img-foto"src="https://via.placeholder.com/250">
                            @endif
                        </div>
                        <div class="col-sm-10">
                            <input type="file" accept="image/x-png,image/jpeg" class="form-control" name="foto" value="{{ old('foto') }}" id="foto" onchange="document.getElementById('img-foto').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">{{$status}}</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </div>
@endsection
