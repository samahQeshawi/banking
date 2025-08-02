@extends('dashboard.layouts.master')
@section('title', 'الحسابات')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />

@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header"> إدارة الحسابات</h5>
                <div class="card-body">
                <div class="row g-6 mb-6">    
                 
                  <div class="col-lg-3 col-6">
                    <button type="button" class="card h-100 w-100 text-start border-0 p-0" style="background-color: #f0f0f0;" data-bs-toggle="modal" data-bs-target="#transferModal">

                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-success mb-2">
                      <i class="fas fa-exchange-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">التحويل</h5>
                     </div>
                    </div>
                    </button>
                  </div>

                  <div class="col-lg-3 col-6" >
                    <div class="card h-100 " style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-secondary mb-2">
                      <i class="fas fa-file-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">المستندات</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-danger mb-2">
                      <i class="fas fa-percent  ti-lg"></i></div>
                      <h5 class="card-title mb-1">حساب العوائد</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center" >
                      <div class="badge rounded p-2 bg-label-primary mb-2">
                      <i class="fas fa-piggy-bank ti-lg"></i></div>
                      <h5 class="card-title mb-1">الادخار الذكي</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-warning mb-2">
                      <i class="fas fa-sync-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1">التحويل التلقائي</h5>
                     </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-info mb-2">
                      <i class="fas fa-university  ti-lg"></i></div>
                      <h5 class="card-title mb-1">المصرفية المفتوحة</h5>
                     </div>
                    </div>
                  </div>


                    <div class="col-lg-3 col-6" >
                    <div class="card h-100" style="background-color: #f0f0f0;">
                     <div class="card-body text-center">
                      <div class="badge rounded p-2 bg-label-dark mb-2">
                      <i class="fas fa-calendar-alt ti-lg"></i></div>
                      <h5 class="card-title mb-1"> حساب المستقبل </h5>
                     </div>
                    </div>
                  </div>
                  </div>

                  
                </div>
        </div>
    <!--/ Select -->
</div>

@endsection

@section('modal')
  @include('dashboard.admin.accounts.modals.transfer')
@endsection

@section('vendor-js')
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
@endsection
@section('js')

    <script src="{{ asset('dashboard/assets/js/modal-create-app.js') }}"></script>
@if ($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const transferModal = new bootstrap.Modal(document.getElementById('transferModal'));
      transferModal.show();

      const stepperEl = document.querySelector('#wizard-create-app');
      if (stepperEl) {
        // لا تكرر التهيئة إذا كانت موجودة مسبقاً
        if (!stepperEl.stepperInstance) {
          stepperEl.stepperInstance = new Stepper(stepperEl, {
            linear: false,
            animation: true
          });
        }

        // الانتقال للخطوة الأولى
        stepperEl.stepperInstance.to(1);
      }

      // ربط زر "التالي" يدوياً
      const nextBtns = document.querySelectorAll('.btn-next');
      nextBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (stepperEl && stepperEl.stepperInstance) {
            stepperEl.stepperInstance.next();
          }
        });
      });

      // ربط زر "السابق"
      const prevBtns = document.querySelectorAll('.btn-prev');
      prevBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (stepperEl && stepperEl.stepperInstance) {
            stepperEl.stepperInstance.previous();
          }
        });
      });
    });
  </script>
@endif

   <script>
  document.addEventListener('DOMContentLoaded', function () {
    const amountInput = document.getElementById('amount');
    const getAmount = document.getElementById('getAmount');

    if (amountInput && getAmount) {
      amountInput.addEventListener('input', function () {
        getAmount.innerHTML = amountInput.value + `
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1500 1500" width="16" height="16" class="ms-1">
            <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#231f20"/>
          </svg>
        `;
      });
    }
  });
</script>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.getElementById('phone');
        const getPhone = document.getElementById('getToAccount');

        if (phoneInput && getPhone) {
            phoneInput.addEventListener('input', function () {
                getPhone.textContent = phoneInput.value ; 
            });
        }
       });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById("reason");
        const output = document.getElementById("getReason");

        select.addEventListener("change", function () {
            const selectedOption = select.options[select.selectedIndex];
            output.textContent = selectedOption.text;
        });

        // إذا كنت تريد عرض الخيار المختار تلقائيًا عند تحميل الصفحة
        if (select.value) {
            const selectedOption = select.options[select.selectedIndex];
            output.textContent = selectedOption.text;
        }
    });
    </script>

    <script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalEl = document.getElementById('transferModal');

    if (modalEl) {
      modalEl.addEventListener('hidden.bs.modal', function () {
        // تفريغ جميع حقول الإدخال داخل المودال
        modalEl.querySelectorAll('input, select, textarea').forEach(function (input) {
          if (input.type === 'checkbox' || input.type === 'radio') {
            input.checked = false;
          } else {
            input.value = '';
          }
        });

        // إذا كنت تستخدم bs-stepper، أعد المودال للخطوة الأولى
        var stepperEl = document.querySelector('#wizard-create-app');
        if (stepperEl) {
          var stepper = new window.Stepper(stepperEl);
          stepper.to(1);
        }

        // إزالة رسائل الخطأ إن وجدت
        modalEl.querySelectorAll('.is-invalid').forEach(function (el) {
          el.classList.remove('is-invalid');
        });
        modalEl.querySelectorAll('.invalid-feedback').forEach(function (el) {
          el.remove();
        });
      });
    }
  });
</script>


@endsection
