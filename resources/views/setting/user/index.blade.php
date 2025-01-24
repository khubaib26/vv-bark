@extends('layouts.app')

@section('header')
@include('layouts.includes.header')
@endsection

@section('sidebar')
@include('layouts.includes.sidebar')
@endsection

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Dashboard
                    </h3>
                </div>
                <li class="breadcrumb-item">Permissions</li>
                <li class="breadcrumb-item active">List</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('User create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.users.create')}}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New User</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table" id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Pseudonym</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Role</th>
                                <th>Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('User access')
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->pseudonym }}</td>
                                <td>{{ $user->designation }}</td>
                                <td>{{ $user->email }}<br>{{ $user->phone }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                    <span class="badge rounded-pill bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>

                                    <div class="form-check form-switch">
                                        <input data-id="{{$user->id}}" type="checkbox" class="form-check-input toggle-class" style="height: 20px; width:3em;" id="customSwitch{{$user->id}}" {{ $user->active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch{{$user->id}}"></label>
                                    </div>

                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                    @can('User edit')
                                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                    @endcan

                                    @can('User delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endcan
                                </div>
                                </td>
                            </tr>
                            @endforeach
                            @endcan
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('cxmScripts')
@include('setting.user.script')
@endpush
