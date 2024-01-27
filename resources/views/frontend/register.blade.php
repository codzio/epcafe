@extends('vwFrontMaster')

@section('content')
    

<!--======= SUB BANNER =========-->
  <section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
      <div class="container">
        <h4>REGISTER</h4>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula.  -->
          <!-- Sed feugiat, tellus vel tristique posuere, diam</p> -->
        <ol class="breadcrumb">
          <li><a href="{{ route('homePage') }}">Home</a></li>
          <li class="active">REGISTER</li>
        </ol>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info register">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-12">
                <h6>REGISTER</h6>
                <form id="registerForm" method="post">
                  <ul class="row">
                    
                    <!-- Name -->
                    <li class="col-md-6">
                      <label> *NAME
                        <input type="text" name="name" value="" placeholder="">
                      </label>
                      <span class="errors" id="nameErr"></span>
                    </li>
                    
                    <!-- EMAIL ADDRESS -->
                    <li class="col-md-6">
                      <label> *EMAIL ADDRESS
                        <input type="text" name="email" value="" placeholder="">
                      </label>
                      <span class="errors" id="emailErr"></span>
                    </li>

                    <!-- PHONE -->
                    <li class="col-md-6">
                      <label> *MOBILE NUMBER
                        <input type="text" name="phone" value="" placeholder="">
                      </label>
                      <span class="errors" id="phoneErr"></span>
                    </li>

                    <li class="col-md-6"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS
                        <input type="text" name="address" value="" placeholder="">
                      </label>
                      <span class="errors" id="addressErr"></span>
                    </li>

                    <!-- TOWN/CITY -->
                    <li class="col-md-6">
                      <label>*TOWN/CITY
                        <input type="text" name="city" value="" placeholder="">
                      </label>
                      <span class="errors" id="cityErr"></span>
                    </li>

                    <!-- COUNTRY -->
                    <li class="col-md-6">
                      <label> STATE
                        <select class="selectpicker" name="state">
                          <option value="">Select state</option>
                          <option value="AN">Andaman and Nicobar Islands</option>
                          <option value="AP">Andhra Pradesh</option>
                          <option value="AR">Arunachal Pradesh</option>
                          <option value="AS">Assam</option>
                          <option value="BR">Bihar</option>
                          <option value="CH">Chandigarh</option>
                          <option value="CT">Chhattisgarh</option>
                          <option value="DN">Dadra and Nagar Haveli</option>
                          <option value="DD">Daman and Diu</option>
                          <option value="DL">Delhi</option>
                          <option value="GA">Goa</option>
                          <option value="GJ">Gujarat</option>
                          <option value="HR">Haryana</option>
                          <option value="HP">Himachal Pradesh</option>
                          <option value="JK">Jammu and Kashmir</option>
                          <option value="JH">Jharkhand</option>
                          <option value="KA">Karnataka</option>
                          <option value="KL">Kerala</option>
                          <option value="LA">Ladakh</option>
                          <option value="LD">Lakshadweep</option>
                          <option value="MP">Madhya Pradesh</option>
                          <option value="MH">Maharashtra</option>
                          <option value="MN">Manipur</option>
                          <option value="ML">Meghalaya</option>
                          <option value="MZ">Mizoram</option>
                          <option value="NL">Nagaland</option>
                          <option value="OR">Odisha</option>
                          <option value="PY">Puducherry</option>
                          <option value="PB">Punjab</option>
                          <option value="RJ">Rajasthan</option>
                          <option value="SK">Sikkim</option>
                          <option value="TN">Tamil Nadu</option>
                          <option value="TG">Telangana</option>
                          <option value="TR">Tripura</option>
                          <option value="UP">Uttar Pradesh</option>
                          <option value="UT">Uttarakhand</option>
                          <option value="WB">West Bengal</option>
                        </select>
                      </label>
                      <span class="errors" id="stateErr"></span>
                    </li>
                    
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *PASSWORD
                        <input type="password" name="password" value="" placeholder="">
                      </label>
                      <span class="errors" id="passwordErr"></span>
                    </li>

                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *CONFIRM PASSWORD
                        <input type="password" name="confirmPassword" value="" placeholder="">
                      </label>
                      <span class="errors" id="confirmPasswordErr"></span>
                    </li>                    
                    
          
                    <li class="col-md-6">
                      <button id="registerFormBtn" type="submit" class="btn">REGISTER NOW</button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- News Letter -->
    <section class="news-letter padding-top-150 padding-bottom-150">
      <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
          <h4>NEWSLETTER</h4>
          <span>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odi </span> </div>
        <form>
          <input type="email" placeholder="Enter your email address" required>
          <button type="submit">SEND ME</button>
        </form>
      </div>
    </section>
  </div>

<script type="text/javascript">
  $(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#registerForm").submit(function(event) {
      event.preventDefault();

      formData = $(this).serialize();

      $.ajax({
        url: '{{ route("doRegister") }}',
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
          $("#registerFormBtn").html('Sending...');
          $(".errors").html('');
        }, success: function(res) {

          if (res.error == true) {
              if (res.eType == 'field') {
                  $.each(res.errors, function(index, val) {
                      $("#"+index+"Err").html(val);
                  });
              } else {
                  $('#registerFormMsg').html(res.msg);
              }
          } else {
              // $("#registerForm")[0].reset();
              // $('#registerFormMsg').html(res.msg).show();
             window.location.href = res.redirect;
          }


          $("#registerFormBtn").html('SEND Message');
        }
      })

    });
  
  });
</script>

@endsection

