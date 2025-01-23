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
                          <small>Multikart Admin panel</small>
                      </h3>
                  </div>
              </div>
              <div class="col-lg-6">
                  <ol class="breadcrumb pull-right">
                      <li class="breadcrumb-item">
                          <a href="index.html">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                              </svg>
                          </a>
                      </li>
                      <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row">
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="warning-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation font-warning">
                                      <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                  </svg>
                              </div>
                          </div>
                          <div class="media-body media-doller">
                              <span class="m-0">Earnings</span>
                              <h3 class="mb-0">$ <span class="counter">665</span><small> This
                                      Month</small>
                              </h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="secondary-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box font-secondary">
                                      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                      <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                      <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                  </svg>
                              </div>
                          </div>
                          <div class="media-body media-doller">
                              <span class="m-0">Products</span>
                              <h3 class="mb-0">$ <span class="counter">985</span><small> This
                                      Month</small>
                              </h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="primary-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square font-primary">
                                      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                  </svg></div>
                          </div>
                          <div class="media-body media-doller"><span class="m-0">Messages</span>
                              <h3 class="mb-0">$ <span class="counter">893</span><small> This
                                      Month</small></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="danger-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-danger">
                                      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                      <circle cx="9" cy="7" r="4"></circle>
                                      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  </svg></div>
                          </div>
                          <div class="media-body media-doller"><span class="m-0">New Vendors</span>
                              <h3 class="mb-0">$ <span class="counter">563</span><small> This
                                      Month</small></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection
