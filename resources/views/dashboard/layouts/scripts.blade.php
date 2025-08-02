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
    <script src="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    @yield('vendor-js')
    <script src="{{ asset('dashboard/assets/vendor/libs/toastr/toastr.js') }}"></script>
        <!-- Flat Picker -->
    <script src="{{ asset('dashboard/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/chartjs/chartjs.js') }}"></script>


    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/extended-ui-drag-and-drop.js') }}"></script>


    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/ui-popover.js') }}"></script>
     <script src="{{ asset('dashboard/assets/js/ui-toasts.js') }}"></script>

    @yield('js')

    {{--  <script>
        $(document).ready(function() {

            $(document).on('click', '.status', function () {
                let url = $(this).data('url');
                let tableId = $(this).data('table-id');
                let table = $('#' + tableId).DataTable();

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        table.ajax.reload();

                        // لو عندك response فيه new_status أو new_available نتصرف بناءً عليه
                        if (response.new_status !== undefined) {
                            switch (response.new_status) {
                                case 'active':
                                    toastr.success('تم تعيين الحالة: فعال');
                                    break;
                                case 'inactive':
                                    toastr.warning('تم تعيين الحالة: غير فعال');
                                    break;
                                case 'banned':
                                    toastr.error('تم تعيين الحالة: موقوف');
                                    break;
                                case 'suspended':
                                    toastr.warning('تم تعيين الحالة: معلق');
                                    break;    
                                default:
                                    toastr.info('تم تحديث الحالة');
                            }
                        } else {
                            toastr.info('تم التحديث بنجاح');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        toastr.error('حدث خطأ أثناء تحديث الحالة');
                    }
                });
            });
        });
    </script>  --}}

    <script>
        $(document).ready(function() {

            $(document).on('click', '.available', function() {
                let url = $(this).data('url');
                let status = $(this).data('status');
                let tableId = $(this).data('table-id');
                var table = $('#' + tableId).DataTable();
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        table.ajax.reload();
                        if(status == 0){
                          toastr.success(' متوفر حاليا');
                        }else{
                          toastr.warning(' غير متوفر حاليا');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>

        $(document).ready(function() {

        $(document).on('click', '.delete-btn', function () {

            let url = $(this).data('url');
            let tableId = $(this).data('table-id');
            var titleSwal , textSwal ;
            if(tableId == 'orders_table'){
                titleSwal = "هل أنت متأكد من حذف هذا الطلب";
                textSwal = "عند حذفك للطلب سيتم حذف كافة البيانات والمنتجات المتعلقة به!";
            }else if(tableId == 'menus_table'){
                titleSwal = "هل أنت متأكد أنك تريد حذف هذه القائمة";
                textSwal = "عند حذفك للقائمة سيتم حذف كافة البيانات والمنتجات المتعلقة بها!";
            }
            else{
                titleSwal = "تأكيد الحذف";
                textSwal = "هل أنت متأكد أنك تريد حذف هذا الحقل؟";
            }

            Swal.fire({
                title: titleSwal ,
                text:textSwal,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "حذف",
                customClass: {
                   confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
                   cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                },
                cancelButtonText: "الغاء",
                buttonsStyling: false,
               }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url,
                        type: 'delete',
                        headers: {
                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success(response) {
                            console.log(response)
                            Swal.fire({
                                title: "تم الحذف بنجاح",
                                icon: 'success',
                                confirmButtonText: "تم",
                                customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            });
                             $('#' + tableId).DataTable().row($(this).parents('tr')).remove().draw();
                        },
                        error(error) {
                            console.log(error)
                            Swal.fire({
                                icon: 'error',
                                title: "خطأ",
                                text: "هناك خطأ ما !",
                                customClass: {
                                confirmButton: 'btn btn-label-secondary waves-effect waves-light'
                                 },
                                 buttonsStyling: false,
                            });
                        }
                    })
                }
            });
        });
     })

    </script>

     <script>

        $(document).ready(function() {

          $(document).on('click', '.status', function () {

            let url = $(this).data('url');
            let tableId = $(this).data('table-id');
            let table = $('#' + tableId).DataTable();

            var titleSwal , textSwal ;

            if(tableId == 'orders_table'){
                titleSwal = "هل أنت متأكد من حذف هذا الطلب";
                textSwal = "عند حذفك للطلب سيتم حذف كافة البيانات والمنتجات المتعلقة به!";
            }else if(tableId == 'menus_table'){
                titleSwal = "هل أنت متأكد أنك تريد حذف هذه القائمة";
                textSwal = "عند حذفك للقائمة سيتم حذف كافة البيانات والمنتجات المتعلقة بها!";
            }
            else{
                titleSwal = "تأكيد التحديث";
                textSwal = "هل أنت متأكد أنك تريد تغيير الحالة؟";
            }

            Swal.fire({
    title: titleSwal,
    text: textSwal,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: "نعم",
    cancelButtonText: "إلغاء",
    customClass: {
        confirmButton: 'btn btn-warning me-3 waves-effect waves-light',
        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
    },
    buttonsStyling: false,
}).then((result) => {
    let status = null;

    if (result.isConfirmed) {
        status = 'approve'; // الحالة عند الضغط على "نعم"
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        status = 'cancelled'; // الحالة عند الضغط على "إلغاء"
    }

    if (status !== null) {
        $.ajax({
            url: url,
            type: 'GET',
            data: { status: status }, // إرسال الحالة كـ parameter
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success(response) {
                console.log(response);
                Swal.fire({
                    title: "تم تحديث الحالة بنجاح",
                    icon: 'success',
                    confirmButtonText: "تم",
                    customClass: {
                        confirmButton: 'btn btn-success waves-effect waves-light'
                    }
                });
                table.ajax.reload();
            },
            error(error) {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: "خطأ",
                    text: "هناك خطأ ما !",
                    customClass: {
                        confirmButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false,
                });
            }
        });
    }
});

          });
        })

    </script>

    {{--display the image--}}
    <script>
        $(document).on('click', '.datatable_img', function () {
            const fullImageUrl = $(this).data('full');

            Swal.fire({
                imageUrl: fullImageUrl,
                showConfirmButton: false,
                showCloseButton: true,
                background: 'white',
                padding: '0px 0px 30px 0px',
                width: '447px',
                customClass: {
                    popup: 'image-preview-popup',
                    image: 'image-preview-img',
                    closeButton: 'image-preview-close'
                }
            });
        });
    </script>

     {{--  <script src="{{ asset('dashboard/assets/js/dashboards-crm.js') }}"></script>  --}}

