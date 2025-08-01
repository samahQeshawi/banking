<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            <span>الطلبات</span>
        </h5>

        <div class="card-datatable table-responsive pt-0">
            {{ $dataTable->table(['id' => $tableId]) }}
        </div>
    </div>
</div>

@include($modalView)

@section('js')
    {{ $dataTable->scripts() }}
    {{ $script ?? '' }}

    <script>
        $(document).on('click', '.change-status-btn', function () {
            let orderId = $(this).data('id');
            let currentStatus = $(this).data('current-status');
            let cancelReason = $(this).data('cancel-reason') || '';

            $('#orderId').val(orderId);
            $('#statusSelect').val(currentStatus);

            if (currentStatus === 'canceled') {
                $('#cancelReasonContainer').removeClass('d-none');
                $('#cancelReason').val(cancelReason);
            } else {
                $('#cancelReasonContainer').addClass('d-none');
                $('#cancelReason').val('');
            }

            $('#changeStatusModal').modal('show');
        });

        $('#statusSelect').on('change', function () {
            $('#cancelReasonContainer').toggleClass('d-none', $(this).val() !== 'canceled');
        });

        $('#saveStatusBtn').on('click', function () {
            let orderId = $('#orderId').val();
            let newStatus = $('#statusSelect').val();
            let cancelReason = $('#cancelReason').val();

            $.ajax({
                url: '{{ route($updateRoute, ":id") }}'.replace(':id', orderId),
                method: 'POST',
                data: {
                    status: newStatus,
                    cancel_reason: cancelReason,
                    _token: '{{ csrf_token() }}'
                },
                success: function () {
                    $('#changeStatusModal').modal('hide');
                    $('#{{ $tableId }}').DataTable().ajax.reload(null, false);
                    toastr.success('تم تحديث حالة الطلب بنجاح.');
                },
                error: function () {
                    toastr.error('حدث خطأ أثناء تحديث الحالة.');
                }
            });
        });
    </script>
@endsection
