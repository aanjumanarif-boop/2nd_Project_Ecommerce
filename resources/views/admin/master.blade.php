<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminL | Dashboard</title>

    <!--begin::Accessibility Meta Tags-->
 
     @include('admin.includes.style')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
        
        @include('admin.includes.header')

      <!--end::Header-->
      <!--begin::Sidebar-->
       @include('admin.includes.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
        @yield('content')
      <!--end::App Main-->
      <!--begin::Footer-->
        @include('admin.includes.footer')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
         

     @include('admin.includes.script')

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
