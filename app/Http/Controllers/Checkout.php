<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\PricingModel;
use App\Models\BindingModel;
use App\Models\LaminationModel;
use App\Models\CoverModel;
use App\Models\ShippingModel;
use App\Models\CartModel;
use App\Models\CouponModel;
use App\Models\CustomerAddressModel;
use App\Models\OrderModel;

use Ixudra\Curl\Facades\Curl;

// Dropbox
use Storage;
use League\Flysystem\Filesystem;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Spatie\Dropbox\Client as DropboxClient; // Import the DropboxClient

//GDrive
use App\Services\GoogleDriveService;

class Checkout extends Controller {

	private $status = array();

	public function index(Request $request) {

		//remove payment session & document session
		Session::forget('paymentSess');
		Session::forget('documents');

		$tempId = $request->cookie('tempUserId');		

		//check if user logged in
		$userId = customerId();

		if (empty($userId)) {
			return redirect()->route('loginPage', ['action' => 'checkout']);
		}

		$cond = ['product.is_active' => 1];

		if (!empty($userId)) {
			$cond['cart.user_id'] = $userId;
		} else {
			$cond['cart.temp_id'] = $tempId;
		}

		$getCartData = CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->select('cart.*', 'product.name', 'product.thumbnail_id')
		->orderBy('cart.id', 'desc')
		->take(1)
		->get();

		if (!empty($getCartData) && $getCartData->count()) {

			//Get Customer Address
			$customerAddress = CustomerAddressModel::where('user_id', $userId)->first();
		
			$data = array(
				'title' => 'Checkout',
				'pageTitle' => 'Checkout',
				'menu' => 'checkout',
				'cartData' => $getCartData,
				'productPrice' => productPrice(),
				'customerData' => customerData(),
				'customerAddress' => $customerAddress,
			);

			return view('frontend/checkout', $data);

		} else {
			return redirect()->route('homePage');
		}

	}

