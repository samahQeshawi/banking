@extends('dashboard.layouts.master')
@section('title', 'التفاويض')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header">قائمة التفاويض</h5>
                <div class="card-body">
                  

                </div>

                <div class="card-datatable table-responsive pt-0">

                    {{$dataTable->table()}}

                </div>
        </div>
    <!--/ Select -->
</div>

@endsection

@section('modals')

    <!-- Modal -->
<div class="modal fade" id="transferDetailsModal" tabindex="-1" aria-labelledby="transferDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferDetailsModalLabel">تفاصيل التفويض</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body" id="transferDetailsContent">
        <!-- سيتم تحميل المحتوى هنا -->
        <div class="text-center">جارٍ التحميل...</div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('js')

    <script src="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>

    {{$dataTable->scripts()}}
    {{ $script ?? '' }}

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.show-transfer-details').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                const contentContainer = document.getElementById('transferDetailsContent');

                contentContainer.innerHTML = '<div class="text-center">جارٍ التحميل...</div>';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        contentContainer.innerHTML = html;
                    })
                    .catch(error => {
                        contentContainer.innerHTML = '<div class="text-danger">حدث خطأ أثناء تحميل التفاصيل.</div>';
                    });
            });
        });
    });
</script>


@endsection
