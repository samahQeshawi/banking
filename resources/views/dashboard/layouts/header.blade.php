   <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                   
                  <span class="d-none d-md-inline-block text-muted fw-normal">لوحة التحكم</span>
                  
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      @php $user = Auth::guard('admin')->user()  @endphp
                      <img src="{{ $user->img_url ? asset($user->img_url) : asset('dashboard/assets/img/tanoor/brand3.png') }}" alt class="rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item mt-0" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              @php $user = Auth::guard('admin')->user()  @endphp
                              <img src="{{ $user->img_url ? asset($user->img_url) : asset('dashboard/assets/img/tanoor/brand3.png') }}" alt class="rounded-circle" />

                            </div>
                          </div>
                          <div class="flex-grow-1">
                          
                            <h6 class="mb-0">{{ Auth::guard('admin')->user()->name }}</h6>
        
                          <small class="text-muted">مرحبا بك في لوحة التحكم</small>
                          </small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                      
                        <li>
                          <a class="dropdown-item" href="{{route('admin.profile.show')}}">
                            <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">الملف الشخصي</span>
                          </a>
                        </li>
                     

{{--                    <li>--}}
{{--                      <a class="dropdown-item" href="pages-account-settings-account.html">--}}
{{--                        <i class="ti ti-settings me-3 ti-md"></i><span class="align-middle">الاعدادات</span>--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
                      <div class="d-grid px-2 pt-2 pb-1">
                      <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger d-flex" type="submit" >
                          <small class="align-middle">Logout</small>
                          <i class="ti ti-logout ms-2 ti-14px"></i>
                        </button>
                        </form>


                      </div>
                    </li>

                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>


          </nav>

          <!-- / Navbar -->