	public function doSaveAddress(Request $request) {

		if ($request->ajax()) {

			//check if is customer logged in
			if (!customerId()){
				$this->status = array(
					'error' => true,
					'eType' => 'final',
					'msg' => 'Please login to save the address.'
				);
				return json_encode($this->status);
			}

			$obj = [
				'shippingName' => 'required',
				'shippingCompanyName' => 'sometimes|nullable',
				'shippingAddress' => 'required',
				'shippingCity' => 'required',
	            'shippingState' => 'required',
	            'shippingPincode' => 'required|numeric|digits:6',
	            'shippingEmail' => 'required|email',
	            'shippingPhone' => 'required|numeric',
	            'gstNumber' => 'sometimes|nullable',
	        ];

	        $isBillingAddrSame = $request->post('isBillingAddressSame');

	        if (!isset($isBillingAddrSame)) {
	        	$obj['billingName'] = 'required';
	        	$obj['billingCompanyName'] = 'sometimes|nullable';
	        	$obj['billingAddress'] = 'required';
	        	$obj['billingCity'] = 'required';
	        	$obj['billingState'] = 'required';
	        	$obj['billingPincode'] = 'required|numeric|digits:6';
	        	$obj['billingEmail'] = 'required|email';
	        	$obj['billingPhone'] = 'required|numeric';
	        }

			$validator = Validator::make($request->post(), $obj);

	        if ($validator->fails()) {
	            
	            $errors = $validator->errors()->getMessages();

	            $this->status = array(
					'error' => true,
					'eType' => 'field',
					'errors' => $errors,
					'msg' => 'Validation failed'
				);

	        } else {

	        	$shippingPincode = $request->post('shippingPincode');

	        	//check if pincode exist
	        	$isPincodeExist = ShippingModel::where(['pincode' => $shippingPincode, 'is_active' => 1])->first();

	        	if (!empty($isPincodeExist) && $isPincodeExist->count()) {
	        		
	        		//check if customer address exist
	        		$userId = customerId();
	        		$getCustomerAdd = CustomerAddressModel::where('user_id', $userId)->first();

	        		//Remove shipping session
	        		Session::forget('shippingSess');

	        		$obj = [
	        			'user_id' => $userId,
						'shipping_name' => $request->post('shippingName'),
						'shipping_company_name' => $request->post('shippingCompanyName'),
						'shipping_address' => $request->post('shippingAddress'),
						'shipping_city' => $request->post('shippingCity'),
			            'shipping_state' => $request->post('shippingState'),
			            'shipping_pincode' => $request->post('shippingPincode'),
			            'shipping_email' => $request->post('shippingEmail'),
			            'shipping_phone' => $request->post('shippingPhone'),
			            'gst_number' => $request->post('gstNumber'),
			            'is_billing_same' => 1,
			        ];

			        $isBillingAddrSame = $request->post('isBillingAddressSame');

			        if (!isset($isBillingAddrSame)) {
			        	$obj['is_billing_same'] = 0;
			        	$obj['billing_name'] = $request->post('billingName');
			        	$obj['billing_company_name'] = $request->post('billingCompanyName');
			        	$obj['billing_address'] = $request->post('billingAddress');
			        	$obj['billing_city'] = $request->post('billingCity');
			        	$obj['billing_state'] = $request->post('billingState');
			        	$obj['billing_pincode'] = $request->post('billingPincode');
			        	$obj['billing_email'] = $request->post('billingPincode');
			        	$obj['billing_phone'] = $request->post('billingPhone');
			        }

	        		if (!empty($getCustomerAdd) && $getCustomerAdd->count()) {
	        			//update
	        			$isUpdated = CustomerAddressModel::where('user_id', $userId)->update($obj);
	        		} else {
	        			//insert
	        			$isUpdated = CustomerAddressModel::create($obj);
	        		}

	        		/*
	        			1. Get Total Amount
	        			2. Check Free Shipping
	        			3. Get Weight
	        			4. Get Weight Price
	        		*/

	        		$productPrice = productPrice();
	        		$totalAmount = $productPrice->total;
	        		$totalWeight = cartWeight(); //in kg
	        		$totalWeightInGm = $totalWeight*1000;


	        		$shipping = 0;

	        		//check free shipping
	        		if ($isPincodeExist->free_shipping && ($totalAmount >= $isPincodeExist->free_shipping)) {
	        			$shipping = 0;
	        		} elseif ($totalWeightInGm <= 500) {
	        			$shipping = $isPincodeExist->under_500gm;
	        		} elseif ($totalWeightInGm <= 1000) {
	        			$shipping = $isPincodeExist->from500_1000gm;
	        		} elseif ($totalWeightInGm <= 2000) {
	        			$shipping = $isPincodeExist->from1000_2000gm;
	        		} elseif ($totalWeightInGm <= 3000) {
	        			$shipping = $isPincodeExist->from2000_3000gm;
	        		}

	        		$shippingSessObj = [
	        			'pincode' => $request->post('shippingPincode'),
	        			'shipping' => $shipping
	        		];

	        		$request->session()->put('shippingSess', $shippingSessObj);

	        		$priceData = productPrice();

	        		$this->status = array(
						'error' => false,						
						'msg' => 'The address has been saved',
						'priceData' => $priceData
					);

	        	} else {
	        		$this->status = array(
						'error' => true,
						'eType' => 'field',
						'errors' => ['shippingPincode' => 'The delivery is not available on this pincode'],
						'msg' => 'Validation failed'
					);
	        	}

	        }

		} else {
			$this->status = array(
				'error' => true,
				'eType' => 'final',
				'msg' => 'Something went wrong'
			);
		}

		echo json_encode($this->status);

	}

