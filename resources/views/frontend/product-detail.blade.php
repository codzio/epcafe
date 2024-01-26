@extends('vwFrontMaster')

@section('content')

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
            
            <!-- COntent -->
            <div class="col-md-6 detail_ul">
              <h4 style="color:var(--primary-color-1);">{{ $product->name }}</h4>
              {!! $product->description !!}
              <form class="detail_page_form" style="margin-top:25px;">
                <div class="input_field">
                  <label for="select">Paper Size</label>
                    <select id="paperSize" name="paperSize">
                      <option value="">Select Paper Size</option>
                      @if(!empty($paperSize))
                      @foreach($paperSize as $paperSize)
                      <option value="{{ $paperSize->id }}">{{ $paperSize->size }}</option>
                      @endforeach
                      @endif
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Paper GSM</label>
                    <select id="paperGsm" name="paperGsm">
                      <option value="">Select Paper GSM</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Paper Type</label>
                    <select id="paperType" name="paperType">
                      <option value="">Select Paper Type</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Print Sides</label>
                    <select id="sides" name="paperSides">
                      <option value="">Select Sides</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Color</label>
                    <select id="color" name="color">
                      <option value="">Select Color</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Binding</label>
                    <select id="binding" name="binding">
                      <option value="">Select Binding</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Lamination</label>
                    <select id="lamination" name="lamination">
                      <option value="">Select Lamination</option>
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">Cover</label>
                    <select id="cover" name="cover">
                      <option value="">Select Cover</option>
                      @if(!empty($covers))
                      @foreach($covers as $cover)
                      <option value="{{ $cover->id }}">{{ $cover->cover }}</option>
                      @endforeach
                      @endif
                    </select>
                </div>
                <div class="input_field">
                  <label for="select">No of Copies</label>
                  <div class="label_input choose">
                    <input id="noOfCopies" name="noOfCopies" type="text" style="width:100%;" placeholder="1">
                      <p>Choose a quantity between 1 - 1000 for instant ordering. For higher quantities, you will be allowed to request quotations from Sales Team.
                    </p>
                  </div>
                </div>
              </form>
              <div class="price-desktop" style="margin-bottom: 5px;">
               <div class="red_text">
                   <div class="my-1"><span class="price-widget-sezzle" style="color: rgb(250, 128, 56); font-weight: 800; font-size: 22px;">₹37.76</span><span style="color: rgb(98, 107, 127); font-size: 16px;">&nbsp;inclusive of all taxes</span></div>
                 <div><span style="color: rgb(98, 107, 127); font-size: 16px;">for</span><span style="color: rgba(0, 0, 0, 0.87); font-size: 16px;">&nbsp;1</span><span style="color: rgb(98, 107, 127); font-size: 16px;">&nbsp;Qty (</span><span id="perSheetPrice" style="color: rgba(0, 0, 0, 0.87); font-size: 16px;">₹37.76</span><span style="color: rgb(98, 107, 127); font-size: 16px;">&nbsp;/ piece)</span></div>
                 <div class="my-2"><span style="color: rgb(112, 8, 149);">Buy in bulk and save</span></div>
               </div>
               <a href="https://eprintcafe.in/about-us" class="theme-btn mt-20 home_btn"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16 mr-3 ml-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;"><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg>Know More </a>
            </div>
            <div class="input_field" style="display:block;">
                  <label for="select">
                      Estimate Delivery
                  </label>
                  <div class="label_input" style="width:50%;">
                    <input id="pincode" name="pincode" type="text" style="width:100%;" placeholder="Pincode">
                  </div>

                  <label for="select">
                      Document Link
                  </label>
                  <div class="label_input" style="width:50%;">
                    <input id="documentLink" name="documentLink" type="text" style="width:100%;" placeholder="Document Link">
                  </div>
                </div>
            </div>
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

      if ($("#paperGsm").find(':selected').val() != '') {
        paperGsmPrice = $("#paperGsm").find(':selected').attr('data-price');
      }

      if ($("#paperType").find(':selected').val() != '') {
        paperTypePrice = $("#paperType").find(':selected').attr('data-price');
      }

      if ($("#sides").find(':selected').val() != '') {
        paperSidesPrice = $("#sides").find(':selected').attr('data-price');
      }

      if ($("#color").find(':selected').val() != '') {
        paperColorPrice = $("#color").find(':selected').attr('data-price');
      }

      if ($("#binding").find(':selected').val() != '') {
        bindingPrice = $("#binding").find(':selected').attr('data-price');
      }

      if ($("#lamination").find(':selected').val() != '') {
        laminationPrice = $("#lamination").find(':selected').attr('data-price');
      }

      totalPrice = parseFloat(paperGsmPrice)+parseFloat(paperTypePrice)+parseFloat(paperSidesPrice)+parseFloat(paperColorPrice)+parseFloat(bindingPrice)+parseFloat(laminationPrice);

      if(paperSidesPrice != 0 && paperColorPrice != 0) {
        totalPrice = parseFloat(totalPrice) - parseFloat(paperSidesPrice);
      }

      finalPrice = parseFloat(totalPrice)*parseInt(qty);
      $('.price-widget-sezzle').html(`₹`+finalPrice);
      $("#perSheetPrice").html(`₹`+totalPrice)

      console.log(totalPrice, parseInt(qty));

    }

  });
</script>

@endsection