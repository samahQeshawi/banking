@extends('dashboard.layouts.master')
@section('title', 'الملف الشخصي')
@section('title-url', route('admin.profile.show'))
@section('sub-title','تعديل الملف الشخصي')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">تحديث بيانات الملف الشخصي</h5>
                    <div class="card-body">
                        <form id="formValidationExamples"  class="row g-6" action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                        @php
                          $photoPath = session('photo_temp');
                          $userPhoto = $photoPath ? asset('storage/' . $photoPath) 
                                    : ($user->img_url ? asset($user->img_url) : asset('dashboard/assets/img/6.jpg'));
                        @endphp

                         <div class="card-body d-flex justify-content-center align-items-center">

                          <div class="d-flex align-items-start align-items-sm-center gap-6 position-relative">
                            <!-- Image preview with click upload functionality -->
                            <div class="position-relative">

                             <img src="{{ $userPhoto }}"
                              alt="user-avatar"
                              class="d-block w-px-150 h-px-150 rounded cursor-pointer uploaded-avatar"
                              data-default-src="{{ $user->img_url ? asset($user->img_url)  : asset('dashboard/assets/img/6.jpg') }}"/>

                              <!-- Reset Icon -->
                              <button type="button" class="btn btn-sm btn-danger position-absolute
                               top-0 start-100 translate-middle p-1 rounded-circle d-flex align-items-center
                                justify-content-center resetImage" 
                                style="width: 24px; height: 24px;">
                                <i class="ti ti-x"></i>
                              </button>
                            </div>

                            <!-- Hidden file input -->
                            <input type="file" class="account-file-input upload" name="photo" hidden accept="image/png, image/jpeg" />

                            @error('photo')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                            <div class="col-md-6">
                                <label class="form-label" for="title">الإسم</label>
                                <input type="text" id="name"  class="form-control" value="{{@$user->name}}" name="name" />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="title">البريد الإلكتروني</label>
                                <input type="email" id="email"  class="form-control" value="{{@$user->email}}" name="email" />
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phone">رقم الجوال <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{@$user->phone}}" name="phone" required/>
                                    <span class="input-group-text" id="basic-addon11">966+</span>
                                </div>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                            <hr class="mt-7"/>
                            <h5 class="my-2">تحديث كلمة المرور</h5>
                            <!-- Password -->
                            <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="old_password">كلمة المرور الحالية</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="••••••••••">
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password">كلمة المرور الجديدة</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••••">
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password_confirmation"> تأكيد كلمة المرور الجديدة</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="••••••••••">
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>


                  <hr class="mt-7" />
                   <div class="col-12 text-center">
                        <button class="btn  btn-success waves-effect waves-light" type="submit">تحديث</button>                    
                    </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <script src="{{ asset('dashboard/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection
@section('js')
    <script src="{{ asset('dashboard/assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/form-input-group.js') }}"></script>
@endsection 
