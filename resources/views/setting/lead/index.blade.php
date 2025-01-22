@extends('layouts.app')

@section('cxmTitle', 'Leads')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Leads Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Leads</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            @can('Lead create')
              <h5 class="card-title" style="text-align:right;">
                <a href="{{ route('admin.leads.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Lead</a> 
              </h5>
            @endcan  

              <!-- Default Table -->
              <table class="table" id="LeadTable">
                <thead>
                  <tr>
                    <th scope="col" style="width:50px;">ID #</th>
                    <th scope="col" style="width:200px;">Brand</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Date</th>
                    <th scope="col">Platform</th>
                    <th scope="col">Assing Lead</th>
                    <th scope="col">Value</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:200px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @can('Lead access')
                  @foreach($leads as $lead)
                    <tr>
                      <th scope="row">{{ $lead->id }}</th>
                      <td> 
                        <img src="{{$lead->brand->logo}}" width="100"><br>{{$lead->brand->name}}
                      </td>
                      <td>{{ $lead->name }}<br>
                          {{ $lead->email }}<br>
                          {{ $lead->phone }}
                      </td>
                      <td>
                          {{$lead->created_at->format('j F, Y')}}
                          <br>{{$lead->created_at->format('h:i:s A')}}
                          <br>{{$lead->created_at->diffForHumans()}}
                      </td>
                      <td>{{ $lead->platform }}</td>
                      <td>
                        @can('Lead assign')
                            <select class='assingUser' name="assingUser" data-cxm-lead-id="{{$lead->id}}">
                              <option value="">Select User</option>
                              @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ ($user->id == $lead->assing_user_id)  ? 'selected' : '' }} >{{ $user->name }}</option>
                              @endforeach    
                            </select>
                         @endcan
                      </td>
                      <td>${{ $lead->value }}</td>
                      <td>{{ $lead->status->status ?? 'None' }}</td>
                      <td>
                        @can('Lead edit')
                          <a href="{{ route('admin.leads.edit',$lead->id) }}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                        @endcan

                        @can('Lead delete')
                          <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="inline">
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
@push('cxmScripts')
    @include('setting.lead.script')
@endpush
