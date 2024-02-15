@extends('admin.vwAdminMaster')

@section('content')

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " >
    <div id="kt_app_content_container" class="app-container  container-fluid ">

        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Order Details</h3>
                </div>

                <div class="card-title">
                    <a href="{{ route('adminOrders') }}" class="btn btn-primary">Back</a>
                </div>

            </div>
            
            <div id="kt_account_settings_profile_details" class="collapse show">                
                <form id="kt_form" class="form" action="">
                    <div class="card-body border-top p-9">

                       <table class="table table-bordered">
                           <tr>
                               <th>Order ID</th>
                               <td>{{ strtoupper($order->order_id) }}</td>
                           </tr>
                           <tr>
                               <th>Order Date</th>
                               <td>{{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</td>
                           </tr>
                           <tr>
                               <th>Customer Name</th>
                               <td>{{ strtoupper($customer->name) }}</td>
                           </tr>
                           <tr>
                               <th>Customer Email</th>
                               <td>{{ $customer->email }}</td>
                           </tr>
                           <tr>
                               <th>Customer Phone</th>
                               <td>{{ $customer->phone }}</td>
                           </tr>
                           <tr>
                               <th>Product Name</th>
                               <td>{{ $order->product_name }}</td>
                           </tr>
                           <tr>
                               <th>Qty</th>
                               <td>{{ $order->qty }}</td>
                           </tr>
                           <tr>
                               <th>No of Copies</th>
                               <td>{{ $order->no_of_copies }}</td>
                           </tr>
                           <tr>
                               <th>Coupon Code</th>
                               <td>{{ $order->coupon_code }}</td>
                           </tr>
                           <tr>
                               <th>Discount</th>
                               <td>{{ $order->discount }}</td>
                           </tr>
                           <tr>
                               <th>Shipping</th>
                               <td>{{ $order->shipping }}</td>
                           </tr>
                           <tr>
                               <th>Paid Amount</th>
                               <td>{{ $order->paid_amount }}</td>
                           </tr>
                           <tr>
                               <th>Product Detail</th>
                               <td>{!! json_decode($order->product_details) !!}</td>
                           </tr>
                           <tr>
                               <th>Price Details</th>
                               <td>
                                   <li><strong>Per Sheet Weight:</strong> {{ $priceDetail->per_sheet_weight }}</li>
                                   <li><strong>Paper Type Price:</strong> {{ $priceDetail->paper_type_price }}</li>
                                   <li><strong>Color & Print Side:</strong> {{ $priceDetail->printSideAndColorPrice }}</li>
                                   <li><strong>Binding:</strong> {{ $priceDetail->binding }}</li>
                                   <li><strong>Lamination:</strong> {{ $priceDetail->lamination }}</li>
                                   <li><strong>Cover:</strong> {{ $priceDetail->cover }}</li>
                               </td>
                           </tr>
                           <tr>
                               <th>Transactions Details</th>
                               <td>
                                   <li>Transaction Id: {{ $transactionDetail->transactionId }}</li>
                                   <li>Status: {{ $transactionDetail->responseCode }}</li>
                               </td>
                           </tr>

                           <tr>
                               <th>Document Link</th>
                               <td>
                                   @if(!empty($documentLinks))
                                   @foreach($documentLinks as $docLink)
                                    <li>{{ $docLink }}</li>
                                   @endforeach
                                   @endif
                               </td>
                           </tr>
                           <tr>
                               <th>Customer Address</th>
                               <td>
                                   <li><strong>Shipping Name:</strong> {{ $addressDetails->shipping_name }}</li>
                                   <li><strong>Shipping Company Name:</strong> {{ $addressDetails->shipping_company_name }}</li>
                                   <li><strong>Shipping Address:</strong> {{ $addressDetails->shipping_address }}</li>
                                   <li><strong>Shipping City:</strong> {{ $addressDetails->shipping_city }}</li>
                                   <li><strong>Shipping State:</strong> {{ $addressDetails->shipping_state }}</li>
                                   <li><strong>Shipping Pincode:</strong> {{ $addressDetails->shipping_pincode }}</li>
                                   <li><strong>Shipping Email:</strong> {{ $addressDetails->shipping_email }}</li>
                                   <li><strong>Shipping Phone:</strong> {{ $addressDetails->shipping_phone }}</li>
                                   <li><strong>Is Billing Address Same:</strong> {{ ($addressDetails->is_billing_same == 1)? 'Yes':'No';}}</li>
                               </td> 
                           </tr>
                           @if($addressDetails->is_billing_same != 1)
                           <tr>
                               <th>Billing Address</th>
                               <td>
                                   <li><strong>Billing Name:</strong> {{ $addressDetails->billing_name }}</li>
                                   <li><strong>Billing Company Name:</strong> {{ $addressDetails->billing_company_name }}</li>
                                   <li><strong>Billing Address:</strong> {{ $addressDetails->billing_address }}</li>
                                   <li><strong>Billing City:</strong> {{ $addressDetails->billing_city }}</li>
                                   <li><strong>Billing State:</strong> {{ $addressDetails->billing_state }}</li>
                                   <li><strong>Billing Pincode:</strong> {{ $addressDetails->billing_pincode }}</li>
                                   <li><strong>Billing Email:</strong> {{ $addressDetails->billing_email }}</li>
                                   <li><strong>Billing Phone:</strong> {{ $addressDetails->billing_phone }}</li>
                               </td> 
                           </tr>
                           @endif
                           
                       </table>

                    </div>      
                </form>
            </div>
        </div>

    </div>
</div>

    <!--begin::Custom Javascript(used for this page only)-->
    <script type="text/javascript">
        dataUrl = '{{ route("getAdminOrders") }}';        
    </script>
    <script src="{{ asset('public/backend/js/admin/orders.js') }}"></script>

@endsection