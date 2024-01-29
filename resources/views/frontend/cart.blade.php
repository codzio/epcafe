@extends('vwFrontMaster')

@section('content')

<section class="sub-bnr" data-stellar-background-ratio="0.5">
  <div class="position-center-center">
    <div class="container">
      <h4>SHOPPING CART</h4>
      <ol class="breadcrumb">
        <li><a href="{{ route('homePage') }}">Home</a></li>
        <li class="active">SHOPPING CART</li>
      </ol>
    </div>
  </div>
</section>

<!-- Content -->
<div id="content"> 
  
  <!--======= PAGES INNER =========-->
  <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
    <div class="container"> 
      
      <!-- Payments Steps -->
      <div class="shopping-cart text-center">
        <div class="cart-head">
          <ul class="row">
            <!-- PRODUCTS -->
            <li class="col-sm-2 text-left">
              <h6>PRODUCTS</h6>
            </li>
            <!-- NAME -->
            <li class="col-sm-4 text-left">
              <h6>NAME</h6>
            </li>
            <!-- PRICE -->
            <li class="col-sm-2">
              <h6>PRICE</h6>
            </li>
            <!-- QTY -->
            <li class="col-sm-1">
              <h6>QTY</h6>
            </li>
            
            <!-- TOTAL PRICE -->
            <li class="col-sm-2">
              <h6>TOTAL</h6>
            </li>
            <li class="col-sm-1"> </li>
          </ul>
        </div>
        
        @foreach($cartData as $cart)
        @php
          $price = 0;

          if(isset(productPrice()->price)) {
            $price = productPrice()->price;
          }
        @endphp
        <ul class="row cart-details">
          <li class="col-sm-6">
            <div class="media"> 
              <!-- Media Image -->
              <div class="media-left media-middle"> <a href="#." class="item-img"> <img class="media-object" src="{{ getImg($cart->thumbnail_id) }}" alt=""> </a> </div>
              
              <!-- Item Name -->
              <div class="media-body">
                <div class="position-center-center">
                  <h5>{{ $cart->name }}</h5>
                  {!! productSpec($cart->id) !!}
                  <p><strong>Document Link:</strong>{{ $cart->document_link }}</p>
                </div>
              </div>
            </div>
          </li>
          
          <!-- PRICE -->
          <li class="col-sm-2">
            <div class="position-center-center"> <span class="price">{{ $price }}</span> </div>
          </li>
          
          <!-- QTY -->
          <li class="col-sm-1">
            <div class="position-center-center">
              <div class="quinty"> 
                <input min="1" id="qty" type="number" name="qty" value="{{ $cart->qty }}">
              </div>
            </div>
          </li>
          
          <!-- TOTAL PRICE -->
          <li class="col-sm-2">
            <div class="position-center-center"> <span class="price">{{ $price*$cart->qty }}</span> </div>
          </li>
          
          <!-- REMOVE -->
          <li class="col-sm-1">
            <div class="position-center-center"> <a class="remove-cart-item" data-id="{{ $cart->id }}" href="javascript:void(0)"><i class="icon-close"></i></a> </div>
          </li>
        </ul>
        @endforeach
      
      </div>
    </div>
  </section>
  
  <!--======= PAGES INNER =========-->
  <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
    <div class="container"> 
      
      <!-- SHOPPING INFORMATION -->
      <div class="cart-ship-info margin-top-0">
        <div class="row"> 
          
          <!-- DISCOUNT CODE -->
          <div class="col-sm-7">
            <h6>DISCOUNT CODE</h6>
            <form id="couponCodeForm" method="post" action="{{ route('applyPromo') }}">
              <input id="couponCode" name="couponCode" type="text" value="" placeholder="ENTER YOUR CODE IF YOU HAVE ONE">
              <button id="couponCodeFormBtn" type="submit" class="btn btn-small btn-dark">APPLY CODE</button>
              <p id="couponCodeErr" class="removeErr"></p>
            </form>
            <div class="coupn-btn"> 
              <a href="{{ route('checkoutPage') }}" class="btn">Go To Checkout</a> 
              <a id="updatecart" href="javascript:void(0)" class="btn">Update Cart</a> 
            </div>
          </div>
          
          <!-- SUB TOTAL -->
          <div class="col-sm-5">
            <h6>grand total</h6>
            <div class="grand-total">
              <div class="order-detail">
                <p>Discount <span id="totalDiscount">0</span></p>
                <p>Shipping <span>0</span></p>
                <p class="all-total">TOTAL COST <span id="totalCost"> {{ productPrice()->total }}</span></p>
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

    $('.remove-cart-item').click(function (e) {
      cartId = $(this).attr('data-id');

      $.ajax({
        url: '{{ route("removeCartItem") }}',
        type: 'POST',
        dataType: 'json',
        data: {cartId: cartId},
        success: function(res) {
          location.reload();
        }
      })
      
    });

    $("#updatecart").click(function (e) {
      
      qty = $("#qty").val();

      $.ajax({
        url: '{{ route("updateCartItem") }}',
        type: 'POST',
        dataType: 'json',
        data: {qty: qty},
        beforeSend: function() {
          $("#updatecart").html('Updating...')
        },
        success: function(res) {
          $("#updatecart").html('Update Cart');
          location.reload();
        }
      })
      

    });

    $("#couponCodeForm").submit(function(event) {
      event.preventDefault();
      
      formData = $(this).serialize();
      url = $(this).attr('action');

      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function() {
          $("#couponCodeFormBtn").html('Please Wait...');
          $("#couponCodeErr").html('');
        }, success: function(res) {

          if (res.error == true) {
            if (res.eType == 'field') {
              $.each(res.errors, function(index, val) {
                 $("#couponCodeErr").html(val).css('color', 'red');
              });
            } else {
              $("#couponCodeErr").html(res.msg).css('color', 'red');
            }
          } else {
            $("#totalDiscount").html(res.discount);
            $("#totalCost").html(res.grandTotal);
            $("#couponCodeErr").html(res.msg).css('color', 'green');
          }

          $("#couponCodeFormBtn").html('Apply Code');
        } 
      })

    });


  });
</script>

@endsection