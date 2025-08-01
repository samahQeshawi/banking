@extends('dashboard.layouts.master') 
@section('title', 'Banking App | لوحة الادارة')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('content')
           <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row g-6">

                <!-- Card Border Shadow -->
                <div class="col-lg-3 col-sm-6">
                  <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-primary"
                            ><i class="ti ti-users ti-28px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">42</h4>
                      </div>
                      <p class="mb-1">عدد المفوضين</p>
                      <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+18.2%</span>
                        <small class="text-muted">than last week</small>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-warning"
                            ><i class="ti ti-bill ti-28px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">8</h4>
                      </div>
                      <p class="mb-1">عدد التحويلات</p>
                      <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-8.7%</span>
                        <small class="text-muted">than last week</small>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-danger"
                            ><i class="ti ti-git-fork ti-28px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">27</h4>
                      </div>
                      <p class="mb-1">عدد الاستثمارات</p>
                      <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+4.3%</span>
                        <small class="text-muted">than last week</small>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-info">
                          <i class="ti ti-briefcase ti-28px"></i></span>
                        </div>
                        <h4 class="mb-0">13</h4>
                      </div>
                      <p class="mb-1">اجمالي القروض  </p>
                      <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-2.5%</span>
                        <small class="text-muted">than last week</small>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/ Card Border Shadow -->

                                 <!-- Earning Reports -->
                <div class="col-lg-6">
                  <div class="card h-100">
                    <div class="card-header pb-0 d-flex justify-content-between">
                      <div class="card-title mb-0">
                        <h5 class="mb-1">Earning Reports</h5>
                        <p class="card-subtitle">Weekly Earnings Overview</p>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                          type="button"
                          id="earningReportsId"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row align-items-center g-md-8">
                        <div class="col-12 col-md-5 d-flex flex-column">
                          <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                            <h2 class="mb-0">$468</h2>
                            <div class="badge rounded bg-label-success">+4.2%</div>
                          </div>
                          <small class="text-body">You informed of this week compared to last week</small>
                        </div>
                        <div class="col-12 col-md-7 ps-xl-8">
                          <div id="weeklyEarningReports"></div>
                        </div>
                      </div>
                      <div class="border rounded p-5 mt-5">
                        <div class="row gap-4 gap-sm-0">
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-primary p-1">
                                <i class="ti ti-currency-dollar ti-sm"></i>
                              </div>
                              <h6 class="mb-0 fw-normal">Earnings</h6>
                            </div>
                            <h4 class="my-2">$545.69</h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 65%"
                                aria-valuenow="65"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                              <h6 class="mb-0 fw-normal">Profit</h6>
                            </div>
                            <h4 class="my-2">$256.34</h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: 50%"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-danger p-1">
                                <i class="ti ti-brand-paypal ti-sm"></i>
                              </div>
                              <h6 class="mb-0 fw-normal">Expense</h6>
                            </div>
                            <h4 class="my-2">$74.19</h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar bg-danger"
                                role="progressbar"
                                style="width: 65%"
                                aria-valuenow="65"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Earning Reports -->

                <!-- Support Tracker -->
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title mb-0">
                        <h5 class="mb-1">Support Tracker</h5>
                        <p class="card-subtitle">Last 7 Days</p>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                          type="button"
                          id="supportTrackerMenu"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body row">
                      <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                          <h2 class="mb-0">164</h2>
                          <p class="mb-0">Total Tickets</p>
                        </div>
                        <ul class="p-0 m-0">
                          <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                            <div class="badge rounded bg-label-primary p-1_5"><i class="ti ti-ticket ti-md"></i></div>
                            <div>
                              <h6 class="mb-0 text-nowrap">New Tickets</h6>
                              <small class="text-muted">142</small>
                            </div>
                          </li>
                          <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                            <div class="badge rounded bg-label-info p-1_5">
                              <i class="ti ti-circle-check ti-md"></i>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                              <small class="text-muted">28</small>
                            </div>
                          </li>
                          <li class="d-flex gap-4 align-items-center pb-1">
                            <div class="badge rounded bg-label-warning p-1_5"><i class="ti ti-clock ti-md"></i></div>
                            <div>
                              <h6 class="mb-0 text-nowrap">Response Time</h6>
                              <small class="text-muted">1 Day</small>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                        <div id="supportTracker"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Support Tracker -->

                

            </div>
            <!-- / Content -->
@endsection

@section('vendor-js')
    <script src="{{ asset('dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>
@endsection
