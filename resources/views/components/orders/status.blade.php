@props(['id', 'status', 'status_text', 'btn_class', 'icon', 'cancel_reason' => ''])

<button class="btn btn-sm {{ $btn_class }} change-status-btn"
        data-id="{{ $id }}"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="اضغط لتغيير حالة الطلب"
        data-current-status="{{ $status }}"
        data-cancel-reason="{{ $cancel_reason }}">
    <i class="fa-solid {{ $icon }} me-1"></i> {{ $status_text }}
</button>
