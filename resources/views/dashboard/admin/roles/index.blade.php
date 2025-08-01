@extends('dashboard.layouts.master')
@section('title', 'الأدوار')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Select -->
        <div class="card">
            <h5 class="card-header">ادارة الأدوار</h5>
                <div class="card-body">
                    @can('roles create')
                        <a href="{{ route('admin.roles.create') }}"
                           class="btn btn-label-success waves-effect">
                            اضافة دور جديد
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
