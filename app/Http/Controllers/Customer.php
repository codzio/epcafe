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

use App\Models\CustomerModel;
use App\Models\CartModel;
use App\Models\CustomerAddressModel;
use App\Models\OrderModel;



class Customer extends Controller {

	private $status = array();

	public function dashboard(Request $request) {

		$customerId =customerId();

		if (empty($customerId)) {
			return view('frontend/login');
		}else{
			$cond = [
	    		['id', $customerId],
	    	];

	    	$customer = CustomerModel::where($cond)->first();

	    	$address = CustomerAddressModel::where($cond)->first();

	    	$orders = OrderModel::where(['user_id' => $customerId])->first();

	    	$productDetails= json_decode($orders->product_details);

	    	$priceDetailsComp= json_decode($orders->price_details);

	    	$customerAdd= json_decode($orders->customer_address);


	    	// echo "<pre>";
	    	// print_r($orders->toArray());
	    	// print_r($productDetails);
	    	// print_r($priceDetailsComp);
	    	// print_r($customerAdd);
	    	// die();

			$data = array(
				'title' => 'Dashboard',
				'pageTitle' => 'Dashboard',
				'menu' => 'dashboard',
				'customer' => $customer,
				'address' => $address,
				'customerAdd' => $customerAdd,
				'productDetails' => $productDetails,
				'priceDetailsComp' => $priceDetailsComp,
				'orders' => $orders,
			);

			return view('frontend/dashboard', $data);
		}

	}

	public function logout() {
		// Session::forget('adminTwoFactorSess');
		Session::forget('customerSess');
		return redirect(route('loginPage'));
	}

	public function login(Request $request) {

		$action = $request->get('action');

		$data = array(
			'title' => 'Login',
			'pageTitle' => 'Login',
			'menu' => 'login',
			'action' => $action
		);

		$customerSess = Session::get('customerSess');
		
		if (empty($customerSess)) {

			return view('frontend/login', $data);;

		} else {
			return redirect(route('customerDashboard'));
		}

	}

	public function forgetPassword(Request $request) {

		$data = array(
			'title' => 'Forget Passwoord',
			'pageTitle' => 'Forget Passwoord',
			'menu' => 'forget-password',
		);

		return view('frontend/forgetPassword', $data);

	}

	public function register(Request $request) {

		$data = array(
			'title' => 'Register',
			'pageTitle' => 'Register',
			'menu' => 'register',
		);

		$customerSess = Session::get('customerSess');
		
		if (empty($customerSess)) {

			return view('frontend/register', $data);;

		} else {
			return redirect(route('customerDashboard'));
		}

	}

