@extends('dashboard.layouts.master')
@section('title', 'البطاقات')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header"> إدارة البطاقات</h5>
                <div class="card-body">
                <div class="row g-6 mb-6">    
                 
                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-primary mb-2">
                      <i class="fas fa-piggy-bank ti-lg"></i></div>
                      <h5 class="card-title mb-1">الادخار الذكي</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6" >
                    <div class="card h-100 " style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-secondary mb-2">
                      <i class="fas fa-list-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">متابعة الطلبات</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-success mb-2">
                      <i class="fas fa-hand-holding-usd  ti-lg"></i></div>
                      <h5 class="card-title mb-1">تساهيل</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center" >
                      <div class="badge rounded p-2 bg-label-info mb-2">
                      <i class="fas fa-cogs ti-lg"></i></div>
                      <h5 class="card-title mb-1">التحكم بالبطاقات</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-success mb-2">
                      <i class="fas fa-money-check-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">الدفع التلقائي</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-warning mb-2">
                      <i class="fas fa-file-invoice  ti-lg"></i></div>
                      <h5 class="card-title mb-1">كشف الحسابات</h5>
                     </div>
                    </div>
                  </div>


                    <div class="col-lg-3 col-6" >
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-danger mb-2">
                      <i class="fas fa-edit ti-lg"></i></div>
                      <h5 class="card-title mb-1">  تغيير الحد الانتمائي </h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-primary mb-2">
                      <i class="fas fa-users  ti-lg"></i></div>
                      <h5 class="card-title mb-1">بطاقات العمالة المنزلية</h5>
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
