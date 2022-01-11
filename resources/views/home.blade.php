<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://premiumaligners.net/product/material-dashboard
* Copyright 2021 Creative Tim (https://premiumaligners.net)
* Licensed under MIT (https://premiumaligners.net/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

 <!-- Start Head -->
 @include('layouts.head')
	<!-- End Head -->

<body class="g-sidenav-show  bg-gray-200">
  
  <!-- Left Sidebar -->
	@include('layouts.sidebar')
	<!-- End Sidebar -->

  
      <!-- Start content -->
        @yield('content')
	    <!-- END content-page -->



  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>