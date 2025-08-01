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

                        <div class="col-md-6">  
                           <div class="form-group">   
                             <label class="form-label" for="phone">رقم الجوال<span class="text-danger">*</span></label>
                   
                            <div class="input-group">
                                <input type="number" maxlength="11" name="phone"
                                    value="{{old('phone')}}" dir="ltr"
                                    class="form-control border-input" required> 
                                <span class="input-group-text" id="basic-addon11">966+</span>                                      
                            </div>
                            <small class="form-text text-muted">يجب أن يكون رقم الجوال مسجلًا في البنك</small>      

                           </div>
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label" for="id_number">رقم الهوية الوطنية<span class="text-danger">*</span></label>
                              <input type="number" maxlength="11"  value="{{old('id_number')}}" name="id_number" dir="ltr"
                                    class="form-control border-input" required>   
                            </div>
                            @error('id_number')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                          <label class="form-label" for="problem">سبب التفويض</label>
                            <select placeholder="اختر" class="selectpicker w-auto" name="problem" >
                                <option value="1" {{ old('problem') == 1 ? 'selected' : '' }}>كفيف</option>
                                <option value="2" {{ old('problem') == 2 ? 'selected' : '' }}>ضعيف السمع</option>
                                <option value="3" {{ old('problem') == 3 ? 'selected' : '' }}>صعوبات التعلم</option>
                                <option value="4" {{ old('problem') == 4 ? 'selected' : '' }}>كبير السن</option>
                                <option value="5" {{ old('problem') == 5 ? 'selected' : '' }}>فاقد الاهلية</option>
                            </select>
                            @error('problem')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                          <label class="form-label" for="delegation_duration">مدة التفويض</label>
                            <select placeholder="اختر" class="selectpicker w-auto"  name="delegation_duration" data-style="btn-default">
                                <option value="1" {{ old('delegation_duration') == 1 ? 'selected' : '' }}>يوم</option>
                                <option value="2" {{ old('delegation_duration') == 2 ? 'selected' : '' }}>أسبوع</option>
                                <option value="3" {{ old('delegation_duration') == 3 ? 'selected' : '' }}>شهر</option>
                                <option value="4" {{ old('delegation_duration') == 4 ? 'selected' : '' }}>سنة</option>
                                <option value="5" {{ old('delegation_duration') == 5 ? 'selected' : '' }}>غير محدد</option>
                            </select>
                            @error('delegation_duration')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                          <label class="form-label" for="agency_number">رقم الوكالة</label>

                            <input value="{{old('agency_number')}}"  type="number" class="form-control" name="agency_number" required/>
                            @error('agency_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                          <label class="form-label" for="max_amount">الحد الاعلى للمبالغ</label>

                            <input value="{{old('max_amount')}}"  type="number" class="form-control" name="max_amount" required/>
                            @error('max_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md p-6">
                       
                        <div class="form-check form-check-inline mt-4">
                          <input class="form-check-input" type="radio" name="agency_type" id="inlineRadio1" value="1">
                          <label class="form-check-label" for="inlineRadio1">وكالة</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="agency_type" id="inlineRadio2" value="2" checked>
                          <label class="form-check-label" for="inlineRadio2">بدون وكالة</label>
                        </div>
                      </div>

                   <hr class="mt-3" style="height: 3px; background-color: #e6e6e8;"/> 
                   <div class="fv-row">
                            <div class="card-header">
                                <label class="fs-5 fw-bolder form-label mb-2">التفويض</label>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <tbody class="text-gray-600 fw-bold">

                                    <tr>
                                        <td class="text-gray-800">
                                            جميع التفويضات 
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="تحكم كامل في جميع الصلاحيات"></i>
                                        
                                        </td>
                                        <td>
                                            <label class="form-check form-check-custom form-check-solid me-9">
                                                <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                <span class="form-check-label" for="kt_roles_select_all">تحديد الكل</span>
                                            </label>
                                        </td>
                                        @error('permissions')
                                           <span class="text-danger">{{ $message }}</span>
                                        @enderror
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








