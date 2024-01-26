@extends('vwFrontMaster')

@section('content')
    
  <!--======= HOME MAIN SLIDER =========-->
  <section class="home-slider home_banner_main"> 
    
    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="{{ asset('public/frontend') }}/images/home_banner_img.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            <!-- LAYER NR. 1 -->
            <div class="home_banner_slides">
              <div class="tp-caption font-playfair sfb tp-resizeme" 
                data-x="left" data-hoffset="0" 
                data-y="center" data-voffset="-200" 
                data-speed="800" 
                data-start="500" 
                data-easing="Power3.easeInOut" 
                data-splitin="none" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 7; font-size:18px; position:unset; top: 10%; color:#fff; max-width: auto; max-height: auto; white-space: nowrap;">Best Printing Company In Delhi</div>
              <!-- LAYER NR. 2 -->
              <div class="tp-caption sfr font-extra-bold tp-resizeme" 
                  data-x="left" data-hoffset="0" 
                  data-y="center" data-voffset="0" 
                  data-speed="800" 
                  data-start="800" 
                  data-easing="Power3.easeInOut" 
                  data-splitin="chars" 
                  data-splitout="none" 
                  data-elementdelay="0.07" 
                  data-endelementdelay="0.1" 
                  data-endspeed="300" 
                  style="z-index: 6; font-size:60px; position:unset; top:25%; color:#fff; text-transform:none; white-space: nowrap; margin-bottom:-2%;">Your Ultimate Destination for 
               </div>
              <!-- LAYER NR. 3 -->
              <div class="tp-caption sfr font-extra-bold tp-resizeme" 
                  data-x="left" data-hoffset="0" 
                  data-y="center" data-voffset="110" 
                  data-speed="800" 
                  data-start="1300" 
                  data-easing="Power3.easeInOut" 
                  data-splitin="chars" 
                  data-splitout="none" 
                  data-elementdelay="0.07" 
                  data-endelementdelay="0.1" 
                  data-endspeed="300" 
                  style="z-index: 6; font-size:60px; position:unset;  top:48%; color:#fff; text-transform:none; white-space: nowrap; top:0; margin-top:-4%;">Hassle-Free Online Printing 
              </div>
                <!-- LAYER NR. 4 -->
              <div class="tp-caption lfb tp-resizeme" 
                data-x="left" data-hoffset="0" 
                data-y="center" data-voffset="240" 
                data-speed="800" 
                data-start="2200" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8; position:unset;"><a href="shop_01.html" class="btn">PRINT NOW</a> 
              </div>
            </div>


          </li>
          
          <!-- SLIDE  -->
          <!--<li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > -->
            <!-- MAIN IMAGE --> 
          <!--  <img src="{{ asset('public/frontend') }}/images/home_banner_img.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> -->
            <!-- LAYERS --> 
          <!--  <div class="home_banner_slides">-->
              <!-- LAYER NR. 1 -->
          <!--    <div class="tp-caption font-playfair sfb tp-resizeme" -->
          <!--        data-x="center" data-hoffset="0" -->
          <!--        data-y="center" data-voffset="-150" -->
          <!--        data-speed="800" -->
          <!--        data-start="500" -->
          <!--        data-easing="Power3.easeInOut" -->
          <!--        data-splitin="none" -->
          <!--        data-splitout="none" -->
          <!--        data-elementdelay="0.1" -->
          <!--        data-endelementdelay="0.1" -->
          <!--        data-endspeed="300" -->
          <!--        style="z-index: 7; font-size:18px; position:unset; color:#fff; max-width: auto; max-height: auto; white-space: nowrap;">The Latest Product from ecoshop-->
          <!--    </div>-->
              <!-- LAYER NR. 2 -->
          <!--    <div class="tp-caption sfr font-regular tp-resizeme letter-space-4" -->
          <!--        data-x="center" data-hoffset="0" -->
          <!--        data-y="center" data-voffset="-50" -->
          <!--        data-speed="800" -->
          <!--        data-start="800" -->
          <!--        data-easing="Power3.easeInOut" -->
          <!--        data-splitin="chars" -->
          <!--        data-splitout="none" -->
          <!--        data-elementdelay="0.07" -->
          <!--        data-endelementdelay="0.1" -->
          <!--        data-endspeed="300" -->
          <!--        style="z-index: 6; position:unset; font-size:60px; color:#fff; margin-bottom:-2%; text-transform:uppercase; white-space: nowrap; margin-bottom:-2%;">look beautiful -->
          <!--    </div>-->
              <!-- LAYER NR. 3 -->
          <!--    <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4" -->
          <!--        data-x="center" data-hoffset="0" -->
          <!--        data-y="center" data-voffset="60" -->
          <!--        data-speed="800" -->
          <!--        data-start="1300" -->
          <!--        data-easing="Power3.easeInOut" -->
          <!--        data-splitin="chars" -->
          <!--        data-splitout="none" -->
          <!--        data-elementdelay="0.07" -->
          <!--        data-endelementdelay="0.1" -->
          <!--        data-endspeed="300" -->
          <!--        style="z-index: 6; position:unset; font-size:60px; color:#fff; text-transform:uppercase; white-space: nowrap; margin:-42px 0 -78px;">this season-->
          <!--    </div>-->
              <!-- LAYER NR. 4 -->
          <!--    <div class="tp-caption sfb font-extra-bold tp-resizeme" -->
          <!--        data-x="center" data-hoffset="120"-->
          <!--        data-y="center" data-voffset="200"-->
          <!--        data-speed="800" -->
          <!--        data-start="2200" -->
          <!--        data-easing="Power3.easeInOut" -->
          <!--        data-splitin="none" -->
          <!--        data-splitout="none" -->
          <!--        data-elementdelay="0.07" -->
          <!--        data-endelementdelay="0.1" -->
          <!--        data-endspeed="300" -->
          <!--        style="z-index: 6; position:unset; font-size:60px; color:#fff; text-transform:uppercase; white-space: nowrap;"><small class="font-regular">$</small> 299 -->
          <!--    </div>-->
              <!-- LAYER NR. 5 -->
          <!--    <div class="tp-caption lfb tp-scrollbelowslider tp-resizeme" -->
          <!--        data-x="center" data-hoffset="-120" -->
          <!--        data-y="center" data-voffset="200" -->
          <!--        data-speed="800" -->
          <!--        data-start="2200" -->
          <!--        data-easing="Power3.easeInOut" -->
          <!--        data-elementdelay="0.1" -->
          <!--        data-endelementdelay="0.1" -->
          <!--        data-endspeed="300" -->
          <!--        data-scrolloffset="0"-->
          <!--        style="z-index: 8; position:unset;"><a href="shop_01.html" class="btn">BUY NOW</a> -->
          <!--      </div>-->
          <!--  </div>-->
          <!--</li>-->
        </ul>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    @if(!empty($categoryList) && $categoryList->count())
    <!-- New Arrival -->
    <section class="padding-top-100 home_page_card" style="padding-bottom:50px;">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>Best Services For Printing</h4>
          <span>Welcome to Eprintcafe.in, An initiative of India Inttech Pvt. Ltd. ( Shyam Electrostat - Since 1990), your dedicated offline convenience printing store !</span> </div>
      </div>
      
      <div class="container">
        <!-- New Arrival -->
      <div class="arrival-bock"> 
        <div class="papular-block row single-img-demos for_card_listing"> 
          @foreach($categoryList as $category)
          <!-- Item -->
          <div class="col-md-3">
            <div class="item"> 
              <!-- Item img -->
              <a href="{{ route('categoryPage', ['slug' => $category->category_slug]) }}">
                <div class="item-img"> <img class="img-1" src="{{ getImg($category->category_img) }}" alt=""> 
                  <!-- Overlay -->
                  <div class="overlay">
                    <!-- <div class="position-center-center">
                      <div class="inn">
                        <div href="images/categories/documents.png" data-lighter=""><i class="icon-magnifier"></i></div>
                        <div href="#."><i class="icon-basket"></i></div>
                        <div href="#."><i class="icon-heart"></i></div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </a>
              <!-- Item Name -->
              <div class="item-name"> <a href="{{ route('categoryPage', ['slug' => $category->category_slug]) }}">{{ $category->category_name; }}</a>
                <!--<p>Lorem ipsum dolor sit amet</p>-->
              </div>
              <!-- Price --> 
              <!-- <span class="price"><small>$</small>299</span>  -->
            </div>
          </div>
          @endforeach;
          
           
        </div>
      </div>
    </section>
    @endif
    
    @if(!empty($popularProds) && $popularProds->count())
    <section class="padding-top-50 home_page_card" style="padding-bottom:50px;">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>Popular Products</h4>
          <!--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula. -->
          <!--Sed feugiat, tellus vel tristique posuere, diam</span> </div>-->
        
        <!-- Popular Item Slide -->
        <div class="papular-block block-slide single-img-demos">
          
          @foreach($popularProds as $popProd)
          <div class="item"> 
            <!-- Item img -->
            <a href="{{ route('productPage', ['slug' => $popProd->slug]) }}">
                <div class="item-img"> <img class="img-1" src="{{ getImg($popProd->thumbnail_id) }}" alt=""> 
                  <!-- Overlay -->
                  <div class="overlay">
                    <!-- <div class="position-center-center">
                      <div class="inn">
                        <div href="images/categories/documents.png" data-lighter=""><i class="icon-magnifier"></i></div>
                        <div href="#."><i class="icon-basket"></i></div>
                        <div href="#."><i class="icon-heart"></i></div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </a>
            <!-- Item Name -->
            <div class="item-name"> <a href="{{ route('productPage', ['slug' => $popProd->slug]) }}">{{ $popProd->name }}</a>
              <!--<p>Lorem ipsum dolor sit amet</p>-->
            </div>
            <!-- Price --> 
            <!-- <span class="price"><small>$</small>299</span>  -->
          </div>
          @endforeach

        </div>
      </div>
    </section>
    @endif
    
    <!-- Knowledge Share -->
    <section class="light-gray-bg padding-top-50" style="padding-bottom:50px;">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading home_about_compnay text-center">
          <h4 style="color:var(--secondary-color-3);">About Company</h4>
          <h2 style="margin:auto; width:72%;">Your Ultimate Destination For Hassle-Free Online Printing</h2>
          <div class="more_than_year">
            <h4>We Have More than <strong style="color:var(--secondary-color-3);">33</strong> Years Of Experience in Printing Services</h4>
          </div>
          <span style="width:100%; margin-bottom:35px;">Welcome to Eprintcafe.in, An initiative of India Inttech Pvt. Ltd. ( Shyam Electrostat - Since 1990), your dedicated offline convenience printing store ! We understand the value of your time and energy, which is why our platform is designed to provide you with easy access to high-quality online printing services. Say goodbye to the hassles of traditional printing – we're here to redefine your printing experience.
          </span> 
          <a href="about-us_01.html" class="theme-btn mt-20 home_btn">Know More <i class="lnr lnr-arrow-right"></i></a>
        </div>
      </div>
    </section>

    <!-- home cards sec -->

    <section class="light-gray-bg padding-top-50" style="padding-bottom:50px;">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading home_about_compnay text-center">
          <h4 style="color:var(--secondary-color-3)">Company Statistics</h4>
          <h2 style="width:72%; margin:auto;">See Our Statistics That We Record To Achieve Our Clients</h2>
        </div>
        <div class="home_counter_card_sec padding-top-50">           
          <div class="counter-container">
            <!-- <i class="fab fa-twitter fax-3x"></i> -->
            <p>+</p>
            <span>On-Time Delivery </span>
            <div class="counter" data-target="100"></div>
          </div>
          <div class="counter-container">
            <!-- <i class="fab fa-youtube fax-3x"></i> -->
            <p>+</p>
            <span>Project We Completed Along the Way</span>
            <div class="counter" data-target="900"></div>
          </div>
          <div class="counter-container">
            <!-- <i class="fab fa-facebook fax-3x"></i> -->
            <p>+</p>
            <span>Error-Free Print Percentage</span>
            <div class="counter three" data-target="100"></div>
          </div>
          <div class="counter-container">
            <!-- <i class="fab fa-facebook fax-3x"></i> -->
            <p>+</p>
            <span>We Have Many Years Of Experience</span>
            <div class="counter" data-target="33"></div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Testimonial -->
    <section class="testimonial" style="margin-top:40px;">
      <div class="container">
        <div class="row">
          <div class="col-12"> 
            
            <!-- SLide -->
            <div class="single-slide"> 
              
              <!-- Slide -->
              <div class="testi-in"> <i class="fa fa-quote-left"></i>
                <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed ullamcorper sapien lacus, eu posuere odio luctus non. Nulla lacinia, eros vel fermentum consectetur, risus p</p>
                <h5>john smith</h5>
              </div>
              
              <!-- Slide -->
              <div class="testi-in"> <i class="fa fa-quote-left"></i>
                <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed ullamcorper sapien lacus, eu posuere odio luctus non. Nulla lacinia, eros vel fermentum consectetur, risus p</p>
                <h5>faizan</h5>
              </div>
              
              <!-- Slide -->
              <div class="testi-in"> <i class="fa fa-quote-left"></i>
                <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed ullamcorper sapien lacus, eu posuere odio luctus non. Nulla lacinia, eros vel fermentum consectetur, risus p</p>
                <h5>arsalan</h5>
              </div>
            </div>
          </div>
          
          <!-- Img -->
          <!-- <div class="col-sm-6"> <img class="img-responsive" src="{{ asset('public/frontend') }}/images/testi-avatar.jpg" alt=""> </div> -->
        </div>
      </div>
    </section>
    
    <!-- About -->
    <section class="small-about" style="padding-bottom:40px;">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <!-- <h4>about ecoshop</h4> -->
          <!-- <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odio luctus non. Nulla lacinia, -->
            <!-- eros vel fermentum consectetur, risus purus tempc, et iaculis odio dolor in ex. </p> -->
        </div>
        
        <!-- Social Icons -->
        <!--<ul class="social_icons">-->
        <!--  <li><a href="#."><i class="icon-social-facebook"></i></a></li>-->
        <!--  <li><a href="#."><i class="icon-social-twitter"></i></a></li>-->
        <!--  <li><a href="#."><i class="icon-social-tumblr"></i></a></li>-->
        <!--  <li><a href="#."><i class="icon-social-youtube"></i></a></li>-->
        <!--  <li><a href="#."><i class="icon-social-dribbble"></i></a></li>-->
        <!--</ul>-->
      </div>
    </section>
    <!--<section class="news-letter padding-top-150 padding-bottom-150">-->
    <!--  <div class="container">-->
    <!--    <div class="heading light-head text-center margin-bottom-30">-->
    <!--      <h4>NEWSLETTER</h4>-->
    <!--      <span>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odi </span> </div>-->
    <!--    <form>-->
    <!--      <input type="email" placeholder="Enter your email address" required>-->
    <!--      <button type="submit">SEND ME</button>-->
    <!--    </form>-->
    <!--  </div>-->
    <!--</section>-->
  </div>

@endsection