@extends('dashboard.layouts.master')
@section('title', 'تعديل الدور')
@section('css')
@endsection

@section('content')
    <form action="{{ route('admin.roles.update', $out->id) }}" method="post" id="editForm">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">تعديل الدور والصلاحيات</h4>
                    </div>
                  <div class="card-body">
                    <div style="margin-bottom:20px" class="form-group col-md-12 mg-t-10">
                        <label style="margin-bottom:5px">اسم الدور:</label>
                        <input type="text" name="name" class="form-control" value="{{ $out->name }}">
                        @error('name')
                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fv-row">
                        <div class="card-header">
                            <label class="fs-5 fw-bolder form-label mb-2">الصلاحيات</label>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <tbody class="text-gray-600 fw-bold">

                                <tr>
                                    <td class="text-gray-800">
                                        جميع الصلاحيات
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="التحكم الكامل بالصلاحيات"></i>
                                    </td>
                                    <td>
                                        <label class="form-check form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                            <span class="form-check-label" for="kt_roles_select_all">تحديد الكل</span>
                                        </label>
                                    </td>
                                </tr>

                                @foreach($permissions as $module => $perms)
                                    <tr>
                                        <td class="text-gray-800">{{ __('permissions.' . $module) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach($perms as $pp => $id)
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input type="checkbox" name="permissions[]" value="{{ $id }}" class="form-check-input permission-checkbox" @if($out->hasPermissionTo($id)) checked="checked" @endif />
                                                        <span class="form-check-label">{{ __('permissions.' . $pp) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 text-center mt-7">
                               <a class="btn  btn-secondary waves-effect waves-light me-3" href="{{ route('admin.roles.index') }}">رجوع</a>
                               <button class="btn  btn-success waves-effect waves-light" type="submit">تحديث</button>
                        </div>
                    </div>
                  </div> 
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('assets/custom/ar_MA.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('kt_roles_select_all');
            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });
        });

        const form = document.querySelector('#editForm');
        var validator = FormValidation.formValidation(
            form,
            {
                locale: 'ar_MA',
                localization: ArabicLang,
                plugins: {
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    }),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );

        const submitButton = form.querySelector('[data-kt-action="submit"]');
        submitButton?.addEventListener('click', e => {
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        form.submit();
                    }
                });
            }
        });
    </script>
@stop
