@extends('layouts.app')

@section('cxmTitle', 'Brand Category')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Category</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            @can('Category create')
              <h5 class="card-title" style="text-align:right;">
                <a href="{{route('admin.categories.create')}}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Category</a> 
              </h5>
            @endcan  

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width:200px;">Category Name</th>
                    <th scope="col">No. of Brands</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:200px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @can('Category access')
                 @foreach($categories as $category)
                    <tr>
                      <th scope="row">{{ $category->id }}</th>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->brands->count()  }}  </td>
                      <td>
                            @if($category->publish)
                            <span class="badge rounded-pill bg-success">Publish</span>
                            @else
                            <span class="badge rounded-pill bg-danger">Draft</span>
                            @endif
                      </td>
                      <td>
                        @can('Category edit')
                          <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                        @endcan

                        @can('Category delete')
                          <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
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
