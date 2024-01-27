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

class Customer extends Controller {

	private $status = array();

	public function dashboard(Request $request) {

		$data = array(
			'title' => 'Dashboard',
			'pageTitle' => 'Dashboard',
			'menu' => 'dashboard',
		);

		return view('frontend/dashboard', $data);

	}

	public function logout() {
		// Session::forget('adminTwoFactorSess');
		Session::forget('customerSess');
		return redirect(route('loginPage'));
	}

	public function login(Request $request) {

		$data = array(
			'title' => 'Login',
			'pageTitle' => 'Login',
			'menu' => 'login',
		);

		$customerSess = Session::get('customerSess');
		
		if (empty($customerSess)) {

			return view('frontend/login', $data);;

		} else {
			return redirect(route('customerDashboard'));
		}

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

			// echo "<pre>";
			// print_r($_POST);
			// die();

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

		        			$this->status = array(
								'error' => false,
								'redirect' => route('customerDashboard')
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

	
}