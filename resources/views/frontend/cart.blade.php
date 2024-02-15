@extends('vwFrontMaster')

@section('content')

<style type="text/css">
  .cart-head {
      display: grid;
      /* grid-template-columns: 1fr 1fr 1fr 1fr; */
      grid-template-columns: 29% 16% 30% 1fr;
  }

  .media3 input {
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 0.25rem;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
</style>

<!-- <section class="sub-bnr" data-stellar-background-ratio="0.5">
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
 -->
<!-- Content -->
<div id="content"> 
  
  <!--======= PAGES INNER =========-->
  <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
    <div class="container"> 
      
      <!-- Payments Steps -->
      <div class="shopping-cart text-center">
        <div class="cart-head">
          <h6>PRODUCTS</h6>
              <h6>PRICE</h6>
              <h6>No Of Pages/Copies</h6>
              <h6>TOTAL</h6>
        </div>
        
        @foreach($cartData as $cart)
        @php
          $price = 0;

          if(isset(productPrice()->price)) {
            $price = productPrice()->price;
          }
        @endphp
        <div class="detail_card_row  shopping-cart small-cart">
          <div class="row cart-details">
           <div class="media media1"> 
              <!-- Media Image -->
            <div class="card_detail">
                  <h5>{{ $cart->name }}</h5>
                  {!! productSpec($cart->id) !!}
                  <p><strong>Binding:</strong> {{ productPrice()->binding }}</p>
                  <p><strong>Lamination:</strong> {{ productPrice()->lamination }}</p>
                  <p><strong>Cover:</strong> {{ productPrice()->cover }}</p>
                  <!-- <p><strong>Document Link:</strong>{{ $cart->document_link }}</p> -->
                </div>
              </div>
            
            <!-- PRICE -->
                <div class="media2"> <span class="price">{{ $price }}</span> </div>
            
            <!-- QTY -->
              <div class="media3">
                  <input min="1" id="qty" type="number" style="width:95px; text-align: center;" name="qty" value="{{ $cart->qty }}" placeholder="No of Pages">
                  <input min="1" id="noOfCopies" type="number" style="width:95px; text-align: center;" name="noOfCopies" value="{{ $cart->no_of_copies }}" placeholder="No of Copies">
              </div>            
            <!-- TOTAL PRICE -->
                <div class="media4"> 
                  <!-- <span class="price">{{ (($price*$cart->qty)*$cart->no_of_copies) }}</span> -->
                  <span class="price">{{ productPrice()->total }}</span>
                </div>
            
            <!-- REMOVE -->
            <div class="media5"> <a class="remove-cart-item" data-id="{{ $cart->id }}" href="javascript:void(0)"><i class="icon-close"></i></a> </div>
          </div>
          <div class="cart-ship-info">
            <div class="rows"> 
              
              <!-- DISCOUNT CODE -->
              <div class="col-12">
                <h6>DISCOUNT CODE</h6>
                <form id="couponCodeForm" method="post" action="{{ route('applyPromo') }}">
                  <input id="couponCode" name="couponCode" type="text" value="" placeholder="ENTER YOUR CODE IF YOU HAVE ONE">
                  <button id="couponCodeFormBtn" type="submit" class="btn btn-small btn-dark">APPLY CODE</button>
                  <p id="couponCodeErr" class="removeErr"></p>
                </form>
                
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-12">
                <h6>grand total</h6>
                <div class="grand-total">
                  <div class="order-detail">
                    <p>Weight <span id="totalWeight">{{ cartWeight() }}</span></p>
                    <!-- <p>Binding <span>{{ productPrice()->binding }}</span></p>
                    <p>Lamination <span>{{ productPrice()->lamination }}</span></p>
                    <p>Cover <span>{{ productPrice()->cover }}</span></p> -->
                    <p>Discount <span id="totalDiscount">0</span></p>
                    <!-- <p>Shipping <span>0</span></p> -->
                    <p class="all-total">TOTAL COST <span id="totalCost"> {{ productPrice()->total }}</span></p>
                  </div>
                </div>
              </div>
              <div class="coupn-btn"> 
                  <a id="updatecart" href="javascript:void(0)" class="btn">Update Cart</a> 
                  <a href="{{ route('checkoutPage') }}"  style="background:#49c93e;"  class="btn" style="background: var(--secondary-color-3); color: #fff!important;">Go To Checkout</a>                   
                </div>
            </div>
          </div>
        </div>

        @endforeach
      
      </div>
    </div>
  </section>
  
  <!--======= PAGES INNER =========-->
  
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
      noOfCopies = $("#noOfCopies").val();

      $.ajax({
        url: '{{ route("updateCartItem") }}',
        type: 'POST',
        dataType: 'json',
        data: {qty: qty, noOfCopies:noOfCopies},
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