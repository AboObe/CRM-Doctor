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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"   ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.4/sweetalert2.all.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" ></script>
<!-- Dropzone -->
<script src="{{asset('assets/dropzone/min/dropzone.min.js')}}"></script>

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
  <script src="{{asset('assets/js/material-dashboard.min.js')}}?v=3.0.0"></script>

  <script>
   @if ($errors->any())
     @foreach ($errors->all() as $error)
      new Noty({
        type: 'error',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{$error}}',
        timeout: 2000,
        }).show();
     @endforeach
     @endif
      @if(session('success'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('success')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('error'))
        new Noty({
        type: 'error',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('error')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('adding user'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('adding user')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('deleting user'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('deleting user')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('profile updated'))
        new Noty({
        type: 'warning',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('profile updated')}}',
        timeout: 2000,
        }).show();
      @endif

      @if(session('page created'))
        new Noty({
        type: 'warning',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('page created')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('video created'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('video created')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('draft video'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('draft video')}}',
        timeout: 2000,
        }).show();
      @endif

      @if(session('draft page'))
        new Noty({
        type: 'warning',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('draft page')}}',
        timeout: 2000,
        }).show();
      @endif


      @if(session('create_category'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('create_category')}}',
        timeout: 2000,
        }).show();
      @endif

      @if(session('delete_cat'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('delete_cat')}}',
        timeout: 2000,
        }).show();
      @endif

      @if(session('update_category'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('update_category')}}',
        timeout: 2000,
        }).show();
      @endif
      @if(session('aboutus info'))
        new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: '{{session('aboutus info')}}',
        timeout: 2000,
        }).show();
      @endif

      function showSuccesFunction(){
          new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: 'Added Succesfuly',
        timeout: 2000,
        }).show();
      }
        function showSuccesFunction(msg){
          new Noty({
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: msg,
        timeout: 2000,
        }).show();
      }
      function showErrorFunction(){
            new Noty({
        type: 'error',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: 'Error Happens Try Again',
        timeout: 2000,
        }).show();
      }
    function showErrorFunction(msg){
            new Noty({
        type: 'error',
        layout: 'topRight',
        timeout: 3000,
        theme: 'mint',
        text: msg,
        timeout: 2000,
        }).show();
      }



  $(function(){
    $(".deleteConfirmation").click(function(e){
      e.preventDefault();
   sweetConfirm(function(confirmed){
    if(!confirmed)return;
    else{
      $("#delete-form").submit();
    }
   })
      // return;
    });
  })

  function sweetConfirm(  callback) {
    Swal.fire({
        title: " Delete Confirmation !",
         text:"Are you Sure to delete this item",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#2F8BE6",
        cancelButtonColor: "#F55252",
        confirmButtonText: "Yes",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        cancelButtonText: "Cancel ",
        buttonsStyling: !1
    }) .then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}
</script>


  @stack('pageJs')
</body>

</html>
