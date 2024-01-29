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

class Checkout extends Controller {

	private $status = array();

	public function index(Request $request) {

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

}