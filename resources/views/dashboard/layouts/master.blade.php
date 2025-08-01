<!doctype html>

<html
  lang="ar"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="rtl"
  data-theme="theme-semi-dark"
  data-assets-path="../../dashboard/assets/"
  data-template="vertical-menu-template"
  data-style="light">

    @include('dashboard.layouts.head')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('dashboard.layouts.sidebarAdmin')

        <!-- Layout container -->
        <div class="layout-page">
           @include('dashboard.layouts.header')

          <!-- Content wrapper -->
          <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Content -->

                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @elseif(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif

                   @yield('content')
            <!-- / Content -->
                   @yield('modal')
              </div>
          </div>

            @include('dashboard.layouts.footer')

            <div class="content-backdrop fade"></div>

          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

   @include('dashboard.layouts.scripts')
  </body>
</html>



