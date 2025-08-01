@extends('dashboard.layouts.master')
@section('title', 'الاستثمارات')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header"> إدارة الاستثمارات</h5>
                <div class="card-body">
                <div class="row g-6 mb-6">    
                 
                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-success mb-2">
                      <i class="fas fa-money-bill-wave ti-lg"></i></div>
                      <h5 class="card-title mb-1">حساب العوائد</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6" >
                    <div class="card h-100 " style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-primary mb-2">
                      <i class="fas fa-calendar-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">حساب  المستقبل</h5>
                     </div>
                    </div>
                  </div>

             


                  </div>

                  
                </div>
        </div>
    <!--/ Select -->
</div>

@endsection

@section('js')

    <script src="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>

@endsection
