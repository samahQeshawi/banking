
@if($available == '1')
<a data-status="{{ $available }}">
<span class="available btn btn-text-success waves-effect waves-light" 
data-url="{{ route($routeStatus, $id) }}" 
data-id="{{$id}}"
data-table-id = "{{ $tableId }}"
data-status="{{ $available }}">متوفر</span>
</a>
@else
<a data-status="{{ $available }}">
    <span class="available btn btn-text-danger waves-effect waves-light" 
    data-url="{{ route($routeStatus, $id) }}" 
    data-id="{{$id}}"
    data-table-id = "{{ $tableId }}"
    data-status="{{ $available }}">غير متوفر</span>
</a>
@endif
