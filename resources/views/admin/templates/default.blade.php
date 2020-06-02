<!DOCTYPE html>
<html>
@include('admin.templates.partials._head')

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

        @include('admin.templates.partials._header')

        @include('admin.templates.partials._sidebar')

        <div class="content-wrapper">
                @yield('content')
        </div>

        @include('admin.templates.partials._footer')

        @include('admin.templates.partials._controlSidebar')
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    @include('admin.templates.partials._scripts')
</body>

</html>
