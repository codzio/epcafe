@extends('vwFrontMaster')

@section('content')

<style type="text/css">
  .detail_page_disc{  
    margin-top:8%;
  }
  .iconlist{
  }
  .iconlist li{
    padding-left: 26px;
    position:relative;
    }
    .iconlist li::before{
      position: absolute;
      content: '';
      width:6px;
      height:6px;
      border-radius:100%;
      background:#000;
      top:40%;
      left:6px;
    }

    .detail_page_disc ul li::before {
      position: absolute;
      content: '';
      width:6px;
      height:6px;
      border-radius:100%;
      background:#000;
      top:40%;
      left:6px;
    }

    .detail_page_disc ul li{
       padding-left: 26px;
       position:relative;
    }

    .detail_page_disc h3{
      text-transform: capitalize;
    }
    .detail_page_disc h5{
      text-transform: capitalize;
    }
  .validate-code-link-main .validate-code-link{
    display: flex;
  }
  .validate-code-link-main .validate-code-link button{
      background: var(--primary-color-2);
      color: #fff;
      border: 0;
      padding: 0 12px;
      border-radius: 0 4px 4px 0;
  }
  .validate-code-link-main .validate-code-link button:hover{
    background: #000;
  }
  .validate-code-link-main .val-err{
    color: var(--primary-color-2);
  }

  .validate-code-link-main .val-succ{
    color: green;
  }
  .detail_fields{
    width: 65%;
  }
  .detail_fields select{
    width: 100%;
  }
  .shop-detail .images-slider .slides li{
    height:70vh;
  }
  .shop-detail .images-slider .slides li .img-responsive  {
    width:100%;
    height:100%;
    object-fit:cover;
  }
