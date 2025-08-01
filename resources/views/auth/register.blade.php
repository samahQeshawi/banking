
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

    <title> تسجيل الدخول | Banking App</title>

    <meta name="description" content="" />

    <!-- Favicon -->
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/assets/img/branding/brand-img-small.png') }}"/>

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

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      <a href="index.html" class="app-brand auth-cover-brand">
        <span class="app-brand-logo demo">
          <img src="{{ asset('dashboard/assets/img/branding/brand-img-small.png') }}" class="sign-favicon-b ht-40" height="25" alt="logo">
        </span>
        <span class="app-brand-text demo text-heading fw-bold">Banking</span>
      </a>
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('dashboard/assets/img/illustrations/page-misc-under-maintenance.png') }}"
              alt="auth-register-cover"
              class="my-5 auth-illustration"/>

            <img
              src="{{ asset('dashboard/assets/img/illustrations/bg-shape-image-light.png') }}"
              alt="auth-register-cover"
              class="platform-bg"/>
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
          <div class="w-px-400 mx-auto mt-12 pt-5">
            <h4 class="mb-1">Start here  🚀</h4>
            <p class="mb-6">Make your app management easy and fun!</p>

            <form class="mb-6" action="{{ route('Admin.register') }}" method="POST">
            @csrf
              <div class="mb-6">
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Enter your username"
                  autofocus />
              </div>
              <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>

              <div class="mb-6 mt-8">
                <div class="form-check mb-8 ms-2">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{ route('auth.admin.login') }}">
                <span>Sign in instead</span>
              </a>
            </p>

            <div class="divider my-6">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                <i class="tf-icons ti ti-brand-facebook-filled"></i>
              </a>

              <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                <i class="tf-icons ti ti-brand-twitter-filled"></i>
              </a>

              <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                <i class="tf-icons ti ti-brand-github-filled"></i>
              </a>

              <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
                <i class="tf-icons ti ti-brand-google-filled"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /Register -->
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

    <!-- endbuild -->

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
