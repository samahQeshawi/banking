@extends('dashboard.layouts.master')
@section('title', 'حسابي البنكي')

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
   <h1>حسابي البنكي</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">تفاصيل الحساب</h5>
        </div>
        <div class="card-body">
            @if(isset($score['fraud_score']))
            <div class="alert alert-info">
                <strong>درجة الاحتيال:</strong> {{ $score['fraud_score'] }}
            </div>
            @else
            <div class="alert alert-warning">
                لم يتم استلام نتيجة من الخادم.
            </div>
             @endif
        </div>
    </div>  
    

</div>
    {{--  <div class="card">
        <div class="card-header">
            <h5 class="card-title">تفاصيل الحساب</h5>
        </div>
        <div class="card-body">
            <p>اسم صاحب الحساب: {{ $user->name }}</p>
            <p>رقم الحساب: {{ $user->account_number }}</p>
            <p>الرصيد: {{ $user->balance }}</p>
        </div>
    </div>  --}}
@endsection