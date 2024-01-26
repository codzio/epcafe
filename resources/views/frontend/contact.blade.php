@extends('vwFrontMaster')

@section('content')
    
<!--======= SUB BANNER =========-->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
<div class="position-center-center">
  <div class="container">
    <h4>contact us now</h4>
    <!--<p>We're Ready To Help! Feel Free To Contact With Us</p>-->
    <ol class="breadcrumb">
      <li><a href="{{ route('homePage') }}">Home</a></li>
      <li class="active">contact</li>
    </ol>
  </div>
</div>
</section>

<!-- Content -->
<div id="content"> 

<!--======= CONATACT  =========-->
<section class="contact padding-top-100 padding-bottom-100">
  <div class="container">
    <div class="contact-form">
      <h5>We're Ready To Help! <br> Feel Free To Contact With Us</h5>
      <div class="row">
        <div class="col-md-8"> 
          
          <!--======= Success Msg =========-->
          <div id="contact_message" class="success-msg"> <i class="fa fa-paper-plane-o"></i>Thank You. Your Message has been Submitted</div>
          
          <!--======= FORM  =========-->
          <form role="form" id="contact_form" class="contact-form" method="post" onSubmit="return false">
            <ul class="row">
              <li class="col-sm-6">
                <label>Full Name *
                  <input type="text" class="form-control" name="name" id="name" placeholder="">
                </label>
              </li>
              <li class="col-sm-6">
                <label>Email Address *
                  <input type="text" class="form-control" name="email" id="email" placeholder="">
                </label>
              </li>
              <li class="col-sm-6">
                <label>Phone Number *
                  <input type="text" class="form-control" name="company" id="company" placeholder="">
                </label>
              </li>
              <li class="col-sm-6">
                <label>SUBJECT
                  <input type="text" class="form-control" name="website" id="website" placeholder="">
                </label>
              </li>
              <li class="col-sm-12">
                <label>Write your Message
                  <textarea class="form-control" name="message" id="message" rows="5" placeholder=""></textarea>
                </label>
              </li>
              <li class="col-sm-12">
                <button type="submit" value="submit" class="btn" id="btn_submit" onClick="proceed();">SEND Message</button>
              </li>
            </ul>
          </form>
        </div>
        
        <!--======= ADDRESS INFO  =========-->
        <div class="col-md-4">
          <div class="contact-info">
            <h6>OUR ADDRESS</h6>
            <ul>
              <li> <i class="icon-map-pin"></i> Shyam Electrosatat, 11, Vikas Marg,<br>
                Veer Savarkar Block, Dayanand, <br> Colony, Shakarpur, Delhi, 110092</li>
              <li> <i class="icon-call-end"></i> <a href="tel:+91 8448193390">+91 8448193390</a></li>
              <li> <i class="icon-envelope"></i> <a href="mailto:mail@eprintcafe.in" target="_top">mail@eprintcafe.in</a> </li>
              <li>
                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam erat turpis, pellentesque non leo eget.</p>-->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--======= MAP =========-->
<div id="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.806775298312!2d77.28294207439598!3d28.63555268394547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfcaa1d8db7c5%3A0x54dc478a25d78281!2sShyam%20Electrostat!5e0!3m2!1sen!2sin!4v1701249756224!5m2!1sen!2sin" style="border:0; width: 100%;height:100%;" allowfullscreen="" loading="lazy"></iframe>
</div>

<!-- About -->
<!--<section class="small-about padding-top-150 padding-bottom-150">-->
<!--  <div class="container"> -->
    
    <!-- Main Heading -->
<!--    <div class="heading text-center">-->
<!--      <h4>about eprintcafe</h4>-->
<!--      <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odio luctus non. Nulla lacinia,-->
<!--        eros vel fermentum consectetur, risus purus tempc, et iaculis odio dolor in ex. </p>-->
<!--    </div>-->
    
    <!-- Social Icons -->
<!--    <ul class="social_icons">-->
<!--      <li><a href="#."><i class="icon-social-facebook"></i></a></li>-->
<!--      <li><a href="#."><i class="icon-social-twitter"></i></a></li>-->
<!--      <li><a href="#."><i class="icon-social-tumblr"></i></a></li>-->
<!--      <li><a href="#."><i class="icon-social-youtube"></i></a></li>-->
<!--      <li><a href="#."><i class="icon-social-dribbble"></i></a></li>-->
<!--    </ul>-->
<!--  </div>-->
<!--</section>-->

<!-- News Letter -->
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