</style>
<!-- Popular Products -->
    <section class="padding-top-100 padding-bottom-100">
      <div class="container"> 
        
        <!-- SHOP DETAIL -->
        <div class="shop-detail">
          <div class="row"> 
            
            <!-- Popular Images Slider -->
            <div class="col-md-6"> 
                
              <!-- Images Slider -->
              <div class="images-slider">
                <ul class="slides">
                  <li data-thumb="{{ getImg($product->thumbnail_id) }}"> <img class="img-responsive" src="{{ getImg($product->thumbnail_id) }}"  alt=""> </li>
                  <!-- <li data-thumb="{{ asset('public/frontend') }}/images/large-img-2.jpg"> <img class="img-responsive" src="{{ asset('public/frontend') }}/images/large-img-2.jpg"  alt=""> </li>
                  <li data-thumb="{{ asset('public/frontend') }}/images/large-img-3.jpg"> <img class="img-responsive" src="{{ asset('public/frontend') }}/images/large-img-3.jpg"  alt=""> </li> -->
                </ul>
              </div>
            </div>
            
            <!-- Content -->
            <div class="col-md-6 detail_ul">
              <h4 style="color:var(--primary-color-1);">{{ $product->name }}</h4>
              
              <form method="post" id="addToCartForm" class="detail_page_form" style="margin-top:25px;">
                <div class="input_field">
                    <label for="select">Paper Size</label>
                    <div class="detail_fields">
                      <select id="paperSize" name="paperSize">
                        <option value="">Select Paper Size</option>
                        @if(!empty($paperSize))
                        @foreach($paperSize as $paperSize)
                        <option value="{{ $paperSize->id }}">{{ $paperSize->size }}</option>
                        @endforeach
                        @endif
                      </select>
                      <span class="text-danger" id="paperSizeErr"></span>
                    </div>
                </div>

                <div class="input_field">
                    <label for="select">Paper GSM</label>
                    <div class="detail_fields">
                      <select id="paperGsm" name="paperGsm">
                        <option value="">Select Paper GSM</option>
                      </select>
                      <span class="text-danger" id="paperGsmErr"></span>
                    </div>
                </div>
                <div class="input_field">
                  <label for="select">Paper Type</label>
                  <div class="detail_fields">
                    <select id="paperType" name="paperType">
                      <option value="">Select Paper Type</option>
                    </select>
                    <span class="text-danger" id="paperTypeErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">Print Sides</label>
                  <div class="detail_fields">
                    <select id="sides" name="paperSides">
                      <option value="">Select Sides</option>
                    </select>
                    <span class="text-danger" id="paperSidesErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">Color</label>
                  <div class="detail_fields">
                    <select id="color" name="color">
                      <option value="">Select Color</option>
                    </select>
                    <span class="text-danger" id="colorErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">Binding</label>
                  <div class="detail_fields">
                    <select id="binding" name="binding">
                      <option value="">Select Binding</option>
                    </select>
                    <span class="text-danger" id="bindingErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">Lamination</label>
                  <div class="detail_fields">
                    <select id="lamination" name="lamination">
                      <option value="">Select Lamination</option>
                    </select>
                    <span class="text-danger" id="laminationErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">Cover</label>
                  <div class="detail_fields">
                    <select id="cover" name="cover">
                      <option value="">Select Cover</option>
                      @if(!empty($covers))
                      @foreach($covers as $cover)
                      <option value="{{ $cover->id }}">{{ $cover->cover }}</option>
                      @endforeach
                      @endif
                    </select>
                    <span class="text-danger" id="coverErr"></span>
                  </div>
                </div>
                <div class="input_field">
                  <label for="select">No of Copies</label>
                    <div class="label_input choose">
                      <input id="noOfCopies" name="noOfCopies" type="text" style="width:100%;" placeholder="No of Copies">
                        <p>Choose a quantity between 1 - 1000 for instant ordering. For higher quantities, you will be allowed to request quotations from Sales Team.
                      </p>
                      <span class="text-danger" id="noOfCopiesErr"></span>
                    </div>
                </div>

              <input type="hidden" name="productId" value="{{ $product->id }}">

              <div class="price-desktop" style="margin-bottom: 5px;">
                 <div class="red_text">
                     <div class="my-1"><span class="price-widget-sezzle" style="color:var(--primary-color-2); font-weight: 800; font-size: 22px;">₹0</span><span style="color:#000; font-size: 16px;">&nbsp;inclusive of all taxes</span></div>
                   <div><span style="color:#000; font-size: 16px;">for</span><span style="color: rgba(0, 0, 0, 0.87); font-size: 16px;">&nbsp;1</span><span style="color: #000; font-size: 16px;">&nbsp;Qty (</span><span id="perSheetPrice" style="color: rgba(0, 0, 0, 0.87); font-size: 16px;">₹0</span><span style="color:#000;font-size: 16px;">&nbsp;/ piece)</span></div>
                   <div class="my-2"><span style="color:var(--primary-color-2);">Buy in bulk and save</span></div>
                 </div>

                 <button id="addToCartFormBtn" class="theme-btn mt-20 home_btn"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16 mr-3 ml-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;"><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg><span id="addToCartFormTxt">Add to Cart</span> </button>

              </div>
            </form>
            <div class="input_field" style="display:block;">
                  <label for="select">Estimated Delivery</label>
                  <div class="label_input validate-code-link-main" style="width:50%;">
                    <div class="validate-code-link">
                      <input id="pincode" name="pincode" type="number" style="width:100%;" placeholder="Pincode">
                      <button type="button" id="estimatedDeliveryBtn">Check</button>
                    </div>
                    <span id="deliveryErr" class="val-err"></span>
                  </div>

                  <label for="select">Document Link</label>
                  <div class="label_input validate-code-link-main" style="width:50%;">
                    <div class="validate-code-link">
                      <input id="documentLink" name="documentLink" type="text" style="width:100%;" placeholder="Document Link">
                      <button type="button" id="documentLinkBtn">Update</button>
                    </div>
                    <span id="documentLinkErr" class="val-err"></span>
                  </div>

              </div>
            </div>

            
            
          </div>
          <div class="detail_page_disc">
                {!! $product->description !!}
            </div>
        </div>
      </div>
</section>
    
