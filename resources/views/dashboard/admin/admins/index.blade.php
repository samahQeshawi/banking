@extends('dashboard.layouts.master')
@section('title', 'المفوضيين')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header">قائمة المفوضيين</h5>
                <div class="card-body">
                    @can('admins create')
                        <a href="{{ route('admin.admins.create') }}"
                           class="btn btn-label-success waves-effect">
                            اضافة مفوض جديد
                        </a>
                    @endcan

                </div>

                <div class="card-datatable table-responsive pt-0">

                    {{$dataTable->table()}}

                </div>
        </div>
    <!--/ Select -->
</div>

@endsection

@section('js')

    <script src="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>

    {{$dataTable->scripts()}}
    {{ $script ?? '' }}

@endsection
