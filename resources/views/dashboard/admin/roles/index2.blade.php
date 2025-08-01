@extends('dashboard.layouts.master')
@section('title', 'الأدوار')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="mb-1">إدارة الأدوار</h4>
              <!-- Role cards -->
            <div class="row g-6">
              @foreach($roles as $role)
                @php
                    $admins = $role->users;            
                    $adminsCount = $admins->count();
                    $displayedAdmins = $adminsCount > 4 ? $admins->take(3) : $admins;
                    $remainingCount = $adminsCount > 4 ? $adminsCount - 3 : 0;
                    
                    $adminsList = $admins->take(4)->pluck('name')->implode(', ');
                    $remainingCount = $adminsCount > 4 ? $adminsCount - 4 : 0;
                    $remainingText = $remainingCount > 0 ? "+{$remainingCount} more" : '';
                    $rolePermissions = $role->permissions->pluck('name')->implode(', ');  
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-normal mb-0 text-body">Total {{ $adminsCount }} users</h6>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                           @foreach($displayedAdmins as $admin)
        <li
            data-bs-toggle="tooltip"
            data-popup="tooltip-custom"
            data-bs-placement="top"
            title="{{ $admin->name }}"
            class="avatar pull-up"
        >
            <img class="rounded-circle"
                 src="{{ $admin->image ? asset('uploads/admins/' . $admin->image) : asset('dashboard/assets/img/avatars/default.png') }}"
                 alt="{{ $admin->name }}" />
        </li>
    @endforeach
                       @if($remainingCount > 0)
        <li class="avatar">
            <span class="avatar-initial rounded-circle pull-up"
                  data-bs-toggle="tooltip"
                  data-bs-placement="bottom"
                  title="{{ $remainingCount }} مستخدم إضافي">
                +{{ $remainingCount }}
            </span>
        </li>
    @endif
                        </ul>
                      </div>
                      <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                          <h5 class="mb-1">{{ $role->name }}</h5>
                          <a
                            href="{{ route('admin.roles.edit', $role->id) }}"
                            class="role-edit-modal"
                            ><span>تعديل</span></a
                          >
                        </div>
                        <a href="javascript:void(0);"><i class="ti ti-copy ti-md text-heading"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4">
                          <img
                            src="{{ asset('dashboard/assets/img/illustrations/add-new-roles.png') }}"
                            class="img-fluid mt-sm-4 mt-md-0"
                            alt="add-new-roles"
                            width="83" />
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                          <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                            إضافة دور جديد
                          </a>
                          <p class="mb-2">
                            يمكنك إضافة دور جديد وتحديد الصلاحيات الخاصة به.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            
</div>

@endsection

@section('js')

    <script src="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/image-upload.js') }}"></script>

@endsection