	public function doPlaceOrder(Request $request) {

		if ($request->ajax()) {

			//check if is customer logged in
			if (!customerId()){
				$this->status = array(
					'error' => true,
					'eType' => 'final',
					'msg' => 'Please login to save the address.'
				);
				return json_encode($this->status);
			}

			$obj = [
				'shippingName' => 'required',
				'shippingCompanyName' => 'sometimes|nullable',
				'shippingAddress' => 'required',
				'shippingCity' => 'required',
	            'shippingState' => 'required',
	            'shippingPincode' => 'required|numeric|digits:6',
	            'shippingEmail' => 'required|email',
	            'shippingPhone' => 'required|numeric',
	            'gstNumber' => 'sometimes|nullable',
	            'acceptTermsCondition' => 'required',
	        ];

	        $isBillingAddrSame = $request->post('isBillingAddressSame');

	        if (!isset($isBillingAddrSame)) {
	        	$obj['billingName'] = 'required';
	        	$obj['billingCompanyName'] = 'sometimes|nullable';
	        	$obj['billingAddress'] = 'required';
	        	$obj['billingCity'] = 'required';
	        	$obj['billingState'] = 'required';
	        	$obj['billingPincode'] = 'required|numeric|digits:6';
	        	$obj['billingEmail'] = 'required|email';
	        	$obj['billingPhone'] = 'required|numeric';
	        }

			$validator = Validator::make($request->post(), $obj);

	        if ($validator->fails()) {
	            
	            $errors = $validator->errors()->getMessages();

	            $this->status = array(
					'error' => true,
					'eType' => 'field',
					'errors' => $errors,
					'msg' => 'Validation failed'
				);

	        } else {

	        	$shippingPincode = $request->post('shippingPincode');

	        	//check if pincode exist
	        	$isPincodeExist = ShippingModel::where(['pincode' => $shippingPincode, 'is_active' => 1])->first();

	        	if (!empty($isPincodeExist) && $isPincodeExist->count()) {
	        		
	        		//check if customer address exist
	        		$userId = customerId();
	        		$getCustomerAdd = CustomerAddressModel::where('user_id', $userId)->first();

	        		//Remove shipping session
	        		Session::forget('shippingSess');

	        		$obj = [
	        			'user_id' => $userId,
						'shipping_name' => $request->post('shippingName'),
						'shipping_company_name' => $request->post('shippingCompanyName'),
						'shipping_address' => $request->post('shippingAddress'),
						'shipping_city' => $request->post('shippingCity'),
			            'shipping_state' => $request->post('shippingState'),
			            'shipping_pincode' => $request->post('shippingPincode'),
			            'shipping_email' => $request->post('shippingEmail'),
			            'shipping_phone' => $request->post('shippingPhone'),
			            'gst_number' => $request->post('gstNumber'),
			            'is_billing_same' => 1,
			        ];

			        $isBillingAddrSame = $request->post('isBillingAddressSame');

			        if (!isset($isBillingAddrSame)) {
			        	$obj['is_billing_same'] = 0;
			        	$obj['billing_name'] = $request->post('billingName');
			        	$obj['billing_company_name'] = $request->post('billingCompanyName');
			        	$obj['billing_address'] = $request->post('billingAddress');
			        	$obj['billing_city'] = $request->post('billingCity');
			        	$obj['billing_state'] = $request->post('billingState');
			        	$obj['billing_pincode'] = $request->post('billingPincode');
			        	$obj['billing_email'] = $request->post('billingPincode');
			        	$obj['billing_phone'] = $request->post('billingPhone');
			        }

	        		if (!empty($getCustomerAdd) && $getCustomerAdd->count()) {
	        			//update
	        			$isUpdated = CustomerAddressModel::where('user_id', $userId)->update($obj);
	        		} else {
	        			//insert
	        			$isUpdated = CustomerAddressModel::create($obj);
	        		}

	        		/*
	        			1. Get Total Amount
	        			2. Check Free Shipping
	        			3. Get Weight
	        			4. Get Weight Price
	        		*/

	        		$productPrice = productPrice();
	        		$totalAmount = $productPrice->total;
	        		$totalWeight = cartWeight(); //in kg
	        		$totalWeightInGm = $totalWeight*1000;


	        		$shipping = 0;

	        		//check free shipping
	        		if ($isPincodeExist->free_shipping && ($totalAmount >= $isPincodeExist->free_shipping)) {
	        			$shipping = 0;
	        		} elseif ($totalWeightInGm <= 500) {
	        			$shipping = $isPincodeExist->under_500gm;
	        		} elseif ($totalWeightInGm <= 1000) {
	        			$shipping = $isPincodeExist->from500_1000gm;
	        		} elseif ($totalWeightInGm <= 2000) {
	        			$shipping = $isPincodeExist->from1000_2000gm;
	        		} elseif ($totalWeightInGm <= 3000) {
	        			$shipping = $isPincodeExist->from2000_3000gm;
	        		}

	        		$shippingSessObj = [
	        			'pincode' => $request->post('shippingPincode'),
	        			'shipping' => $shipping
	        		];

	        		$request->session()->put('shippingSess', $shippingSessObj);

	        		$priceData = productPrice();
	        		$weightData = cartWeight();
	        		$productSpec = productSpec(getCartId());
	        		$shippingSess = Session::get('shippingSess');
	        		$couponSess = Session::get('couponSess');
	        		$documentSess = Session::get('documents');
	        		
	        		//check document session

	        		if (empty($documentSess)) {
	        			
	        			$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'Please upload your document'
						);

						echo json_encode($this->status);
						die();
						
	        		}

	        		// print_r($priceData);
	        		// print_r($weightData);
	        		// print_r($shippingSess);
	        		// print_r($couponSess);

	        		// $paidAmount = ceil($priceData->total*100);
	        		$paidAmount = $priceData->total*100;
	        		$transactionId = uniqid();

	        		$paymentObj = array (
			            'merchantId' => env("PROD_MERCHANT_ID"),
			            'merchantTransactionId' => $transactionId,
			            'merchantUserId' => 'MUID123',
			            'amount' => $paidAmount,
			            'redirectUrl' => route('response'),
			            'redirectMode' => 'REDIRECT',
			            'callbackUrl' => route('response'),
			            'mobileNumber' => $request->post('shippingPhone'),
			            'paymentInstrument' => array (
			            	'type' => 'PAY_PAGE',
			            ),
			        );

			        $encode = base64_encode(json_encode($paymentObj));
			        $saltKey = env('PROD_MERCHANT_KEY');
        			$saltIndex = 1;

        			$string = $encode.'/pg/v1/pay'.$saltKey;
        			$sha256 = hash('sha256',$string);
        			$finalXHeader = $sha256.'###'.$saltIndex;
        			$url = env('PROD_URL')."/pg/v1/pay";

        			$response = Curl::to($url)
	                ->withHeader('Content-Type:application/json')
	                ->withHeader('X-VERIFY:'.$finalXHeader)
	                ->withData(json_encode(['request' => $encode]))
	                ->post();

	                $rData = json_decode($response);

	        		if (isset($rData->success) && $rData->success) {

	        			Session::forget('paymentSess');

	        			//create session for payment initiated
	        			$paymentInitObj = [
		        			'transactionId' => $transactionId,
		        			'paidAmount' => $paidAmount,
		        		];

		        		$request->session()->put('paymentSess', $paymentInitObj);
	        			
	        			$this->status = array(
							'error' => false,
							'redirect' => $rData->data->instrumentResponse->redirectInfo->url,
							'msg' => 'Payment Initiated'
						);

	        		} else {
	        			$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'Something went wrong'
						);
	        		}

	        	} else {
	        		$this->status = array(
						'error' => true,
						'eType' => 'field',
						'errors' => ['shippingPincode' => 'The delivery is not available on this pincode'],
						'msg' => 'Validation failed'
					);
	        	}

	        }

		} else {
			$this->status = array(
				'error' => true,
				'eType' => 'final',
				'msg' => 'Something went wrong'
			);
		}

		echo json_encode($this->status);

	}

	public function response(Request $request) {
        $input = $request->all();

        $paymentSess = Session::get('paymentSess');

        if (!empty($paymentSess)) {
       
	        $merchantId = env("PROD_MERCHANT_ID");
	        $transactionId = $paymentSess['transactionId'];

	        $saltKey = env('PROD_MERCHANT_KEY');
	        $saltIndex = 1;

	        $finalXHeader = hash('sha256','/pg/v1/status/'.$merchantId.'/'.$transactionId.$saltKey).'###'.$saltIndex;

	        $response = Curl::to(env('PROD_URL').'/pg/v1/status/'.$merchantId.'/'.$transactionId)
	                ->withHeader('Content-Type:application/json')
	                ->withHeader('accept:application/json')
	                ->withHeader('X-VERIFY:'.$finalXHeader)
	                ->withHeader('X-MERCHANT-ID:'.$transactionId)
	                ->get();

	        $response = json_decode($response);

	        if (isset($response->success) && $response->success) {

	        	/*
	        		Remove Session
	        			* Payment Init
	        			* Shipping
	        			* Coupon

	        		Remove All Cart Items

	        	*/

	        	$productPrice = productPrice();

	        	$couponCode = null;
	        	$discount = 0;

	        	$couponData = Session::get('couponSess');

	        	if (!empty($couponData)) {
	        		$couponCode = $couponData['coupon_code'];
	        		$discount = $couponData['discount'];
	        	}	 

	        	$shipping = 0;

	        	$shippingData = Session::get('shippingSess');
	        	if (!empty($shippingData)) {
	        		$shipping = $shippingData['shipping'];
	        	}

	        	$customerAdd = CustomerAddressModel::where('user_id', customerId())->first();

	        	$getCartData = CartModel::where('user_id', customerId())
	        	->orderBy('cart.id', 'desc')
	        	->first();
	        	$productName = ProductModel::where('id', getCartProductId())->value('name');

	        	$orderObj = array(
	        		'order_id' => $transactionId,
	        		'user_id' => customerId(),
	        		'product_id' => getCartProductId(),
	        		'product_name' => $productName,
	        		'product_details' => json_encode(productSpec(getCartId())),
	        		'weight_details' => json_encode(cartWeight()),
	        		'coupon_code' => $couponCode,
	        		'discount' => $discount,
	        		'shipping' => $shipping,
	        		// 'paid_amount' => ceil($productPrice->total),
	        		'paid_amount' => $productPrice->total,
	        		'price_details' => json_encode($productPrice),
	        		'transaction_details' => json_encode($response->data),
	        		'customer_address' => json_encode($customerAdd->toArray()),
	        		'document_link' => $getCartData->document_link,
	        		'qty' => $getCartData->qty,
	        		'no_of_copies' => $getCartData->no_of_copies,
	        	);

	        	$isOrderCreated = OrderModel::create($orderObj);
	        	
	        	if ($isOrderCreated) {

	        		//Remove Cart Data
	        		CartModel::where('user_id', customerId())->delete();
	        		
	        		Session::forget('shippingSess');
	        		Session::forget('couponSess');
	        		Session::forget('paymentSess');
	        		Session::forget('documents');

	        		return redirect()->route('thankyouPage', ['amount' => $orderObj['paid_amount'], 'transaction_id' => $orderObj['order_id']]);

	        	} else {
	        		return redirect()->route('paymentFailPage');
	        	}

	        } else {
	        	return redirect()->route('paymentFailPage');
	        }

        } else {
        	return redirect()->route('checkoutPage');
        }
        
    }

    public function doUploadDropbox(Request $request) {

    	if ($request->ajax()) {

			$validator = Validator::make($request->all(), [
	            'file.*' => 'required|mimes:png,jpg,jpeg,pdf,zip|max:10024',
	        ]);

	        if ($validator->fails()) {
	            
	            $errors = $validator->errors()->getMessages();

	            $this->status = array(
					'error' => true,
					'eType' => 'field',
					'errors' => $errors,
					'msg' => 'Validation failed'
				);

	        } else {

	        	$files = $request->file('file');
	        	$customerId = customerId();

	        	//check customer is logged in

	        	if (!$customerId) {
	        		
	        		$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'Please login to upload your document.'
					);


	        	} else {
	        		
	        		//Dropbox
	        		$token = config('filesystems.disks.dropbox.token');
	        		$dropboxClient = new DropboxClient($token);
					$adapter = new DropboxAdapter($dropboxClient);
					$filesystem = new Filesystem($adapter);

					//Gdrive
					$googleDriveService = new GoogleDriveService();

	        		$uploadedFileList = [];
	        		$year = date('Y');
		        	$month = date('m');
		        	$date = date('d');

		        	foreach ($files as $file) {

		        		$uniqueId = md5(microtime());
		        		
		        		$originalName = $file->getClientOriginalName();
		        		$originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

		        		$ext = $file->extension();
		        		//$size = formatSize($file->getSize());
		        		$size = $file->getSize();

		        		$nameWithoutExtSlugify = Str::slug($originalNameWithoutExt.'-'.$uniqueId);
			        	$finalName = $nameWithoutExtSlugify.'.'.$ext;

			        	$craftPath = $year.'/'.$month.'/'.$date;
						$path = $year.'/'.$month.'/'.$date. '/' . $finalName;
						//$filesystem->write($path, file_get_contents($file->getRealPath()));

						//$filePath = $file->storeAs($craftPath, $finalName);
						//$folderId = '1AgOwXplcpb1Y1xW-MYQ6FAgDhP_mC3Sw';
						$folderId = '1KYl_BlpStYJRqTg7-yMELsvEx8dqWFBu';
						//$fileId = $googleDriveService->uploadFile(storage_path("app/{$filePath}"), $folderId);

						$fileContent = $file->get();
						$fileId = $googleDriveService->uploadFileContent($fileContent, $folderId, $finalName);

						//$uploadedFileList[] = $path;
						$uploadedFileList[] = $finalName;

		        	}	

		        	if (!empty($uploadedFileList)) {

		        		//get stored document if any from the documents session
		        		$storedDocs = Session::get('documents');

		        		if (!empty($storedDocs)) {
		        			
		        			$oldDocs = json_decode($storedDocs);
		        			$newDocs = $uploadedFileList;

		        			$fileList = array_merge($oldDocs, $newDocs);
		        			$fileList = json_encode($fileList);

		        		} else {
		        			$fileList = json_encode($uploadedFileList);
		        		}

		        		$obj = array('document_link' => $fileList);

		        		//create session to store files
		        		$sessionObj = $fileList;
		        		$request->session()->put('documents', $fileList);

		        		$isUploaded = CartModel::where('user_id', $customerId)->update($obj);

		        		if ($isUploaded) {
	        		
			        		$this->status = array(
								'error' => false,
								'msg' => 'Document has been uploaded successfully.'
							);

			        	} else {

			        		$this->status = array(
								'error' => true,
								'eType' => 'final',
								'msg' => 'Something went wrong.'
							);

			        	}


		        	} else {

		        		$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'Something went wrong'
						);

		        	}

	        	}
	        	
	        }


		} else {
			$this->status = array(
				'error' => true,
				'eType' => 'final',
				'msg' => 'Something went wrong'
			);
		}

		echo json_encode($this->status);
    }

}