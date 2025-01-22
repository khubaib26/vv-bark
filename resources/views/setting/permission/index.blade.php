@extends('layouts.app')

@section('cxmTitle', 'Permission')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Permission</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Permission</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            @can('Permission create')
              <h5 class="card-title" style="text-align:right;">
                <a href="{{route('admin.permissions.create')}}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Permission</a> 
              </h5>
            @endcan  

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Permission Name</th>
                    <th scope="col" style="width:200px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @can('Permission access')
                  @foreach($permissions as $permission)
                    <tr>
                      <th scope="row">{{ $permission->id }}</th>
                      <td>{{ $permission->name }}</td>
                      <td>
                        @can('Permission edit')
                          <a href="{{route('admin.permissions.edit',$permission->id)}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                        @endcan

                        @can('Permission delete')
                          <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="inline">
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
