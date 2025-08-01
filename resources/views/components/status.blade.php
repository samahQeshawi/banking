@if($routeStatus)
    @if($status == '1')
    <a data-status="{{ $status }}">
    <span class="status btn rounded-pill btn-warning waves-effect waves-light"
    data-url="{{ route($routeStatus, $id) }}" data-id="{{$id}}"
    data-table-id = "{{ $tableId }}"
    data-status="{{ $status }}">فعال</span>
    </a>
    @else
    <a data-status="{{ $status }}">
        <span class="status btn rounded-pill btn-secondary waves-effect waves-light"
         data-url="{{ route($routeStatus, $id) }}" data-id="{{$id}}"
         data-table-id = "{{ $tableId }}"
         data-status="{{ $status }}">غير فعال</span>
    </a>
    @endif
@endif
