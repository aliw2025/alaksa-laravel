<div class="main-menu menu-fixed menu-accordion menu-shadow menu-light" data-scroll-to-active="true" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
  <div class="navbar-header expanded">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('index')}}"><span class="brand-logo">
            <h2 class="brand-text">Alpha Digital</h2></a></li>
      <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x d-block d-xl-none text-primary toggle-icon font-medium-4">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-disc d-none d-xl-block collapse-toggle-icon primary font-medium-4">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="3"></circle>
          </svg></a></li>
    </ul>
  </div>
  <div class="shadow-bottom" style="display: none;"></div>
  <div class="main-menu-content ps ps--active-y" style="height: 806.625px;">
    @if(Auth::user())
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="nav-item has-sub sidebar-group-active menu-collapsed-open">
        <a class="d-flex align-items-center" href="{{route('calender')}}">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
        <ul class="menu-content" style="">
          
        </ul>
      </li>

      <li class=" navigation-header"><span data-i18n="Patient 360">pages</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
          <circle cx="12" cy="12" r="1"></circle>
          <circle cx="19" cy="12" r="1"></circle>
          <circle cx="5" cy="12" r="1"></circle>
        </svg>
      </li>

      <li class=" nav-item"><a class="d-flex align-items-center" ">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          <span class="menu-title text-truncate" data-i18n="Patients">Investors</span>
        </a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
        
          <span class=" menu-title text-truncate" data-i18n="Patients">Inventory</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
          <span class=" menu-title text-truncate" data-i18n="Patients">Sales</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
          <span class=" menu-title text-truncate" data-i18n="Patients">Commision</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
          <span class=" menu-title text-truncate" data-i18n="Patients">Recovery</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
          <span class=" menu-title text-truncate" data-i18n="Patients">Payables</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center" ">
          <span class=" menu-title text-truncate" data-i18n="Patients">Expenses</span></a>
      </li>


      <!-- <li class=" nav-item"><a class="d-flex align-items-center" ">
        <span class="menu-title text-truncate" data-i18n="Patients">Sets</span></a>
    </li>       -->
    </ul>
    @endif
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 807px; right: 0px;">
      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 377px;"></div>
    </div>
  </div>
</div>