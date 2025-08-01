@extends('dashboard.layouts.master')
@section('title','المفوضيين')

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/intlTelInput.css') }}">
@endsection

@section('content')

  <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">إضافة مفوض جديد</h5>
                    <div class="card-body">
                      <form id="formValidationExamples" action="{{route('admin.admins.store')}}" 
                      method="post" enctype="multipart/form-data" class="row g-6">
                        @csrf

                        @php
                          $photoSession = session('image');
                          $photoPath = is_array($photoSession) ? $photoSession['path'] : $photoSession;
                          $adminPhoto = $photoPath ? asset('storage/' . $photoPath) : asset('dashboard/assets/img/6.jpg');
                        @endphp

                      <div class="card-body d-flex justify-content-center align-items-center">

                        <div class="d-flex align-items-start align-items-sm-center gap-6 position-relative">
                            <!-- Image preview with click upload functionality -->
                            <div class="position-relative">

                             <img src="{{ $adminPhoto }}" alt="user-avatar"
                              class="d-block w-px-150 h-px-150 rounded cursor-pointer uploaded-avatar"
                              data-default-src="{{ asset('dashboard/assets/img/6.jpg') }}"/>

                              <!-- Reset Icon -->
                              <button type="button" class="btn btn-sm btn-danger position-absolute 
                                  top-0 start-100 translate-middle p-1 rounded-circle d-flex 
                                  align-items-center justify-content-center reset-image" 
                                  style="width: 24px; height: 24px;">
                                <i class="ti ti-x"></i>
                              </button>
                            </div>

                            <!-- Hidden file input -->
                            <input type="file" class="account-file-input upload" name="image" hidden accept="image/png, image/jpeg" />

                            @error('image')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>

                        <div class="col-md-6">
                          <label class="form-label" for="name">الاسم</label>
                            <input value="{{old('name')}}" id="name" type="text" class="form-control" name="name"  required/>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label" for="phone">رقم الجوال<span class="text-danger">*</span></label>
                              <input type="tel" maxlength="11"  value="{{old('phone')}}" dir="ltr"
                                    class="form-control border-input phone-input-1" required>
                            </div>
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                          <label class="form-label" for="email">البريد الالكتروني</label>

                            <input value="{{old('email')}}"  type="email" class="form-control" name="email" required/>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                          <label class="form-label" for="role">نوع المشكلة</label>
                            <select placeholder="اختر" class="selectpicker w-auto"  name="problem" data-style="btn-default">
                                <option value="1" >كفيف</option>
                                <option value="2" >ضعيف السمع</option>
                                <option value="3" >صعوبات التعلم</option>
                                <option value="4" >كبير السن</option>
                                <option value="5" >فاقد الاهلية</option>
                            </select>
                            @error('problem')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md p-6">
                       
                        <div class="form-check form-check-inline mt-4">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                          <label class="form-check-label" for="inlineRadio1">وكالة</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                          <label class="form-check-label" for="inlineRadio2">بدون وكالة</label>
                        </div>
                      </div>

                        <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password">كلمة المرور </label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••••">
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                        </div>

                        <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password_confirmation"> تأكيد كلمة المرور</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="••••••••••">
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                        </div>

                   <hr class="mt-7" /> 
                   <div class="fv-row">
                            <div class="card-header">
                                <label class="fs-5 fw-bolder form-label mb-2">التفويض</label>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <tbody class="text-gray-600 fw-bold">

                                    <tr>
                                        <td class="text-gray-800">
                                            جميع الصلاحيات 
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="تحكم كامل في جميع الصلاحيات"></i>
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
                                            <td class="text-gray-800">{{ __('permissions.'.$module) }}</td> 
                                            <td>
                                                <div class="row">
                                                    @foreach($perms as $action => $data)
                                                       
                                                        <div class="col-6 col-md-3 mb-4 ">
                                                      
                                                        <div class="form-check custom-option custom-option-icon">
                                                        <label class="form-check-label custom-option-content" for="customCheckboxIcon1">
                                                        <span class="custom-option-body">
                                                           <i class="{{ $data['icon'] }}"></i>
                                                           <span class="custom-option-title"> {{ __('permissions.'.$action) }} </span>
                                                        </span>
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $data['id'] }}" 
                                                               @if(in_array($data['id'], old('permissions', []))) checked="checked" @endif
                                                               />
                                                        </label>
                                                        </div>

                                                        </div>
                                                    
                                                    
                      

                                                        
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                   <div class="col-12 text-center">
                        <a class="btn  btn-secondary waves-effect waves-light me-3" href="{{ route('admin.admins.index') }}">رجوع</a>
                        <button class="btn  btn-success waves-effect waves-light" type="submit">إضافة</button>
                    </div>


                      </form>
                    </div>
                  </div>
                </div>
                <!-- /FormValidation -->
              </div>
            </div>
            <!-- / Content -->

@endsection


@section('vendor-js')
    <script src="{{ asset('dashboard/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/form-input-group.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/intlTelInput.js') }}"></script>

    <script>
     var input1 = document.querySelector(".phone-input-1");

        if (input1) {
            window.intlTelInput(input1, {
                initialCountry: "sa",
                preferredCountries: ['sa'],
                separateDialCode: true,
                allowDropdown: true,
                formatOnDisplay: true,
                nationalMode: true,
                hiddenInput: 'phone',
                utilsScript: "{{ asset('dashboard/assets/js/utils.js?1724195568') }}"
            });
        }

        new Cleave(input1, {
          phone: true,
          numericOnly: true
        });
    </script>
    
@endsection








