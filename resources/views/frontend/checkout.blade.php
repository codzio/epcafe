@extends('vwFrontMaster')

@section('content')

<style type="text/css">
  .billing-address {
    display: none;
  }
</style>

<!--======= SUB BANNER =========-->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
  <div class="position-center-center">
    <div class="container">
      <h4>CHECKOUT</h4>
      <ol class="breadcrumb">
        <li><a href="{{ route('homePage') }}">Home</a></li>
        <li class="active">CHECKOUT</li>
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
        <div class="cart-ship-info">
          <div class="row"> 
            
            <!-- ESTIMATE SHIPPING & TAX -->
            <div class="col-sm-7">
              <h6>SHIPPING DETAILS</h6>
              <form id="customerAddressForm" method="post" action="{{ route('saveAddress') }}">
                <ul class="row">
                  <li class="col-md-6">
                    <label>*NAME
                      <input type="text" name="shippingName" value="{{ isset($customerAddress->shipping_name)? $customerAddress->shipping_name:$customerData->name }}" placeholder="">
                    </label>
                    <span class="error" id="shippingNameErr"></span>
                  </li>
                  <li class="col-md-6"> 
                    <label>COMPANY NAME
                      <input type="text" name="shippingCompanyName" value="{{ isset($customerAddress->shipping_company_name)? $customerAddress->shipping_company_name:'' }}" placeholder="">
                    </label>
                    <span class="error" id="shippingCompanyNameErr"></span>
                  </li>
                  <li class="col-md-6"> 
                    <label>*ADDRESS
                      <input type="text" name="shippingAddress" value="{{ isset($customerAddress->shipping_address)? $customerAddress->shipping_address:$customerData->address }}" placeholder="">
                    </label>
                    <span class="error" id="shippingAddressErr"></span>
                  </li>

                  <li class="col-md-6">
                    <label>*TOWN/CITY
                      <input type="text" name="shippingCity" value="{{ isset($customerAddress->shipping_city)? $customerAddress->shipping_city:$customerData->city }}" placeholder="">
                    </label>
                    <span class="error" id="shippingCityErr"></span>
                  </li>
                
                  <li class="col-md-6">
                    <label>*State
                      <input type="text" name="shippingState" value="{{ isset($customerAddress->shipping_state)? $customerAddress->shipping_state:$customerData->state }}" placeholder="">
                    </label>
                    <span class="error" id="shippingStateErr"></span>
                  </li>

                  <li class="col-md-6">
                    <label>*Pincode
                      <input type="number" name="shippingPincode" value="{{ isset($customerAddress->shipping_pincode)? $customerAddress->shipping_pincode:'' }}" placeholder="">
                    </label>
                    <span class="error" id="shippingPincodeErr"></span>
                  </li>
                  
                  <!-- EMAIL ADDRESS -->
                  <li class="col-md-6">
                    <label> *EMAIL ADDRESS
                      <input type="text" name="shippingEmail" value="{{ isset($customerAddress->shipping_email)? $customerAddress->shipping_email:$customerData->email }}" placeholder="">
                    </label>
                    <span class="error" id="shippingEmailErr"></span>
                  </li>
                  <!-- PHONE -->
                  <li class="col-md-6">
                    <label> *PHONE
                      <input type="text" name="shippingPhone" value="{{ isset($customerAddress->shipping_phone)? $customerAddress->shipping_phone:$customerData->phone }}" placeholder="">
                    </label>
                    <span class="error" id="shippingPhoneErr"></span>
                  </li>

                  @php

                    $isBillingAddressSame = true;
                    if(isset($customerAddress->is_billing_same)) {
                      if(!$customerAddress->is_billing_same) {
                        $isBillingAddressSame = false;
                      }
                    } 

                  @endphp
                  
                  <!-- CREATE AN ACCOUNT -->
                  <li class="col-md-6">
                    <div class="checkbox margin-0 margin-top-20">
                      <input {{ $isBillingAddressSame? 'checked':''; }} id="checkbox1" class="styled" type="checkbox" name="isBillingAddressSame" value="true">
                      <label for="checkbox1"> Is Billing Address Same as Shipping Address </label>
                    </div>
                  </li>
                </ul>
              
                <!-- SHIPPING info -->
                <h6 style="{{ $isBillingAddressSame? '':'display:block'; }}" class="billing-address margin-top-50">Billing Details</h6>
                <ul style="{{ $isBillingAddressSame? '':'display:block'; }}" class="billing-address row">
                  
                  <!-- Name -->
                  <li class="col-md-6">
                    <label> *NAME
                      <input type="text" name="billingName" value="{{ isset($customerAddress->billing_name)? $customerAddress->billing_name:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingNameErr"></span>
                  </li>
                  <li class="col-md-6"> 
                    <!-- COMPANY NAME -->
                    <label>COMPANY NAME
                      <input type="text" name="billingCompanyName" value="{{ isset($customerAddress->billing_company_name)? $customerAddress->billing_company_name:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingCompanyNameErr"></span>
                  </li>
                  <li class="col-md-6"> 
                    <!-- ADDRESS -->
                    <label>*ADDRESS
                      <input type="text" name="billingAddress" value="{{ isset($customerAddress->billing_address)? $customerAddress->billing_address:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingAddressErr"></span>
                  </li>
                  <!-- TOWN/CITY -->
                  <li class="col-md-6">
                    <label>*TOWN/CITY
                      <input type="text" name="billingCity" value="{{ isset($customerAddress->billing_city)? $customerAddress->billing_city:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingCityErr"></span>
                  </li>
                  
                  <!-- COUNTRY -->
                  <li class="col-md-6">
                    <label>*State
                      <input type="text" name="billingState" value="{{ isset($customerAddress->billing_state)? $customerAddress->billing_state:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingStateErr"></span>
                  </li>

                  <li class="col-md-6">
                    <label>*Pincode
                      <input type="text" name="billingPincode" value="{{ isset($customerAddress->billing_pincode)? $customerAddress->billing_pincode:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingPincodeErr"></span>
                  </li>
                  
                  <!-- EMAIL ADDRESS -->
                  <li class="col-md-6">
                    <label> *EMAIL ADDRESS
                      <input type="text" name="billingEmail" value="{{ isset($customerAddress->billing_email)? $customerAddress->billing_email:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingEmailErr"></span>
                  </li>
                  <!-- PHONE -->
                  <li class="col-md-6">
                    <label> *PHONE
                      <input type="text" name="billingPhone" value="{{ isset($customerAddress->billing_phone)? $customerAddress->billing_phone:'' }}" placeholder="">
                    </label>
                    <span class="error" id="billingPhoneErr"></span>
                  </li>
                </ul>

                <button id="customerAddressBtn" type="submit" class="btn">SUBMIT</button>

                <div id="customerAddressFormMsg"></div>

              </form>
            </div>
            
            <!-- SUB TOTAL -->
            <div class="col-sm-5">
              <h6>YOUR ORDER</h6>
              <div class="order-place">
                <div class="order-detail">
                  <p>Discount <span id="discountData">{{ $productPrice->discount }}</span></p>
                  <p>Shipping Charge <span id="shippingData">{{ $productPrice->shipping }}</span></p>
                  <p>Sub Total <span id="subTotalData">{{ $productPrice->total }}</span></p>
                  
                  <!-- SUB TOTAL -->
                  <p class="all-total">TOTAL<span id="totalData">{{ $productPrice->total }}</span></p>
                </div>
                <div class="pay-meth">
                  <ul>
                    <!-- <li>
                      <div class="radio">
                        <input type="radio" name="radio1" id="radio1" value="option1" checked>
                        <label for="radio1"> DIRECT BANK TRANSFER </label>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam erat turpis, pellentesque non leo eget, pulvinar pretium arcu. Mauris porta elit non.</p>
                    </li>
                    <li>
                      <div class="radio">
                        <input type="radio" name="radio1" id="radio2" value="option2">
                        <label for="radio2"> CASH ON DELIVERY</label>
                      </div>
                    </li>
                    <li>
                      <div class="radio">
                        <input type="radio" name="radio1" id="radio3" value="option3">
                        <label for="radio3"> CHEQUE PAYMENT </label>
                      </div>
                    </li>
                    <li>
                      <div class="radio">
                        <input type="radio" name="radio1" id="radio4" value="option4">
                        <label for="radio4"> PAYPAL </label>
                      </div>
                    </li> -->
                    <li>
                      <div class="checkbox">
                        <input name="acceptTermsCondition" value="true" id="checkbox3-4" class="styled" type="checkbox">
                        <label for="checkbox3-4"> I’VE READ AND ACCEPT THE <span class="color"> TERMS & CONDITIONS </span> </label>

                        <span id="acceptTermsConditionErr" class="error"></span>
                      </div>
                    </li>
                  </ul>

                  <div id="placeOrderMsg"></div>

                  <button id="placeOrderBtn" type="button" class="btn  btn-dark pull-right margin-top-30">Place Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
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

    $("#checkbox1").change(function (e) {
      if ($(this).is(':checked')) {
        $('.billing-address').hide();
      } else {
        $('.billing-address').show();
      }
    });

    $("#customerAddressForm").submit(function(event) {
      event.preventDefault();
      
      formData = $(this).serialize();
      url = $(this).attr('action');

      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
          $(".error").html('');
          $("#customerAddressBtn").html('Please Wait...');
          $("#customerAddressFormMsg").html('');
        }, success: function(res) {
          if(res.error == true) {
            if(res.eType == 'field') {
              $.each(res.errors, function(index, val) {
                 $("#"+index+"Err").html(val);
              });
            }
          } else {
            $("#customerAddressFormMsg").html(res.msg);

            subTotal = ((res.priceData.shipping+res.priceData.total)+res.priceData.discount);

            $("#discountData").html(res.priceData.discount)
            $("#shippingData").html(res.priceData.shipping)
            $("#subTotalData").html(subTotal)
            $("#totalData").html(res.priceData.total)
          }

          $("#customerAddressBtn").html('Submit')

        }
      });
      

    });

    $("#placeOrderBtn").click(function (e) {
      
      acceptTerms = '';
      if ($("[name=acceptTermsCondition]").is(':checked')) {
        acceptTerms = 'true';
      }

      formData = $("#customerAddressForm").serialize()+"&acceptTermsCondition="+acceptTerms;

      url = "{{ route('placeOrder') }}"

      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
          $(".error").html('');
          $("#placeOrderBtn").html('Please Wait...');
          $("#placeOrderMsg").html('');
        }, success: function(res) {
          if(res.error == true) {
            if(res.eType == 'field') {
              $.each(res.errors, function(index, val) {
                 $("#"+index+"Err").html(val);
              });
            }
          } else {
            $("#placeOrderMsg").html(res.msg);
            window.location.href = res.redirect;
          }

          $("#placeOrderBtn").html('Place Order')

        }
      });

    });

  });
</script>

@endsection