<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
  <title>Luscious a Restaurant Category Bootstrap responsive WebTemplate | Home :: w3layouts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Luscious a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <script type="application/x-javascript">
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>

  <script>
    var base_url = '<?= url('/'); ?>';
    var site_url = '<?= url('/'); ?>';
    var site_name = '.: Restaurant Mantap :.';
  </script>

  <link href="{{asset('web/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
  <link href="{{asset('web/css/wickedpicker.css')}}" rel="stylesheet" type='text/css' media="all" />
  <link href="{{asset('web/css/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css' />
  <link href="{{asset('web/css/style.css')}}" rel='stylesheet' type='text/css' />
  <link href="{{asset('web/css/font-awesome.css')}}" rel="stylesheet">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
      rel='stylesheet' type='text/css'>
  <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="page-loader">
        <div class="spinner">
          <div class="ball"></div>
          <p class="loader-text">LOADING</p>
        </div>
    </div>
    
    @include('templates/header')

      @yield('content')

    @include('templates/footer')

    <!-- bootstrap-modal-pop-up -->
  <div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          Luscious
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            
        </div>
        <div class="modal-body">
          <img src="{{asset('web/images/banner1.jpg')}}" alt=" " class="img-responsive" />
          <p>Ut enim ad minima veniam, quis nostrum 
            exercitationem ullam corporis suscipit laboriosam, 
            nisi ut aliquid ex ea commodi consequatur? Quis autem 
            vel eum iure reprehenderit qui in ea voluptate velit 
            esse quam nihil molestiae consequatur, vel illum qui 
            dolorem eum fugiat quo voluptas nulla pariatur.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- //bootstrap-modal-pop-up --> 

  <!-- js -->
  <script type="text/javascript" src="{{asset('web/js/jquery-2.2.3.min.js')}}"></script>
  <!-- //js -->
  <!--search-bar-->
  <script src="{{asset('web/js/main.js')}}"></script>
  <!--//search-bar-->

  <!-- js for portfolio lightbox -->
  <script src="{{asset('web/js/jquery.chocolat.js')}} "></script>
  <link rel="stylesheet" href="{{asset('web/css/chocolat.css')}}" type="text/css" media="all" />
  <!--light-box-files -->
  <script type="text/javascript ">
    $(function () {
      $('.portfolio-grids a').Chocolat();
    });
  </script>
  <!-- /js for portfolio lightbox -->
  <!-- Calendar -->
  <link rel="stylesheet" href="{{asset('web/css/jquery-ui.css')}}" />
  <script src="{{asset('web/js/jquery-ui.js')}}"></script>
  <script>
    $(function () {
      $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
    });
  </script>
  <!-- //Calendar -->

  <!-- time -->
  <script type="text/javascript" src="{{asset('web/js/wickedpicker.js')}}"></script>
  <script type="text/javascript">
    $('.timepicker').wickedpicker({
      twentyFour: false
    });
  </script>
  <!-- //time -->

  <script src="{{asset('web/js/responsiveslides.min.js')}}"></script>
  <script>
    $(function () {
      $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 1000,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });
    });
  </script>
  <!-- script for responsive tabs -->
  <script src="{{asset('web/js/easy-responsive-tabs.js')}}"></script>
  <script>
    $(document).ready(function () {
      $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion           
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: 'accordion', // Start closed if in accordion view
        activate: function (event) { // Callback function if tab is switched
          var $tab = $(this);
          var $info = $('#tabInfo');
          var $name = $('span', $info);
          $name.text($tab.text());
          $info.show();
        }
      });
      $('#verticalTab').easyResponsiveTabs({
        type: 'vertical',
        width: 'auto',
        fit: true
      });
    });
  </script>
  <!--// script for responsive tabs -->
  <!-- start-smoth-scrolling -->
  <script type="text/javascript" src="{{asset('web/js/move-top.js')}}"></script>
  <script type="text/javascript" src="{{asset('web/js/easing.js')}}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 900);
      });
    });
  </script>
  <!-- start-smoth-scrolling -->

  <script type="text/javascript">
    $(document).ready(function () {
      /*
                  var defaults = {
                      containerID: 'toTop', // fading element id
                    containerHoverID: 'toTopHover', // fading element hover id
                    scrollSpeed: 1200,
                    easingType: 'linear' 
                  };
                  */

      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  </script>


  <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
  <script type="text/javascript" src="{{asset('web/js/bootstrap-3.1.1.min.js')}}"></script>

  <script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/Chart.js')}}" type="text/javascript"></script>    
  <script src="{{asset('js/FileSaver.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/my_validator.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/main.js')}}" type="text/javascript"></script>

  <script type="text/javascript">

      $(function(){
          setNavigation();
      });

      $(window).load(function(){
          clearLoading();
          $('body').css('overflow','auto');
      });

      $(".header-navigation li a").click(function(){
        $(".header-navigation").find(".dropdown").removeClass("active");
        $(this).closest(".dropdown").addClass("active");
      })
      

      function setNavigation(){
          var path = window.location.pathname;
          path = path.replace(/\/$/,"");
          path = decodeURIComponent(path);

          $(".header-navigation").find(".dropdown").removeClass("active");
          if(path.length > 0)
          {
            $(".header-navigation li a").each(function(){
                var href = $(this).attr('href');
                if(href.indexOf(path) !== -1){
                    $(this).closest(".dropdown").addClass("active");
                }
            })
          }
          else
            $(".header-navigation").find("#home").addClass("active");

      }

      function searching(keyword)
      {
        if(keyword)
          location.href = site_url+'/searching/'+keyword;
        else
          return false;
      }

  </script>

  <script type="text/javascript">      
    var auth = '{{Auth::check()}}'
    if (auth == 1) {
      var idleTime = 0; 
      jQuery(document).ready(function() {    
          //Increment the idle time counter every minute.
          var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
          //Zero the idle timer on mouse movement.
          $(this).mousemove(function (e) {
              idleTime = 0;
              console.log(idleTime);
          });
          $(this).keypress(function (e) {        
              idleTime = 0;
              console.log(idleTime);
          });    
      });

      function timerIncrement() {
          idleTime = idleTime + 1;
          if (idleTime > 19) { // 20 minutes
              // window.location.reload();        
              window.location = base_url+"/logout";
              // SessionTimeoutDemo.init();
          }
      }
      
    }
  </script>

  @stack('scripts')

  <!-- END PAGE LEVEL JAVASCRIPTS -->


</body>

</html>

    

</body>
<!-- END BODY -->
</html>