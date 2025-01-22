@extends('layouts.app')

@section('cxmTitle', 'Roles')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Roles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Roles</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            @can('Role create')
              <h5 class="card-title" style="text-align:right;">
                <a href="{{route('admin.roles.create')}}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Role</a> 
              </h5>
            @endcan  

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width:200px;">Role Name</th>
                    <th scope="col">Permissions</th>
                    <th scope="col" style="width:200px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @can('Role access')
                  @foreach($roles as $role)
                    <tr>
                      <th scope="row">{{ $role->id }}</th>
                      <td>{{ $role->name }}</td>
                      <td>
                        @foreach($role->permissions as $permission)
                          <span class="badge rounded-pill bg-primary">{{ $permission->name }}</span>
                        @endforeach
                      </td>
                      <td>
                        @can('Role edit')
                          <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                        @endcan

                        @can('Role delete')
                          <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                          </form>
                        @endcan
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
    </section>
</main><!-- End #main -->
@endsection
