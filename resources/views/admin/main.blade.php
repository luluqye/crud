@include('admin.layout.header')
@include('admin.layout.navbar-top')
<div id="wrapper">
    @include('admin.layout.navbar-side')
    <div id="content-wrapper">

        @yield('content')

        @include('admin.layout.footer-sticky')

    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
@include('admin.layout.footer')
