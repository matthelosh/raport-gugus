
<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim
 Modified by Muhammad Soleh
=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
 

 <!DOCTYPE html>
 <html lang="en">
 
 <head>
   <meta charset="utf-8" />
   <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
   <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <title >
    @if(isset($page))
      {{strtoupper($page)}} | 
    @endif 
    PAPI GUSTU
   </title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
   <!--     Fonts and icons     -->
   {{-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> --}}
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700" />
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <!-- CSS Files -->
   {{-- <link rel="stylesheet" "> --}}
   {{-- Select2 --}}
   <link rel="stylesheet" href="{{asset('css/select2.min.css') }}" type="text/css">
   {{-- Datatables --}}
   <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
   <link href="{{ asset('css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />
   <link href="{{ asset('css/umum.css') }}" rel="stylesheet" />
    @if(Auth::user()->level == 'admin')
      <link href="{{ asset('css/dash-admin.css') }}" rel="stylesheet" />
    @endif
    @if(Auth::user()->level == 'guru')
      <link href="{{ asset('css/dash-guru.css') }}" rel="stylesheet" />
    @endif
   <style>
     /* Select2 Material */
     .select2 .selection .select2-selection--single, .select2-container--default .select2-search--dropdown .select2-search__field {
          border-width: 0 0 1px 0 !important;
          border-radius: 0 !important;
          height: 2.05rem;
      }

      .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple {
          border-width: 0 0 1px 0 !important;
          border-radius: 0 !important;
      }

      .select2-results__option {
          color: #26a69a;
          padding: 8px 16px;
          font-size: 16px;
      }

      .select2-container--default .select2-results__option--highlighted[aria-selected] {
          background-color: #eee !important;
          color: #26a69a !important;
      }

      .select2-container--default .select2-results__option[aria-selected=true] {
          background-color: #e1e1e1 !important;
      }

      .select2-dropdown {
          border: none !important;
          box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
      }

      .select2-container--default .select2-results__option[role=group] .select2-results__group {
          background-color: #333333;
          color: #fff;
      }

      .select2-container .select2-search--inline .select2-search__field {
          margin-top: 0 !important;
      }

      .select2-container .select2-search--inline .select2-search__field:focus {
          border-bottom: none !important;
          box-shadow: none !important;
      }

      .select2-container .select2-selection--multiple {
          min-height: 2.05rem !important;
      }

      .select2-container--default.select2-container--disabled .select2-selection--single {
          background-color: #ddd !important;
          color: rgba(0,0,0,0.26);
          border-bottom: 1px dotted rgba(0,0,0,0.26);
      }
   </style>
 </head>
 
 <body class="">
   <div class="wrapper ">
     @include('dashboard.sidebar')
     <div class="main-panel">
       <!-- Navbar -->
        @include('dashboard.navbar')
       <!-- End Navbar -->
       <div class="content">
         
         <div class="container-fluid">
             @yield('content')
             
         </div>
       </div>
       <footer class="footer">
         <div class="container-fluid">
           <nav class="float-left">
             <ul>
               <li>
                 <a href="https://www.creative-tim.com">
                   Creative Tim
                 </a>
               </li>
               <li>
                 <a href="https://creative-tim.com/presentation">
                   About Us
                 </a>
               </li>
               <li>
                 <a href="http://blog.creative-tim.com">
                   Blog
                 </a>
               </li>
               <li>
                 <a href="https://www.creative-tim.com/license">
                   Licenses
                 </a>
               </li>
             </ul>
           </nav>
           <div class="copyright float-right">
             &copy;
             <script>
               document.write(new Date().getFullYear())
             </script>, made with <i class="material-icons">favorite</i> by
             <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
           </div>
         </div>
       </footer>
     </div>
   </div>
   {{-- <div class="fixed-plugin">
     <div class="dropdown show-dropdown">
       <a href="#" data-toggle="dropdown">
         <i class="fa fa-cog fa-2x"> </i>
       </a>
       <ul class="dropdown-menu">
         <li class="header-title"> Sidebar Filters</li>
         <li class="adjustments-line">
           <a href="javascript:void(0)" class="switch-trigger active-color">
             <div class="badge-colors ml-auto mr-auto">
               <span class="badge filter badge-purple" data-color="purple"></span>
               <span class="badge filter badge-azure" data-color="azure"></span>
               <span class="badge filter badge-green" data-color="green"></span>
               <span class="badge filter badge-warning" data-color="orange"></span>
               <span class="badge filter badge-danger" data-color="danger"></span>
               <span class="badge filter badge-rose active" data-color="rose"></span>
             </div>
             <div class="clearfix"></div>
           </a>
         </li>
         <li class="header-title">Images</li>
         <li class="active">
           <a class="img-holder switch-trigger" href="javascript:void(0)">
             <img src="{{ asset('img/sidebar-1.jpg') }}" alt="">
           </a>
         </li>
         <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
             <img src="{{ asset('img/sidebar-2.jpg') }}" alt="">
           </a>
         </li>
         <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
             <img src="{{ asset('img/sidebar-3.jpg') }}" alt="">
           </a>
         </li>
         <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
             <img src="{{ asset('img/sidebar-4.jpg') }}" alt="">
           </a>
         </li>
         <li class="button-container">
           <a href="https://www.creative-tim.com/product/material-dashboard" target="_blank" class="btn btn-primary btn-block">Free Download</a>
         </li>
         <!-- <li class="header-title">Want more components?</li>
             <li class="button-container">
                 <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                   Get the pro version
                 </a>
             </li> -->
         <li class="button-container">
           <a href="https://demos.creative-tim.com/material-dashboard/docs/2.1/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block">
             View Documentation
           </a>
         </li>
         <li class="button-container github-star">
           <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
         </li>
         <li class="header-title">Thank you for 95 shares!</li>
         <li class="button-container text-center">
           <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
           <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
           <br>
           <br>
         </li>
       </ul>
     </div>
   </div> --}}
   <!--   Core JS Files   -->
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/popper.min.js') }}"></script>
   
   <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>
   <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
   <!-- Plugin for the momentJs  -->
   <script src="{{ asset('js/plugins/moment.min.js') }}"></script>
   <!--  Plugin for Sweet Alert -->
   <script src="{{ asset('js/plugins/sweetalert2.js') }}"></script>
   <!-- Forms Validations Plugin -->
   <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
   <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
   <script src="{{ asset('js/plugins/jquery.bootstrap-wizard.js') }}"></script>
   <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
   <script src="{{ asset('js/plugins/bootstrap-selectpicker.js') }}"></script>
   <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
   <script src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
   <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
   <script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
   <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
   <script src="{{ asset('js/plugins/bootstrap-tagsinput.js') }}"></script>
   <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
   <script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}"></script>
   <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
   <script src="{{ asset('js/plugins/fullcalendar.min.js') }}"></script>
   <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
   <script src="{{ asset('js/plugins/jquery-jvectormap.js') }}"></script>
   <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
   <script src="{{ asset('js/plugins/nouislider.min.js') }}"></script>
   <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> --}}
   <!-- Library for adding dinamically elements -->
   <script src="{{ asset('js/plugins/arrive.min.js') }}"></script>
   <!--  Google Maps Plugin    -->
   {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
   <!-- Chartist JS -->
   <script src="{{ asset('js/plugins/chartist.min.js') }}"></script>
   <!--  Notifications Plugin    -->
   <script src="{{ asset('js/plugins/bootstrap-notify.js')}}"></script>
   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('js/material-dashboard.js?v=2.1.1') }}" type="text/javascript"></script>

   {{-- Select2js --}}
   <script src="{{asset('js/select2.min.js') }}"></script>
   {{-- DataTables --}}
   <script src="{{ asset('DataTables/datatables.js') }}"></script>
   {{-- <script src="{{ asset('DataTables/buttons.colVis.min.js') }}"></script> --}}
   <script>
    $('body').bootstrapMaterialDesign({});
   </script>
   <!-- Material Dashboard DEMO methods, don't include it in your project! -->
   <script src="{{ asset('demo/demo.js') }}"></script>
   <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   </script>
  <script src="{{ asset('js/umum.js') }}"></script>
  <script src="{{ asset('js/printThis/printThis.js') }}"></script>
  @if(Auth::user()->level == 'admin')
    <script src="{{ asset('js/dash-admin.js') }}"></script>
  @endif
  @if(Auth::user()->level == 'guru')
    <script src="{{ asset('js/dash-guru.js') }}"></script>
  @endif
   <script>
     $(document).ready(function() {
       $().ready(function() {
         $sidebar = $('.sidebar');
 
         $sidebar_img_container = $sidebar.find('.sidebar-background');
 
         $full_page = $('.full-page');
 
         $sidebar_responsive = $('body > .navbar-collapse');
 
         window_width = $(window).width();
 
         fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
 
         if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
           if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
             $('.fixed-plugin .dropdown').addClass('open');
           }
 
         }
 
         $('.fixed-plugin a').click(function(event) {
           // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
           if ($(this).hasClass('switch-trigger')) {
             if (event.stopPropagation) {
               event.stopPropagation();
             } else if (window.event) {
               window.event.cancelBubble = true;
             }
           }
         });
 
         $('.fixed-plugin .active-color span').click(function() {
           $full_page_background = $('.full-page-background');
 
           $(this).siblings().removeClass('active');
           $(this).addClass('active');
 
           var new_color = $(this).data('color');
 
           if ($sidebar.length != 0) {
             $sidebar.attr('data-color', new_color);
           }
 
           if ($full_page.length != 0) {
             $full_page.attr('filter-color', new_color);
           }
 
           if ($sidebar_responsive.length != 0) {
             $sidebar_responsive.attr('data-color', new_color);
           }
         });
 
         $('.fixed-plugin .background-color .badge').click(function() {
           $(this).siblings().removeClass('active');
           $(this).addClass('active');
 
           var new_color = $(this).data('background-color');
 
           if ($sidebar.length != 0) {
             $sidebar.attr('data-background-color', new_color);
           }
         });
 
         $('.fixed-plugin .img-holder').click(function() {
           $full_page_background = $('.full-page-background');
 
           $(this).parent('li').siblings().removeClass('active');
           $(this).parent('li').addClass('active');
 
 
           var new_image = $(this).find("img").attr('src');
 
           if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
             $sidebar_img_container.fadeOut('fast', function() {
               $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
               $sidebar_img_container.fadeIn('fast');
             });
           }
 
           if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
             var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
 
             $full_page_background.fadeOut('fast', function() {
               $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
               $full_page_background.fadeIn('fast');
             });
           }
 
           if ($('.switch-sidebar-image input:checked').length == 0) {
             var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
             var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
 
             $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
             $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
           }
 
           if ($sidebar_responsive.length != 0) {
             $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
           }
         });
 
         $('.switch-sidebar-image input').change(function() {
           $full_page_background = $('.full-page-background');
 
           $input = $(this);
 
           if ($input.is(':checked')) {
             if ($sidebar_img_container.length != 0) {
               $sidebar_img_container.fadeIn('fast');
               $sidebar.attr('data-image', '#');
             }
 
             if ($full_page_background.length != 0) {
               $full_page_background.fadeIn('fast');
               $full_page.attr('data-image', '#');
             }
 
             background_image = true;
           } else {
             if ($sidebar_img_container.length != 0) {
               $sidebar.removeAttr('data-image');
               $sidebar_img_container.fadeOut('fast');
             }
 
             if ($full_page_background.length != 0) {
               $full_page.removeAttr('data-image', '#');
               $full_page_background.fadeOut('fast');
             }
 
             background_image = false;
           }
         });
 
         $('.switch-sidebar-mini input').change(function() {
           $body = $('body');
 
           $input = $(this);
 
           if (md.misc.sidebar_mini_active == true) {
             $('body').removeClass('sidebar-mini');
             md.misc.sidebar_mini_active = false;
 
             $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
 
           } else {
 
             $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
 
             setTimeout(function() {
               $('body').addClass('sidebar-mini');
 
               md.misc.sidebar_mini_active = true;
             }, 300);
           }
 
           // we simulate the window Resize so the charts will get updated in realtime.
           var simulateWindowResize = setInterval(function() {
             window.dispatchEvent(new Event('resize'));
           }, 180);
 
           // we stop the simulation of Window Resize after the animations are completed
           setTimeout(function() {
             clearInterval(simulateWindowResize);
           }, 1000);
 
         });
       });
     });
   </script>
   <script>
     $(document).ready(function() {
       // Javascript method's body can be found in assets/js/demos.js
       md.initDashboardPageCharts();
 
     });
   </script>

 </body>
 
 </html>
 