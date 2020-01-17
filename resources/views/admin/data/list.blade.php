@section('title')
    List Data
@endsection
@extends('admin.main')
@section('content')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.data.list')}}">Data</a>
            </li>
            <li class="breadcrumb-item active">List</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                List User Data</div>
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
                            {{--<th>ID</th>--}}
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>No Telepon</th>
                            <th>Gender</th>
                            <th>Foto</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $items)
                            <tr>
                                {{--<td>{{$items['id']}}</td>--}}
                                <td>{{$items['name']}}</td>
                                <td>{{$items['email']}}</td>
                                <td>{{$items['date_of_birth']}}</td>
                                <td>{{$items['no_telp']}}</td>
                                <td>{{$items['gender']}}</td>
                                <td>{{$items['foto']}}</td>
                                <td>
                                    <a href="{{ route('admin.data.edit',$items['id']) }}" class="btn btn-default"><icon class="icon-plus"> Edit</icon></a>
                                    <a href="{{ route('admin.data.delete',$items['id']) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><icon class="icon-plus"> Delete</icon></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group padding-t-10 pull-right">
                        <a href="{{ route('admin.data.add') }}" class="btn btn-success"><icon class="icon-plus"> Add Data</icon></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
