<div class="main-menu menu-fixed menu-accordion menu-shadow menu-light" data-scroll-to-active="true" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
  <div class="navbar-header expanded">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('index') }}"><span class="brand-logo">
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
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item">
        <a class="d-flex align-items-center" href="index-2.html">
          <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Alpha Digital</span>
        </a>
        <ul class="menu-content">
          <li>
            <a class="d-flex align-items-center" href="{{route('investor.create')}}">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate" data-i18n="eCommerce">Capital Investments</span>
            </a>
          </li>
          <li>
            <a class="d-flex align-items-center" href="{{route('investor.create')}}">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate" data-i18n="eCommerce">Analytics</span>
            </a>
          </li>
        </ul>
      </li>
      <li class=" nav-item">
        <a class="d-flex align-items-center" href="index-2.html">
          <i data-feather='users'></i>
          <span class="menu-title text-truncate" data-i18n="Dashboards">Investors</span>
        </a>
        <ul class="menu-content">
          <li>
            <a class="d-flex align-items-center" href="{{route('investor.create')}}">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate" data-i18n="eCommerce">Add New</span>
            </a>
          </li>
          @foreach($investors as $investor)
          <li>
            <a class="d-flex align-items-center">
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate" data-i18n="eCommerce">{{$investor->investor_name}}</span>
            </a>
          </li>

          @endforeach

        </ul>
      </li>
      <li class=" nav-item">
        <a href="{{route('investor.create')}}" class="d-flex align-items-center ">
          <i data-feather='file-text'></i>
          <span class=" menu-title text-truncate" data-i18n="inventory">Inventory</span>
        </a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center">
          <span class=" menu-title text-truncate" data-i18n="sales">Sales</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center">
          <span class=" menu-title text-truncate" data-i18n="comision">Commision</span></a>
      </li>

      <li class=" nav-item"><a class="d-flex align-items-center">
          <span class=" menu-title text-truncate" data-i18n="recovery">Recovery</span></a>
      </li>

      <li class=" nav-item"><a class="d-flex align-items-center">
          <span class=" menu-title text-truncate" data-i18n="payabeles">Payables</span></a>
      </li>
      <li class=" nav-item"><a class="d-flex align-items-center">
          <span class=" menu-title text-truncate" data-i18n="expenses">Expenses</span></a>
      </li>
    </ul>
  </div>
</div>