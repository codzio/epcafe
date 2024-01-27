<!-- header -->
  <header>
    <div class="sticky">
      <div class="container"> 
        
        <!-- Logo -->
        <div class="logo"> <a href="{{ route('homePage') }}"><img class="img-responsive" src="{{ asset('public/frontend') }}/images/logo.png" alt="" ></a> </div>
        <nav class="navbar ownmenu">
         <div class="mobile_ham_flex">
           <div class="mobile_hamburger">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"><i class="fa fa-navicon"></i></span> </button>
          </div>
          
         </div>  
         <!-- Nav Right -->
          <div class="nav-right for-mobile">
            <ul class="navbar-right">
              
              <!-- USER INFO -->
              <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <h6>HELLO! Jhon Smith</h6>
                  </li>
                  <li><a href="shopping-cart.html">MY CART</a></li>
                  <li><a href="#">ACCOUNT INFO</a></li>
                  <li><a href="#">LOG OUT</a></li>
                </ul>
              </li>
              
              <!-- USER BASKET -->
              <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="{{ asset('public/frontend') }}/images/cart-img-1.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD CHAIR</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="{{ asset('public/frontend') }}/images/cart-img-2.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD STOOL</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <h5 class="text-center">SUBTOTAL: 258.00 USD</h5>
                  </li>
                  <li class="margin-0">
                    <div class="row">
                      <div class="col-xs-6"> <a href="shopping-cart.html" class="btn">VIEW CART</a></div>
                      <div class="col-xs-6 "> <a href="checkout.html" class="btn">CHECK OUT</a></div>
                    </div>
                  </li>
                </ul>
              </li>
              
              <!-- SEARCH BAR -->
              <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                  <div class="search-overlay"></div>
                  <div class="position-center-center">
                    <div class="search">
                      <form>
                        <input type="search" placeholder="Search Shop">
                        <button type="submit"><i class="icon-check"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
         </div>
          <!-- NAV -->
          <div class="collapse navbar-collapse" id="nav-open-btn">
            <ul class="nav">
              <li class="{{ $menu == 'home'? 'active':''; }}"> 
                <a href="{{ route('homePage') }}" class="dropdown-toggle">Home</a>
              </li>
              <li class="dropdown"> <a href="shop_01.html" class="dropdown-toggle" data-toggle="dropdown">All Products</a>
                <ul class="dropdown-menu hover_mega_menu">
                    <!-- <a href="{{ route('homePage') }}">Index Default</a> -->
                    <div class="tab">
                      <button class="tablinks active" onmouseover="openCity(event, 'London')">Document</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Paris')">Books</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo')">Thesis & Disseration</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo2')">certificate & cards</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo3')">marketing materials</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo4')">posters</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo5')">flyers or leaflefts</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo6')">letterhead & stationery</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo7')">visiting cards</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo8')">business statinoery</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo9')">visiting cards</button> 
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo10')">business statinoery</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo11')">personalised gifts</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo12')">stickers and labels</button>
                      <button class="tablinks" onmouseover="openCity(event, 'Tokyo13')">document binding</button>
                    </div>
                    <div id="London" class="tabcontent" style="display: block;">
                      <h3>DOCUMENT</h3>
                      <p>London is the capital city of England.</p>
                    </div>
                    <div id="Paris" class="tabcontent">
                      <h3>BOOKS</h3>
                      <p>Paris is the capital of France.</p> 
                    </div>
                    <div id="Tokyo" class="tabcontent">
                      <h3>THESIS & DISSERATION</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo2" class="tabcontent">
                      <h3>CERTIFICATE & CARDS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo3" class="tabcontent">
                      <h3>MARKETING MATERIALS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo4" class="tabcontent">
                      <h3>POSTERS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo5" class="tabcontent">
                      <h3>FLYERS OR LEAFLETFS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo6" class="tabcontent">
                      <h3>LETTERHEAD & STATIONERY</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo7" class="tabcontent">
                      <h3>VISITING CARDS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo8" class="tabcontent">
                      <h3>BUSINESS STATIONERY</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo9" class="tabcontent">
                      <h3>VISITING CARDS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo10" class="tabcontent">
                      <h3>BUSINESS STATIONERY</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo11" class="tabcontent">
                      <h3>PERSONALISED GIFTS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo12" class="tabcontent">
                      <h3>STICKER & LABELS</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Tokyo13" class="tabcontent">
                      <h3>DOCUMENT BINDING</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div class="clearfix"></div>
                </ul>
              </li>
              <li class="{{ $menu == 'about'? 'active':''; }}"> <a href="{{ route('aboutPage') }}">About </a> </li>
              <li class="{{ $menu == 'contact'? 'active':''; }}"> <a href="{{ route('contactPage') }}"> contact</a> </li>
            </ul>
          </div>  

          <!-- Nav Right -->
          <div class="nav-right">
            <ul class="navbar-right">
              
              <!-- USER INFO -->
              <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <h6>HELLO! Jhon Smith</h6>
                  </li>
                  <li><a href="#">MY CART</a></li>
                  <li><a href="#">ACCOUNT INFO</a></li>
                  <li><a href="#">LOG OUT</a></li>
                </ul>
              </li>
              
              <!-- USER BASKET -->
              <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="{{ asset('public/frontend') }}/images/cart-img-1.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD CHAIR</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="{{ asset('public/frontend') }}/images/cart-img-2.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD STOOL</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <h5 class="text-center">SUBTOTAL: 258.00 USD</h5>
                  </li>
                  <li class="margin-0">
                    <div class="row">
                      <div class="col-xs-6"> <a href="shopping-cart.html" class="btn">VIEW CART</a></div>
                      <div class="col-xs-6 "> <a href="checkout.html" class="btn">CHECK OUT</a></div>
                    </div>
                  </li>
                </ul>
              </li>
              
              <!-- SEARCH BAR -->
              <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                  <div class="search-overlay"></div>
                  <div class="position-center-center">
                    <div class="search">
                      <form>
                        <input type="search" placeholder="Search Shop">
                        <button type="submit"><i class="icon-check"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          
          
        </nav>
      </div>
    </div>
  </header>