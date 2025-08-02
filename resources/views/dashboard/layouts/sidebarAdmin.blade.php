     <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">

            <a href="#" class="app-brand-link">
               <img src="{{ asset('dashboard/assets/img/branding/brand-img-small.png') }}" class="sign-favicon-b ht-40" height="25" alt="logo">
               <span class="app-brand-text demo menu-text fw-bold">حسابي البنكي</span>
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

                  {{--  @can('roles display')  --}}
                    <li class="menu-item {{ Route::is('admin.bank-account.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.bank-account.show') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-swatchbook"></i>
                            <div>حسابي البنكي</div>
                        </a>
                    </li>
                  {{--  @endcan  --}}


               {{--  @canany(['admins display'])  --}}
                <li class="menu-item {{ Route::is('admin.admins.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon fa-solid fa-users"></i>
                     <div>ادارة التفاويض</div>
                    </a>
                    <ul class="menu-sub">
                     
                       <li class="menu-item">
                        <a href="{{ route('admin.admins.index') }}" class="menu-link">
                        <div>المفوضين</div>
                        </a>
                       </li>
                      

                       <li class="menu-item {{ Route::is('admin.delegations.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.delegations.index') }}" class="menu-link">
                        <div>التفاويض</div>
                        </a>
                      </li>
                     

                    </ul>
                </li> 
                {{--  @endcanany   --}}

                  {{--  @if(userHasAnyPermissionLike('accounts'))  --}}
                    <li class="menu-item {{ Route::is('admin.accounts.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.accounts.index') }}" class="menu-link">
                            <i class="menu-icon fas fa-university"></i>
                            <div>الحسابات</div>
                        </a>
                    </li>
                  {{--  @endif  --}}

                  {{--  @if(userHasAnyPermissionLike('cards'))  --}}
                    <li class="menu-item {{ Route::is('admin.cards.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.cards.index') }}" class="menu-link">
                            <i class="menu-icon fas fa-list-alt"></i>
                            <div>البطاقات</div>
                        </a>
                    </li>
                  {{--  @endif  --}}

                  {{--  @if(userHasAnyPermissionLike('payments'))  --}}
                    <li class="menu-item {{ Route::is('admin.payments.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.payments.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-money-bill-wave"></i>
                            <div>المدفوعات</div>
                        </a>
                    </li>
                  {{--  @endif  --}}
                    

                  {{--  @if(userHasAnyPermissionLike('investments'))  --}}
                    <li class="menu-item {{ Route::is('admin.investments.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.investments.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-file-invoice-dollar"></i>
                            <div>الاستثمارات</div>
                        </a>
                    </li>
                  {{--  @endif  --}}

                    <li class="menu-item {{ Route::is('admin.transactions.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-exchange-alt"></i>
                            <div>الحركات</div>
                        </a>
                    </li>
      



            </ul>

        </aside>
        <!-- / Menu -->
