<!--Header-->
  <div class="header" id="home">
    <!--/top-bar-->
    <div class="top-bar">
      <div class="header-top_w3layouts">
        <div class="forms">
          <p><span class="fa fa-map-marker" aria-hidden="true"></span>Parma Via Modena,BO, Italy</p>
          <p><span class="fa fa-envelope-o" aria-hidden="true"></span> <a href="mailto:info@example.com">info@example.com</a></p>
        </div>
        <ul class="top-right-info">
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

        </ul>        
        <div class="clearfix"></div>

      </div>
      <div class="header-nav">
        <nav class="navbar navbar-default">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
            <h1><a class="navbar-brand" href="index.html">L<span>uscious</span></a></h1>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
            <nav>
              <ul class="top_nav">
                <li><a class="scroll" href="#home" class="active">Home</a></li>
                <li><a class="scroll" href="#about">About</a></li>
                <li><a class="scroll" href="#services">Services</a></li>
                <li class="dropdown menu__item">
                  <a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" data-hover="Pages" role="button" aria-haspopup="true"
                      aria-expanded="false">Drop Down <span class="fa fa-angle-down"></span></a>
                  <ul class="dropdown-menu">
                    <li><a class="scroll" href="#menu">Menu</a></li>
                    <li><a class="scroll" href="#book">Booking</a></li>
                  </ul>
                </li>
                <li><a class="scroll" href="#gallery">Gallery</a></li>
                <li><a class="scroll" href="#mail">Contact</a></li>
                @if(Auth::check())                
                <li><a href="{{url('dashboard')}}">Dashboard ({{Auth::user()->USER_NAME}})</a></li>
                @else
                <li><a href="{{url('login')}}">Login</a></li>                
                @endif
              </ul>
            </nav>
          </div>
        </nav>

      </div>
    </div>
      <!--//top-bar-->
    <!-- banner-text -->
    <div class="slider">
      <div class="callbacks_container">
        <ul class="rslides callbacks callbacks1" id="slider4">
          <li>
            <div class="banner-top">
              <div class="banner-info_agile_w3ls">
                <h3>Come hungry. <span>Leave</span> happy.</h3>
                <p>Small change,Big differences.</p>
                <a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>
              </div>

            </div>
          </li>
          <li>
            <div class="banner-top1">
              <div class="banner-info_agile_w3ls">
                <h3>Better Ingredients. <span> Better</span> Food.</h3>
                <p>Small change,Big differences.</p>
                <a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>
              </div>

            </div>
          </li>
          <li>
            <div class="banner-top2">
              <div class="banner-info_agile_w3ls">
                <h3>Come hungry. <span>Leave</span> happy.</h3>
                <p>Small change,Big differences.</p>
                <a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>
              </div>

            </div>
          </li>
          <li>
            <div class="banner-top3">
              <div class="banner-info_agile_w3ls">
                <h3>Better Ingredients. <span> Better</span> Food.</h3>
                <p>Small change,Big differences.</p>
                <a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                <a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>
              </div>

            </div>
          </li>
        </ul>
      </div>
      <div class="clearfix"> </div>

      <!--banner Slider starts Here-->
    </div>
    <!-- //Modal1 -->
    <!--//Slider-->
  </div>
<!--//Header-->