	public function doRegister(Request $request) {
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
			    'name' => 'required',
			    'email' => 'required|email|unique:customer,email',
			    'phone' => 'required|numeric|digits:10',
			    'address' => 'required',
			    'city' => 'required',
			    'state' => 'required',
			    'password' => 'required',
			    'confirmPassword' => 'required_with:password|same:password|min:6',
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

	        	$obj = [
	        		'name' => $request->post('name'),
	        		'email' => $request->post('email'),
	        		'phone' => $request->post('phone'),
	        		'address' => $request->post('address'),
	        		'city' => $request->post('city'),
	        		'state' => $request->post('state'),
	        		'password' => Hash::make($request->post('password')),
	        	];

	        	$isAdded = CustomerModel::create($obj);

	        	if ($isAdded) {

	        		$customer = CustomerModel::latest()->first();
	        		$request->session()->put('customerSess', ['customerId' => $customer->id]);

    				$this->status = array(
						'error' => false,								
						'msg' => 'Your account has been created sucessfully',
						'redirect' => route('customerDashboard'),
					);

    			} else {
    				$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'Something went wrong.'
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

		return response($this->status);
	}


	public function doLogin(Request $request) {
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
	            'email' => 'required|email',
	            'password' => 'required',
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
	        	
	        	$cond = [
	        		['email', $request->post('email')],
	        	];

	        	$getCustomer = CustomerModel::where($cond)->first();

	        	if (!empty($getCustomer)) {

	        		//check if password match
	        		if (Hash::check($request->post('password'), $getCustomer->password)) {

	        				$request->session()->put('customerSess', array(
			        			'customerId' => $getCustomer->id
			        		));

			        		//update customer id if cart data exist
			        		updateUserIdInCart();

			        		$redirectUrl = route('customerDashboard');

			        		if (!empty($request->post('action'))) {
			        			if ($request->post('action') == 'checkout') {
			        				$redirectUrl = route('checkoutPage');
			        			}
			        		}

		        			$this->status = array(
								'error' => false,
								'redirect' => $redirectUrl
							);

	        		} else {
	        			
	        			$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'The email or password you provided may be incorrect.'
						);

	        		}

	        	} else {
	        		$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'It appears that either your email or password might be incorrect.'
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

		return response($this->status);
	}

	public function doForgotPassword(Request $request) {
		
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
	            'email' => 'required|email',	            
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
	        	
	        	$cond = [
	        		['email', $request->post('email')],
	        	];

	        	$getCustomer = CustomerModel::where($cond)->first();

	        	if (!empty($getCustomer)) {

	        		$token = bin2hex(random_bytes(20));
	        		$tokenExpiry = date('Y-m-d');

	        		$getCustomer->forgot_token = $token;
	        		$getCustomer->forgot_token_validity = $tokenExpiry;
	        		$getCustomer->save();

    				$forgotPass = array(
    					'name' => $getCustomer->name,
    					'email' => $getCustomer->email,
    					'token' => $token,
    					'tokenExpiry' => $tokenExpiry,
    				);

    				$isMailSent = EmailSending::customerResetPassword($forgotPass);
					//$isMailSent = true;

					if ($isMailSent) {

		        		$this->status = array(
							'error' => false,
							'msg' => 'Please check your inbox and follow the provided link to reset your password.',
							'redirect' => route('loginPage')
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
						'eType' => 'final',
						'msg' => 'It appears that either your email might be incorrect, or your account could be inactive.'
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

		return response($this->status);

	}

	public function resetPassword(Request $request, $token) {
		
		Session::forget('customerSess');

		//get admin user from the token

		$cond = [
    		['forgot_token', $token],
    	];

		$getCustomer = CustomerModel::where($cond)->first();
		
		if (!empty($getCustomer)) {
			
			//validate date
			$getForgotTokenValidity = $getCustomer->forgot_token_validity;
			$currentDate = date('Y-m-d');

			$proceedProcess = true;

			if ($getForgotTokenValidity != $currentDate) {
				$proceedProcess = false;
			}

			if ($proceedProcess) {

				$data = array(
					'token' => $token,
					'title' => 'Reset Password',
					'pageTitle' => 'Reset Password',
					'menu' => 'reset-password',
				);
				return view('frontend/resetPassword', $data);

			} else {

				$getCustomer->forgot_token = null;
				$getCustomer->forgot_token_validity = null;
				$getCustomer->save();
				return redirect(route('loginPage'));

			}

		} else {
			return redirect(route('loginPage'));
		}

	}

	public function doResetPassword(Request $request) {
		
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
	            'password' => 'required|min:8',
	            'confirmPass' => 'required|same:password',
	            'resetToken' => 'required',        
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

	        	$token = $request->post('resetToken');
	        	
	        	$cond = [
					['forgot_token', $token],
				];

	        	$getCustomer = CustomerModel::where($cond)->first();

	        	if (!empty($getCustomer)) {

	        		//validate date
					$getForgotTokenValidity = $getCustomer->forgot_token_validity;
					$currentDate = date('Y-m-d');

					$proceedProcess = true;

					if ($getForgotTokenValidity != $currentDate) {
						$proceedProcess = false;
					}

					if ($proceedProcess) {

						//check if user entering the same password as new password

						$newPassword = $request->post('password');

						if (Hash::check($newPassword, $getCustomer->password)) {
							
							$this->status = array(
								'error' => true,
								'eType' => 'final',
								'msg' => 'You cannot use your current password as new password.'
							);

							return response($this->status);

						}

						//change password
						$hashedNewPassword = Hash::make($newPassword);

						$getCustomer->password = $hashedNewPassword;
						$getCustomer->forgot_token = null;
						$getCustomer->forgot_token_validity = null;
						$getCustomer->save();

						$this->status = array(
							'error' => false,							
							'msg' => 'Your password has been reset successfully.',
							'redirect' => route('loginPage')
						);

					} else {

						$getCustomer->forgot_token = null;
						$getCustomer->forgot_token_validity = null;
						$getCustomer->save();
						
						$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'It appears that your token might be incorrect, or token might be expired. Please referesh the page and try again'
						);

					}

	        	} else {
	        		$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'It appears that your token might be incorrect, or your account could be inactive.'
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

		return response($this->status);

	}

	public function doChangePassword(Request $request) {
		
		if ($request->ajax()) {

			// echo "<pre>";
			// print_r($_POST);
			// die();

			$validator = Validator::make($request->post(), [
	            'password' => 'required|min:6',
	            'newPassword' => 'required|min:6',
	            'confirmPassword' => 'required|min:6|same:newPassword',
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

	        	$customerId = customerId();
	        	
	        	$cond = [
	        		['id', $customerId],
	        	];

	        	$getCustomer = CustomerModel::where($cond)->first();

	        	if (!empty($getCustomer)) {

	        		//check if password match
	        		if (Hash::check($request->post('password'), $getCustomer->password)) {

	        			$getCustomer->password = Hash::make($request->post('confirmPassword'));
		        		$isUpdated = $getCustomer->save();

		        		if ($isUpdated) {
		        			$this->status = array(
								'error' => false,
								'msg' => 'The password has been updated successfully.'
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
							'msg' => 'The password you provided is incorrect.'
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


		} else {
			$this->status = array(
				'error' => true,
				'eType' => 'final',
				'msg' => 'Something went wrong'
			);
		}

		return response($this->status);

	}

	public function doUpdateAccDetails(Request $request) {
		if ($request->ajax()) {

			// echo "<pre>";
			// print_r($_POST);
			// die();

			$id = customerId();


			$validator = Validator::make($request->post(), [
			    'name' => 'required',
			    'email' => 'required|email|unique:customer,email,'.$id,
			    'phone' => 'required|numeric|digits:10|unique:customer,phone,'.$id,
			    'address' => 'required',
			    'city' => 'required',
			    'state' => 'required',
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

	        	$obj = [
	        		'name' => $request->post('name'),
	        		'email' => $request->post('email'),
	        		'phone' => $request->post('phone'),
	        		'address' => $request->post('address'),
	        		'city' => $request->post('city'),
	        		'state' => $request->post('state'),
	        	];

	        	$isUpdated = CustomerModel::where(['id' => $id])->update($obj);

	        	if ($isUpdated) {

    				$this->status = array(
						'error' => false,								
						'msg' => 'Your account details has been updated sucessfully',
					);

    			} else {
    				$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'Something went wrong.'
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

		return response($this->status);
	}

	public function doSaveShippingAddress(Request $request) {

		if ($request->ajax()) {

			// echo "<pre>";
			// print_r($_POST);
			// die();

			$id = customerId();

			$obj1 = [
				'shippingName' => 'required',
				'shippingCompanyName' => 'sometimes|nullable',
				'shippingAddress' => 'required',
				'shippingCity' => 'required',
	            'shippingState' => 'required',
	            'shippingPincode' => 'required|numeric|digits:6',
	            'shippingEmail' => 'required|email',
	            'shippingPhone' => 'required|numeric',
	        ];


			$validator = Validator::make($request->post(), $obj1);

	        if ($validator->fails()) {
	            
	            $errors = $validator->errors()->getMessages();

	            $this->status = array(
					'error' => true,
					'eType' => 'field',
					'errors' => $errors,
					'msg' => 'Validation failed'
				);

	        } else {

	        	$userId = customerId();

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
		            'is_billing_same' => 1,
		        ];


		        $getShipAdd = CustomerAddressModel::where($obj)->count();

		        if ($getShipAdd) {

		        	$isUpdated = CustomerAddressModel::where(['user_id' => $userId])->update($obj);
		        	
		        }else{
		        	$isUpdated = CustomerAddressModel::create($obj);
		        }

	        	if ($isUpdated) {

    				$this->status = array(
						'error' => false,								
						'msg' => 'Your shipping address has been saved sucessfully',
					);

    			} else {
    				$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'Something went wrong.'
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

		return response($this->status);
	}

	public function doSaveBillingAddress(Request $request) {

		if ($request->ajax()) {

			$id = customerId();

			$obj1 = [
				'billingName' => 'required',
				'billingCompanyName' => 'sometimes|nullable',
				'billingAddress' => 'required',
				'billingCity' => 'required',
	            'billingState' => 'required',
	            'billingPincode' => 'required|numeric|digits:6',
	            'billingEmail' => 'required|email',
	            'billingPhone' => 'required|numeric',
	        ];


			$validator = Validator::make($request->post(), $obj1);

	        if ($validator->fails()) {
	            
	            $errors = $validator->errors()->getMessages();

	            $this->status = array(
					'error' => true,
					'eType' => 'field',
					'errors' => $errors,
					'msg' => 'Validation failed'
				);

	        } else {

	        	$userId = customerId();

	        	$obj = [
	    			'user_id' => $userId,
					'billing_name' => $request->post('billingName'),
					'billing_company_name' => $request->post('billingCompanyName'),
					'billing_address' => $request->post('billingAddress'),
					'billing_city' => $request->post('billingCity'),
		            'billing_state' => $request->post('billingState'),
		            'billing_pincode' => $request->post('billingPincode'),
		            'billing_email' => $request->post('billingEmail'),
		            'billing_phone' => $request->post('billingPhone'),
		            'is_billing_same' => 0,
		        ];


		        $getBillingAdd = CustomerAddressModel::where(['user_id' => $userId])->count();

		        if ($getBillingAdd) {

		        	$isUpdated = CustomerAddressModel::where(['user_id' => $userId])->update($obj);
		        	
		        }else{

		        	$obj['shipping_name'] = $request->post('billingName');
		        	$obj['shipping_company_name'] = $request->post('shippingCompanyName');
		        	$obj['shipping_address'] = $request->post('shippingAddress');
		        	$obj['shipping_city'] = $request->post('shippingCity');
		        	$obj['shipping_state'] = $request->post('shippingState');
		        	$obj['shipping_pincode'] = $request->post('shippingPincode');
		        	$obj['shipping_email'] = $request->post('shippingEmail');
		        	$obj['shipping_phone'] = $request->post('shippingPhone');

		        	$isUpdated = CustomerAddressModel::create($obj);
		        }

	        	if ($isUpdated) {

    				$this->status = array(
						'error' => false,								
						'msg' => 'Your billing address has been saved sucessfully',
					);

    			} else {
    				$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'Something went wrong.'
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

		return response($this->status);
	}



	
}