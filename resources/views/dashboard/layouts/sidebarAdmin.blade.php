     <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">

            <a href="#" class="app-brand-link">
               <img src="{{ asset('dashboard/assets/img/branding/brand-img-small.png') }}" class="sign-favicon-b ht-40" height="25" alt="logo">
               <span class="app-brand-text demo menu-text fw-bold">بوابة الإدارة</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">

                  {{--  @can('home display')  --}}
                    <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-house"></i>
                            <div>الرئيسية</div>
                        </a>
                    </li>
                  {{--  @endcan  --}}  

                  @can('roles display')
                    <li class="menu-item {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-swatchbook"></i>
                            <div>ادارة الأدوار</div>
                        </a>
                    </li>
                  @endcan

                  @can('admins display')
                    <li class="menu-item {{ Route::is('admin.admins.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.admins.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-users"></i>
                            <div>ادارة المفوضيين</div>
                        </a>
                    </li>
                  @endcan

                  @can('transfers display')
                    <li class="menu-item {{ Route::is('admin.transfers.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.transfers.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-wallet"></i>
                            <div>الحسابات</div>
                        </a>
                    </li>
                  @endcan

                  @can('investments display')
                    <li class="menu-item {{ Route::is('admin.investments.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.investments.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-money-bill-wave"></i>
                            <div>الاستثمارات</div>
                        </a>
                    </li>
                  @endcan

                  @php
                  $hasCardPermission = false;
                    foreach (Auth::user()->getAllPermissions() as $permission) {
                    if (Str::startsWith($permission->name, 'cards')) {
            $hasCardPermission = true;
            break;
        }
    }
@endphp

                  @if(userHasAnyPermissionLike('cards'))
                    <li class="menu-item {{ Route::is('admin.cards.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.cards.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-money-bill-wave"></i>
                            <div>البطاقات</div>
                        </a>
                    </li>
                  @endif

                  @can('receivables ')
                    <li class="menu-item {{ Route::is('admin.receivables.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.receivables.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-file-invoice-dollar"></i>
                            <div>سداد المستحقات</div>
                        </a>
                    </li>
                  @endcan

                  @can('loans display')
                    <li class="menu-item {{ Route::is('admin.loans.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.loans.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fas fa-coins"></i>
                            <div>القروض</div>
                        </a>
                    </li>
                  @endcan
                  
                
                {{--  @canany(['admins display', 'accounts display'])
                <li class="menu-item {{ Route::is('admin.accounts.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon fa-solid fa-swatchbook"></i>
                     <div>ادارة الحسابات</div>
                    </a>
                    <ul class="menu-sub">
                       @can('admins display')
                       <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div>المشرفين</div>
                        </a>
                       </li>
                       @endcan

                       @can('roles display')
                       <li class="menu-item {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                        <div>الأدوار والصلاحيات</div>
                        </a>
                      </li>
                      @endcan

                    </ul>
                </li> 
                @endcanany  --}}

            </ul>

        </aside>
        <!-- / Menu -->
