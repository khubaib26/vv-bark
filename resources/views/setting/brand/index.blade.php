@extends('layouts.app')

@section('cxmTitle', 'Brand')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Brand Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Brand</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            @can('Brand create')
              <h5 class="card-title" style="text-align:right;">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Brand</a> 
              </h5>
            @endcan  

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" style="width:150px;">&nbsp;</th>
                    <th scope="col" style="width:300px;">Brand Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:200px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @can('Brand access')
                  @foreach($brands as $brand)
                    <tr>
                      <th scope="row"><img src="{{ $brand->logo }}" width="100"></th>
                      <td><a href="{{ $brand->brand_url }}" traget="_blank">{{ $brand->name }}</a></td>
                      <td>{{ $brand->category->name }}</td>
                      <td>
                            @if($brand->publish)
                            <span class="badge rounded-pill bg-success">Publish</span>
                            @else
                            <span class="badge rounded-pill bg-danger">Draft</span>
                            @endif
                      </td>
                      <td>
                        @can('Brand edit')
                          <a href="{{ route('admin.brands.edit',$brand->id) }}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                        @endcan

                        @can('Brand delete')
                          <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline">
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
