@if($routeStatus)
    @if($status == 'pending' && $transaction->related_wallet_id == auth('admin')->user()->id)
    <a data-status="{{ $status }}">
    <span class="status btn rounded-pill btn-warning waves-effect waves-light"
    data-url="{{ route($routeStatus, $id) }}" data-id="{{$id}}"
    data-table-id = "{{ $tableId }}"
    data-status="{{ $status }}">بانتظار الموافقة</span>
    </a>
    @elseif($status == 'pending')
        <span class="btn rounded-pill btn-warning waves-effect waves-light"
         data-id="{{$id}}"
         data-table-id = "{{ $tableId }}"
         data-status="{{ $status }}">بانتظار الموافقة</span>
    @elseif($status == 'cancelled')
  
        <span class="btn rounded-pill btn-secondary waves-effect waves-light"
         data-id="{{$id}}"
         data-table-id = "{{ $tableId }}"
         data-status="{{ $status }}">ملغاة</span>
   
    @elseif($status == 'approve')
    
        <span class=" btn rounded-pill btn-success waves-effect waves-light"
         >موافقة</span>
    
    @endif
@endif
