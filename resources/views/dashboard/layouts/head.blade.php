<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/branding/brand-img-small.png') }}" />

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
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/toastr/toastr.css') }}" />


    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/@form-validation/form-validation.css') }}" />  --}}

    <!-- Page CSS -->
     @yield('css')
    {{--  <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/pages/app-logistics-dashboard.css') }}" />  --}}
    {{--  <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/pages/cards-advance.css') }}">  --}}
    <style>
        .datatable_img {
            border: 1px solid #dcdcdc;
            padding: 1px;
            border-radius: 100%;
            width: 55px;
            height: 55px;
            object-fit: contain;
        }
    </style>
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
{{--      <script src="{{ asset('dashboard/assets/vendor/js/template-customizer.js') }}"></script>--}}

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
  </head>
