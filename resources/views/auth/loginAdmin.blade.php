
<!doctype html>

<html
  lang="ar"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="rtl"
  data-theme="theme-semi-dark"
  data-assets-path="../../dashboard/assets/"
  data-template="vertical-menu-template"
  data-style="light">


 <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> تسجيل الدخول | Banking Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/assets/img/tanoor/brand3.png') }}"/>

    <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
     <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/fonts/fontawesome.css') }}" />
     <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/fonts/tabler-icons.css') }}" />
     <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/css/rtl/theme-semi-dark.css') }}" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/typeahead-js/typeahead.css') }}" />

  <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/pages/page-auth.css') }}" />


    <!-- Page CSS -->
     @yield('css')

    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="#" class="app-brand-link">
                   <img src="{{ asset('dashboard/assets/img/tanoor/brand3.png') }}" class="sign-favicon-b ht-40" height="80" alt="logo">
                </a>
              </div>
              <!-- /Logo -->

              <form action="{{ route('Admin.login') }}" method="POST" class="space-y-6">
                @csrf
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email"
                    placeholder="Enter your email" autofocus />

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password"  id="password" class="form-control" name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-6">
                  <button class="btn btn-warning d-grid w-100" type="submit">تسجيل دخول</button>
                </div>
              </form>


            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/pages-auth.js') }}"></script>

  </body>
</html>
