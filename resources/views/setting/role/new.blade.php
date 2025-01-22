@extends('layouts.app')

@section('cxmTitle', 'New Roles')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Roles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Roles</li>
          <li class="breadcrumb-item active">New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Role</h5>
          
              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.roles.store')}}" novalidate>
              @csrf
              @method('post')
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">Role Name</label>
                  <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter role" class="form-control" id="validationCustom01"  required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-12">
                <label for="validationCustom01" class="form-label">Permissions</label>
                  <div class="form-check">
                  @foreach($permissions as $permission)
                    <div class="flex flex-col justify-cente">
                          <div class="flex flex-col">
                              <label class="inline-flex items-center mt-3">
                                  <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="permissions[]" value="{{$permission->id}}"
                                  ><span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                              </label>
                          </div>
                      </div>
                  @endforeach  
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>
        </div>
      </div>
    </section>
</main><!-- End #main -->
@endsection