@if(!empty($relProducts) && $relProducts->count())
<section class="light-gray-bg padding-top-150 padding-bottom-150">
  <div class="container"> 
    
    <!-- Main Heading -->
    <div class="heading text-center">
      <h4>RELATED PRODUCTS</h4>
      <!--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula. -->
      <!--Sed feugiat, tellus vel tristique posuere, diam</span>-->
      </div>
    
    <!-- Popular Item Slide -->
    <div class="papular-block block-slide single-img-demos">
        @foreach($relProducts as $relProd)
        <div class="item"> 
          <a href="{{ route('productPage', ['slug' => $relProd->slug]) }}">
              <div class="item-img"> 
                <img class="img-1" src="{{ getImg($relProd->thumbnail_id); }}" alt="">
                <!-- Overlay -->
                <div class="overlay">
                  <!-- <div class="position-center-center">
                    <div class="inn">
                      <div href="{{ asset('public/frontend') }}/images/new-arrival-img.png" data-lighter=""><i class="icon-magnifier"></i></div>
                      <div href="#."><i class="icon-basket"></i></div>
                      <div href="#."><i class="icon-heart"></i></div>
                    </div>
                  </div> -->
                </div>
              </div>
            </a>
          <!-- Item Name -->
          <div class="item-name"> <a href="{{ route('productPage', ['slug' => $relProd->slug]) }}">{{ $relProd->name }}</a>
            <!--<p>Lorem ipsum dolor sit amet</p>-->
          </div>
          <!-- Price --> 
          <!--<span class="price"><small>$</small>299</span> -->
        </div>
        @endforeach
    </div>
  </div>
</section>
@endif

