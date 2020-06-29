@extends('templates/index')

@section('title', $title)
@section('content')

<div class="news" id="about">
    <div class="container">
      <div class="news-main_wthree_agile">
        <div class="col-md-6 news-left">
          <h2>OUR INTERESTING HISTORY</h2>
        </div>
        <div class="col-md-6 news-right">
          <p>Etiam faucibus viverra libero vel efficitur. Ut semper nisl ut laoreet ultrices. Maecenas dictum arcu purus, sit amet
            volutpat purus viverra sit amet. Quisque lacinia quam sed tortor interdum, malesuada congue nunc ornare. Cum sociis
            natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In semper lorem eget tortor pulvinar ultricies.
          </p>
          <p>Etiam faucibus viverra libero vel efficitur. Ut semper nisl ut laoreet ultrices. Maecenas dictum arcu purus, sit amet
            volutpat purus viverra sit amet. Quisque lacinia quam sed tortor interdum, malesuada congue nunc ornare. Cum sociis
            natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In semper lorem eget tortor pulvinar ultricies.
          </p>
        </div>

        <div class="clearfix"></div>
        <div class="mid_slider">
          <!-- banner -->
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1" class=""></li>
              <li data-target="#myCarousel" data-slide-to="2" class=""></li>
              <li data-target="#myCarousel" data-slide-to="3" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal1.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal2.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal3.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal4.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal5.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal6.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal2.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal1.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal1.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal2.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal3.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal4.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal1.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal2.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal3.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                    <div class="thumbnail"><img src="{{asset('web/images/gal4.jpg')}}" alt="Image" style="max-width:100%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="fa fa-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="fa fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
            <!-- The Modal -->
          </div>
          <!--//banner -->

        </div>
      </div>
    </div>
  </div>
  <!--/services-->
  <div class="work" id="services">
    <div class="container">
      <div class="work-main">
        <div class="work-top">
          <h3>Our Services</h3>
          <p>Lorem ipsum dolor sit amet,vehicula vel sapien et</p>
        </div>
        <div class="work-bottom_w3ls_agile">
          <div class="work-bottom-top">
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-spoon" aria-hidden="true"></span>
                <h4>Fresh Products</h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-apple" aria-hidden="true"></span>
                <h4>Healthy Food</h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-home" aria-hidden="true"></span>
                <h4>Traditional Methods
                </h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>
            </div>

            <div class="clearfix"></div>
          </div>
          <div class="work-bottom-top">
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-calendar" aria-hidden="true"></span>
                <h4>Advance Booking</h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-smile-o" aria-hidden="true"></span>
                <h4>Best Chefs</h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>

            </div>
            <div class="col-md-4">
              <div class="work-bottom-left_agile_w3ls">
                <span class="fa fa-child" aria-hidden="true"></span>
                <h4>150 Tables
                </h4>
                <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. </p>
              </div>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--//services-->
  <!--/about-->
  <div class="about" id="about_one">
    <div class="container">
      <div class="about-main_w3_agileits">
        <div class="col-md-6 about-left">
          <img src="{{asset('web/images/chef.jpg')}}" alt="">
        </div>
        <div class="col-md-6 about-right_agileits">
          <h3>For Goof Taste</h3>
          <p>Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a class="active" href="#" data-toggle="modal" data-target="#myModal">Learn more</a>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <!--//about-->
  <!--/tab_section-->
  <div class="tabs_section" id="menu">
    <div class="container">
      <h5>Special Menu</h5>
      <div id="horizontalTab">
        <ul class="resp-tabs-list">
          <li> BREAKFAST</li>
          <li> LUNCH</li>
          <li> DRINKS</li>
          <li> SNACKS</li>
        </ul>
        <div class="resp-tabs-container">

          <div class="tab1">
            <div class="recipe-grid">
              <?php 
                $angka = 1; 
                $count_breaks = count($food_breakfast);
              ?>
              @foreach($food_breakfast as $breaks)
                @if($angka == 1 || $angka == 4)
                <div class="col-md-6 menu-grids">
                @endif
                  <div class="menu-text_wthree">
                    <div class="menu-text-left">
                      <div class="rep-img">
                        <img src="{{asset($breaks->PHOTO)}}" alt=" " class="img-responsive" style="max-height: 100px;max-width: 100px;">
                      </div>
                      <div class="rep-text">
                        <h4>{{$breaks->MENU_NAME}}</h4>                        
                      </div>

                      <div class="clearfix"> </div>
                    </div>
                    <div class="menu-text-right">
                      <h4>{{number_format($breaks->PRICE,0,",",".")}}</h4>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                @if($angka == 3 || $angka == 6 || ($angka < 3 && $count_breaks == $angka) || ($angka < 6 && $count_breaks == $angka))
                </div>
                @endif


                <?php                  
                  $angka++; 
                ?>
              @endforeach
              <div class="clearfix"> </div>
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="tab2">
            <div class="recipe-grid">
              <?php 
                $angka = 1; 
                $count_lunch = count($food_lunch);
              ?>
              @foreach($food_lunch as $lunchs)
                @if($angka == 1 || $angka == 4)
                <div class="col-md-6 menu-grids">
                @endif
                  <div class="menu-text_wthree">
                    <div class="menu-text-left">
                      <div class="rep-img">
                        <img src="{{asset($lunchs->PHOTO)}}" alt=" " class="img-responsive" style="max-height: 100px;max-width: 100px;">
                      </div>
                      <div class="rep-text">
                        <h4>{{$lunchs->MENU_NAME}}</h4>                        
                      </div>

                      <div class="clearfix"> </div>
                    </div>
                    <div class="menu-text-right">
                      <h4>{{number_format($lunchs->PRICE,0,",",".")}}</h4>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                @if($angka == 3 || $angka == 6 || ($angka < 3 && $count_lunch == $angka) || ($angka < 6 && $count_lunch == $angka))
                </div>
                @endif


                <?php                  
                  $angka++; 
                ?>
              @endforeach

              <div class="clearfix"> </div>
            </div>

            <div class="clearfix"></div>

          </div>

          <div class="tab3">
            <div class="recipe-grid">
              <?php 
                $angka = 1; 
                $count_drink = count($drink);
              ?>
              @foreach($drink as $drinks)
                @if($angka == 1 || $angka == 4)
                <div class="col-md-6 menu-grids">
                @endif
                  <div class="menu-text_wthree">
                    <div class="menu-text-left">
                      <div class="rep-img">
                        <img src="{{asset($drinks->PHOTO)}}" alt=" " class="img-responsive" style="max-height: 100px;max-width: 100px;">
                      </div>
                      <div class="rep-text">
                        <h4>{{$drinks->MENU_NAME}}</h4>                        
                      </div>

                      <div class="clearfix"> </div>
                    </div>
                    <div class="menu-text-right">
                      <h4>{{number_format($drinks->PRICE,0,",",".")}}</h4>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                @if($angka == 3 || $angka == 6 || ($angka < 3 && $count_drink == $angka) || ($angka < 6 && $count_drink == $angka))
                </div>
                @endif


                <?php
                  $angka++; 
                ?>
              @endforeach
              <div class="clearfix"> </div>
            </div>

            <div class="clearfix"></div>
          </div>
          <div class="tab4">

            <?php 
              $angka = 1; 
              $count_snack = count($snack);
            ?>
              @foreach($snack as $snacks)
                @if($angka == 1 || $angka == 4)
                <div class="col-md-6 menu-grids">
                @endif
                  <div class="menu-text_wthree">
                    <div class="menu-text-left">
                      <div class="rep-img">
                        <img src="{{asset($snacks->PHOTO)}}" alt=" " class="img-responsive" style="max-height: 100px;max-width: 100px;">
                      </div>
                      <div class="rep-text">
                        <h4>{{$snacks->MENU_NAME}}</h4>                        
                      </div>

                      <div class="clearfix"> </div>
                    </div>
                    <div class="menu-text-right">
                      <h4>{{number_format($snacks->PRICE,0,",",".")}}</h4>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                @if($angka == 3 || $angka == 6 || ($angka < 3 && $count_snack == $angka) || ($angka < 6 && $count_snack == $angka))
                </div>
                @endif


                <?php
                  $angka++; 
                ?>
              @endforeach
            <div class="clearfix"> </div>
          </div>


          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /tabs -->
  <!--//tab_section-->
  <!--/services-->
  <div class="choose">
    <div class="container">
      <div class="choose-main">
        <div class="col-md-5 choose-left">
          <h2>SPECIAL SERVICES</h2>
        </div>
        <div class="col-md-7 choose-right">
          <div class="col-md-6 choose-right-top">
            <h4>Best Chef</h4>
            <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. Morbi vulputate tempor
              nisl nec tristique.</p>
          </div>
          <div class="col-md-6 choose-right-top">
            <h4>150 Tables</h4>
            <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. Morbi vulputate tempor
              nisl nec tristique.</p>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6 choose-right-top">
            <h4>Card Payment</h4>
            <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. Morbi vulputate tempor
              nisl nec tristique. </p>
          </div>
          <div class="col-md-6 choose-right-top">
            <h4>Special Offers</h4>
            <p>Duis sit amet posuere justo, sit amet finibus urna. Aenean elementum diam nec laoreet sodales. Morbi vulputate tempor
              nisl nec tristique.</p>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <!--//services-->
  <!--/gallery-->
  <div class="gallery" id="gallery">
    <div class="container">
      <div class="gallery-main">
        <div class="gallery-top">
          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal6.jpg')}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal6.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>

          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal5.jpg')}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal5.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>
          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal4jpg"')}} class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal4.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>
          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal3.jpg')}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal3.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>
          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal3.jpg')}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal3.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>
          <div class="gallery-top-img portfolio-grids">
            <a href="{{asset('web/images/gal1.jpg')}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                  <img src="{{asset('web/images/gal1.jpg')}}" class="img-responsive" alt="" />
                  <div class="p-mask">
                    <h4><span>Heading here</span></h4>
                  </div>
                </a>

          </div>
          <div class="gallery-top-img">
            <h3>OUR SPECIALS</h3>
            <span> </span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="gallery-bottom">
          <div class="col-md-6 gallery-bottom-text">
            <p>Etiam faucibus viverra libero vel efficitur. Ut semper nisl ut laoreet ultrices. Maecenas dictum arcu purus, sit amet
              volutpat purus viverra sit amet. Quisque lacinia quam sed tortor interdum, malesuada congue nunc ornare. Cum sociis
              natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In semper lorem eget tortor pulvinar ultricies.</p>
          </div>
          <div class="col-md-6 gallery-bottom-text">
            <p>Etiam faucibus viverra libero vel efficitur. Ut semper nisl ut laoreet ultrices. Maecenas dictum arcu purus, sit amet
              volutpat purus viverra sit amet. Quisque lacinia quam sed tortor interdum, malesuada congue nunc ornare. Cum sociis
              natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In semper lorem eget tortor pulvinar ultricies.</p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!--//gallery-->
  <div class="reservation" id="book">
    <div class="book-form">
      <h4>Prearrange a Table.</h4>
      <form action="#" method="post">
        <div class="col-md-4 form-time">
          <label><i class="fa fa-clock-o" aria-hidden="true"></i></label>
          <input type="text" id="timepicker" name="Time" placeholder="Time" class="timepicker form-control hasWickedpicker" value="Time"
              onkeypress="return false;" required="">
        </div>
        <div class="col-md-4 form-date">
          <label><i class="fa fa-calendar" aria-hidden="true"></i> </label>
          <input id="datepicker1" name="Text" type="text" value="mm/dd/yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
              required="">
        </div>
        <div class="col-md-4 form-left">
          <label><i class="fa fa-users" aria-hidden="true"></i></label>
          <select class="form-control">
                <option>No.of People</option>
                <option>1 Person</option>
                <option>2 People</option>
                <option>3 People</option>
                <option>4 People</option>
                <option>5 People</option>
                <option>More</option>
              </select>
        </div>
        <div class="clearfix"> </div>
        <div class="col-md-3 form-left">
          <ul>
            <li><i class="fa fa-check-square-o" aria-hidden="true"></i>Over 10,000 restaurants Worldwide</li>
            <li><i class="fa fa-check-square-o" aria-hidden="true"></i>No booking fees</li>
          </ul>
        </div>
        <div class="col-md-3 form-left-submit">
          <input type="submit" value="Book a table">
        </div>
        <div class="clearfix"> </div>
      </form>

    </div>

  </div>
  <!--/customer-->
  <div class="comments" id="client">
    <div class="container">
      <div class="comments-main">
        <div class="comments-head">
          <h3>Comments from our customers</h3>
          <p>Lorem ipsum dolor sit amet,vehicula vel sapien et</p>
        </div>
        <div class="comments-top">
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Paul Demichev</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Oleg Topanic</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Julia Usina</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.

              </p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Serdyuk Elena</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.
              </p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Kulikov Vlad</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-4 comments-bottom">
            <div class="comments-left">
              <span class="fa fa-quote-right"></span>
            </div>
            <div class="comments-right">
              <h3>Andrey Tikhonov</h3>
              <p class="para1">Client,Some Company</p>
              <p class="para2">Nulla sodales efficitur consequat. Maecenas mi diam, imperdiet consectetur ultricies nec, convallis sit amet turpis.</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!--//customer-->

@endsection

@push('scripts')
<script type="text/javascript">

  $('#monthpicker').datepicker({
    autoclose: true,
    format: "MM-yyyy",
    startView: "months", 
    minViewMode: "months"
  });

</script>
@endpush