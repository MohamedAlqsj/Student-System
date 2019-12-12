<!DOCTYPE html>
<html lang="en">

@include('base_layout.header_meta')
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        @include('base_layout.header')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->

        @include('base_layout.side')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
          @include('base_layout.nav')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
               <div class="container">
                @yield('content')
               </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    @include('base_layout.footer_meta')

    @yield('script')
</body>

</html>
<!-- end document-->
