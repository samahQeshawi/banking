@extends('dashboard.layouts.master')
@section('title','المشرفين')

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
                    <h5 class="card-header">تعديل بيانات المشرف</h5>
                    <div class="card-body">
                      <form id="formValidationExamples" action="{{route('admin.admins.update', $admin->id)}}" 
                      method="post" enctype="multipart/form-data" class="row g-6">
                        @csrf
                        @method('PUT')

                        @php
                          $photoSession = session('image');
                          $photoPath = is_array($photoSession) ? $photoSession['path'] : $photoSession;
                          
                          $adminPhoto = $photoPath ? asset('storage/' . $photoPath) 
                                     : ($admin->img_url ? asset($admin->img_url) : asset('dashboard/assets/img/6.jpg'));
                        @endphp

                      <div class="card-body d-flex justify-content-center align-items-center">

                        <div class="d-flex align-items-start align-items-sm-center gap-6 position-relative">
                            <!-- Image preview with click upload functionality -->
                            <div class="position-relative">

                             <img src="{{ $adminPhoto }}"
                              alt="admin-avatar"
                              class="d-block w-px-150 h-px-150 rounded cursor-pointer uploaded-avatar"
                              data-default-src="{{ $admin->img_url ? asset($admin->img_url)  : asset('dashboard/assets/img/6.jpg') }}"/>

                              <!-- Reset Icon -->
                              <button type="button" class="btn btn-sm btn-danger position-absolute
                               top-0 start-100 translate-middle p-1 rounded-circle d-flex align-items-center
                                justify-content-center resetImage" 
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
                            <input value="{{old('name', $admin->name)}}" id="name" type="text" class="form-control" name="name"  required/>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label" for="phone">رقم الجوال<span class="text-danger">*</span></label>
                              <input type="tel" maxlength="11"  value="{{old('phone', $admin->phone)}}" dir="ltr"
                                    class="form-control border-input phone-input-1" required>
                            </div>
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="email">البريد الالكتروني</label>

                            <input value="{{old('email', $admin->email)}}" id="email" type="email" class="form-control" name="email" required/>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                          <label class="form-label" for="role_id"> الدور</label>
                            <select placeholder="اختر الدور" class="selectpicker w-auto @error('role_id') is-invalid @enderror" id="role_id" name="role_id" data-style="btn-default">
                                @foreach($roles as $role)
                                  <option value="{{ $role->id }}" {{ old('role_id', optional($admin->roles->first())->id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option> 
                                @endforeach
                            </select>
                            @error('role_id')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
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
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>


                   <hr class="mt-7" />

                   <div class="col-12 text-center">
                        <a class="btn  btn-secondary waves-effect waves-light me-3" href="{{ route('admin.admins.index') }}">رجوع</a>
                        <button class="btn  btn-success waves-effect waves-light" type="submit">تعديل</button>
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