<div class="wrapper ">
  @include('layouts.navbars.sidebar', ['activePage' => $activePage ?? null])
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>
