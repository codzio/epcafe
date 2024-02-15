@extends('vwFrontMaster')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<style type="text/css">

  .shopping-cart .order-place input {
    margin: -20px;
  }

  .billing-address {
    display: none;
  }

  .shopping-cart .cart-ship-info {
    margin-top: 0;
  }

  .shopping-cart .cart-ship-info h6 {
    margin-bottom: 25px;
  }

  .dropzone {
    width: 100%;
    margin: 2% 0;
    border: 1px solid !important;
    border-color: var(--green-color) !important;
    border-radius: 5px;
    transition: 0.2s;
  }

  .shopping-cart .order-place {
    border: 1px solid !important;
    border-color: var(--green-color) !important;
  }

  .shopping-cart .order-place .order-detail p {
    color: black !important;
  }

  .dropzone.dz-drag-hover {
    border: 2px solid #3498db !important;
  }

  .dz-message.needsclick img {
    width: 50px;
    display: block;
    margin: auto;
    opacity: 0.6;
    margin-bottom: 15px;
  }

  span.plus {
    display: none;
  }

  .dropzone .dz-message {
      display: block;
      text-align: center;
  }

  .card .card-header {
      border-bottom: none;
  }

</style>

<!--======= SUB BANNER =========-->
<!-- <section class="sub-bnr" data-stellar-background-ratio="0.5">
  <div class="position-center-center">
    <div class="container">
      <h4>CHECKOUT</h4>
      <ol class="breadcrumb">
        <li><a href="{{ route('homePage') }}">Home</a></li>
        <li class="active">CHECKOUT</li>
      </ol>
    </div>
  </div>
</section> -->

<!-- Content -->
<div id="content" class="check-out-page"> 
  
  <!--======= PAGES INNER =========-->
  <section class="chart-page">
    <div class="container"> 
      
      <!-- Payments Steps -->
      <div class="shopping-cart"> 
        
        <!-- SHOPPING INFORMATION -->
        <div class="cart-ship-info">
          <div class="row"> 
            
            <!-- ESTIMATE SHIPPING & TAX -->
            <div class="col-sm-7">

              <h6>UPLOAD DOCUMENTS</h6>
              <small>You can upload multiple documents by click on this box</small>
              <div id="dropzone">
                <form action="{{ route('doUploadDropbox') }}" class="dropzone needsclick" id="upload">
                  <div class="dz-message needsclick">
                    <span class="text">
                    <img src="{{ asset('public/frontend/img/upload.png') }}" alt="Upload" />
                    <p><strong>Drop files here or click to upload.</strong></p>
                    </span>
                    <span class="plus">+</span>
                  </div>
                </form>
                <span id="dropzoneMsg"></span>
              </div>


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
                    <label>GST Number
                      <input type="text" name="gstNumber" value="{{ isset($customerAddress->gst_number)? $customerAddress->gst_number:'' }}" placeholder="">
                    </label>
                    <span class="error" id="gstNumberErr"></span>
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
                <h6 style="{{ $isBillingAddressSame? '':'display:block'; }}" class="billing-address margin-top-20">Billing Details</h6>
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
                  <!-- <p>Binding <span id="discountData">{{ $productPrice->binding }}</span></p>
                  <p>Lamination <span id="discountData">{{ $productPrice->lamination }}</span></p>
                  <p>Cover <span id="discountData">{{ $productPrice->cover }}</span></p> -->
                  <p>Weight <span id="cartWeight">{{ cartWeight() }}</span></p>
                  <p>Discount <span id="discountData">{{ $productPrice->discount }}</span></p>
                  <p>Shipping Charge <span id="shippingData">{{ $productPrice->shipping }}</span></p>
                  <p>Sub Total <span id="subTotalData">{{ $productPrice->total-$productPrice->shipping-$productPrice->discount }}</span></p>
                  
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
                        <label for="checkbox3-4"> I’VE READ AND ACCEPT THE <span onclick="redirect('{{ route('termsAndConditionPage') }}')" class="color"> TERMS & CONDITIONS </span> </label>

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

  function redirect(url) {
    window.location.href = url
  }

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
            } else {
              $("#placeOrderMsg").html(res.msg).css('color', 'red');
            }
          } else {
            $("#placeOrderMsg").html(res.msg).css('color', 'green');
            window.location.href = res.redirect;
          }

          $("#placeOrderBtn").html('Place Order')

        }
      });

    });

    Dropzone.autoDiscover = false;
    $("#upload").dropzone({
        url: "{{ route('doUploadDropbox') }}",
        method: 'POST',
        parallelUploads: 10,
        uploadMultiple: true,
        maxFilesize: 10, //MB
        maxFiles: 10, //Cannot upload more than 10 files
        acceptedFiles: ".jpg, .jpeg, .png, .zip, application/pdf, application/zip",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            this.on("error", function(file, res) {
                // Handle errors if the file size exceeds the limit or for other reasons
                if (res) {
                    console.log(res);
                }
            }),
            this.on("success", function(file, res) {
                // Handle errors if the file size exceeds the limit or for other reasons
        
                res = JSON.parse(res);
                $this = this;

                if (res.error) {
                    
                    if (res.eType == 'final') {
                        //toastr.error(res.msg);
                        $("#dropzoneMsg").html(res.msg).css('color', 'red');
                    } else {
                        $.each(res.errors, function(index, val) {
                           //toastr.error(val);  
                          $("#dropzoneMsg").html(val).css('color', 'red');
                        });
                    }

                } else {

                    // toastr.success(res.msg);

                    $("#dropzoneMsg").html(res.msg).css('color', 'green');

                    timeout = setTimeout(function() {
                        //$this.removeAllFiles();
                        $("#dropzoneMsg").hide();
                        clearTimeout(timeout);
                    }, 3000);

                }

            })
        },
    });

  });
</script>

@endsection