<script type="text/javascript">
  $(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#paperSize").change(function(event) {
      
      paperSize = $(this).find(':selected').val();
      productId = {{ $product->id }}

      $.ajax({
        url: '{{ route("getPricing") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          productId: productId,
          paperSize: paperSize,
          action: 'gsm'
        },
        beforeSend: function() {

        }, success: function(res) {
            
            calculatePrice();

            $("#paperGsm").html(res.gsmOptions);
            $("#binding").html(res.bindingOptions);
            $("#lamination").html(res.laminationOptions);

        }
      })

    });

    $("#paperGsm").change(function (e) {
      
      productId = {{ $product->id }}
      paperSize = $("#paperSize").find(':selected').val();
      paperGsm = $(this).find(':selected').val();

      $.ajax({
        url: '{{ route("getPricing") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          productId: productId,
          paperSize: paperSize,
          paperGsm: paperGsm,
          action: 'paper_type'
        },
        beforeSend: function() {

        }, success: function(res) {
            
            calculatePrice();
            $("#paperType").html(res.paperOptions);

        }
      })

    });

    $("#paperType").change(function (e) {
      
      productId = {{ $product->id }}
      paperSize = $("#paperSize").find(':selected').val();
      paperGsm = $("#paperGsm").find(':selected').val();
      paperType = $(this).find(':selected').val();

      $.ajax({
        url: '{{ route("getPricing") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          productId: productId,
          paperSize: paperSize,
          paperGsm: paperGsm,
          paperType: paperType,
          action: 'paper_sides'
        },
        beforeSend: function() {

        }, success: function(res) {
            
            calculatePrice();
            $("#sides").html(res.paperSides);

        }
      })

    });

    $("#sides").change(function (e) {
      
      productId = {{ $product->id }}
      paperSize = $("#paperSize").find(':selected').val();
      paperGsm = $("#paperGsm").find(':selected').val();
      paperType = $("#paperType").find(':selected').val();
      paperSides = $(this).find(':selected').val();

      $.ajax({
        url: '{{ route("getPricing") }}',
        type: 'POST',
        dataType: 'json',
        data: {
          productId: productId,
          paperSize: paperSize,
          paperGsm: paperGsm,
          paperType: paperType,
          paperSides: paperSides,
          action: 'paper_color'
        },
        beforeSend: function() {

        }, success: function(res) {
            
            calculatePrice();
            $("#color").html(res.paperColor);

        }
      })

    });

    $("#color").change(function (e) {
      calculatePrice();
    });

    $("#binding").change(function (e) {
      calculatePrice();
    });

    $("#lamination").change(function (e) {
      calculatePrice();
    });

    $("#noOfCopies").change(function (e) {
      calculatePrice();
    });

    function calculatePrice() {

      paperGsmPrice = 0;
      paperTypePrice = 0;
      paperSidesPrice = 0;
      paperColorPrice = 0;
      bindingPrice = 0;
      laminationPrice = 0;

      qty = ($("#noOfCopies").val() == '')? 0:$("#noOfCopies").val();

      // if ($("#paperGsm").find(':selected').val() != '') {
      //   paperGsmPrice = $("#paperGsm").find(':selected').attr('data-weight');
      // }

      if ($("#paperType").find(':selected').val() != '') {
        paperTypePrice = $("#paperType").find(':selected').attr('data-price');
      }

      // if ($("#sides").find(':selected').val() != '') {
      //   paperSidesPrice = $("#sides").find(':selected').attr('data-price');
      // }

      if ($("#color").find(':selected').val() != '') {
        paperColorPrice = $("#color").find(':selected').attr('data-price');
      }

      if ($("#binding").find(':selected').val() != '') {
        bindingPrice = $("#binding").find(':selected').attr('data-price');
      }

      if ($("#lamination").find(':selected').val() != '') {
        laminationPrice = $("#lamination").find(':selected').attr('data-price');
      }

      // totalPrice = parseFloat(paperGsmPrice)+parseFloat(paperTypePrice)+parseFloat(paperSidesPrice)+parseFloat(paperColorPrice)+parseFloat(bindingPrice)+parseFloat(laminationPrice);

      totalPrice = parseFloat(paperGsmPrice)+parseFloat(paperTypePrice)+parseFloat(paperSidesPrice)+parseFloat(paperColorPrice);

      // if(paperSidesPrice != 0 && paperColorPrice != 0) {
      //   totalPrice = parseFloat(totalPrice) - parseFloat(paperSidesPrice);
      // }

      finalPrice = (parseFloat(totalPrice)*parseInt(qty))+parseFloat(bindingPrice)+parseFloat(laminationPrice);;
      if(qty != 0) {
        $('.price-widget-sezzle').html(`₹`+finalPrice);
      }
      $("#perSheetPrice").html(`₹`+totalPrice)

      console.log(totalPrice, parseInt(qty));

    }

    $("#estimatedDeliveryBtn").click(function(event) {
      
      pincode = $("#pincode").val();

      $.ajax({
        url: '{{ route("checkPincode") }}',
        type: 'POST',
        dataType: 'json',
        data: {pincode: pincode},
        beforeSend: function() {
          $("#deliveryErr").html('').removeClass('val-err val-succ');
           $("#estimatedDeliveryBtn").html('Checking...');
        },
        success: function(res) {
          
          if (res.error == true) {
            if (res.eType == 'field') {
              $("#deliveryErr").html(res.errors.pincode).addClass('val-err');
            } else if(res.eType == 'final') {
              $("#deliveryErr").html(res.msg).addClass('val-err');
            }
          } else {
            $("#deliveryErr").html(res.msg).addClass('val-succ');
          }

          $("#estimatedDeliveryBtn").html('Check');
        }
      })      

    });

    $("#documentLinkBtn").click(function(event) {
      
      documentLink = $("#documentLink").val();

      $.ajax({
        url: '{{ route("checkDocumentLink") }}',
        type: 'POST',
        dataType: 'json',
        data: {documentLink: documentLink},
        beforeSend: function() {
          $("#documentLinkErr").html('').removeClass('val-err val-succ');
           $("#documentLinkBtn").html('Checking...');
        },
        success: function(res) {
          
          if (res.error == true) {
            if (res.eType == 'field') {
              $("#documentLinkErr").html(res.errors.documentLink).addClass('val-err');
            } else if(res.eType == 'final') {
              $("#documentLinkErr").html(res.msg).addClass('val-err');
            }
          } else {
            $("#documentLinkErr").html(res.msg).addClass('val-succ');
          }

          $("#documentLinkBtn").html('Update');
        }
      })      

    });

    $("#addToCartForm").submit(function(event) {
      event.preventDefault();

      formData = $(this).serialize();
      documentLink = $("#documentLink").val();
      formData += "&documentLink="+documentLink;

      $.ajax({
        url: '{{ route("addToCart") }}',
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
          $('.text-danger').html('');
          $("#addToCartFormTxt").html('Adding...');
        },
        success: function(res) {
          
          if (res.error == true) {
            if (res.eType == 'field') {
              
              $.each(res.errors, function(index, val) {
                 $("#"+index+"Err").html(val);
              });

            } else if(res.eType == 'final') {
              $("#documentLinkErr").html(res.msg).addClass('val-err');
            }
          } else {
            $("#documentLinkErr").html(res.msg).addClass('val-succ');
            window.location.href = "{{ route('cartPage') }}";
          }

          $("#addToCartFormTxt").html('Add To Cart');
        }
      })  
      

    });

  });
</script>

@endsection