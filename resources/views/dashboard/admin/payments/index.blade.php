@extends('dashboard.layouts.master')
@section('title', 'المدفوعات')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header"> إدارة المدفوعات</h5>
                <div class="card-body">
                <div class="row g-6 mb-6">    
                 
                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-warning mb-2">
                      <i class="fas fa-file-invoice-dollar ti-lg"></i></div>
                      <h5 class="card-title mb-1">الفواتير</h5>
                      <p class="mb-0">عرض وإدارة فواتيرك</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6" >
                    <div class="card h-100 " style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-info mb-2">
                      <i class="fas fa-building ti-lg"></i></div>
                      <h5 class="card-title mb-1">المدفوعات الحكومية</h5>
                      <p class="mb-0">عرض وإدارة المدفوعات الحكومية</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-secondary mb-2">
                      <i class="fas fa-receipt  ti-lg"></i></div>
                      <h5 class="card-title mb-1">مدفوعات ايصال</h5>
                      <p class="mb-0">عرض وإدارة مدفوعات الإيصال</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center" >
                      <div class="badge rounded p-2 bg-label-success mb-2">
                      <i class="fas fa-tools ti-lg"></i></div>
                      <h5 class="card-title mb-1">عمليات الفواتير</h5>
                      <p class="mb-0">عرض وإدارة عمليات الفواتير</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-primary mb-2">
                      <i class="fas fa-money-bill-wave ti-lg"></i></div>
                      <h5 class="card-title mb-1">سداد الفواتير</h5>
                      <p class="mb-0"> سداد فاتورة لمرة واحدة</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-danger mb-2">
                      <i class="fas fa-file-invoice  ti-lg"></i></div>
                      <h5 class="card-title mb-1">تقسيم الفواتير</h5>
                      <p class="mb-0">ادفع وشارك في الدفع</p>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-info mb-2">
                      <i class="fas fa-wifi ti-lg"></i></div>
                        <h5 class="card-title mb-1">شركات الاتصالات</h5>
                        <p class="mb-0">عرض وإدارة مدفوعات شركات الاتصالات</p>
                      </div>
                     </div>
                    </div>

                    <div class="col-lg-3 col-6" >
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-secondary mb-2">
                      <i class="fas fa-calendar-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1"> الفواتير المجدولة</h5>
                      <p class="mb-0">عرض وإدارة الفواتير المجدولة</p>
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
