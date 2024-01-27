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

class Cart extends Controller {

	private $status = array();

	public function index(Request $request) {

		echo "Show Cart Data";
		die();

		$categoryList = CategoryModel::
		select('category.*', DB::raw('(SELECT COUNT(*) FROM product as b WHERE b.category_id = category.id) as totalProducts'))
		->where('category.is_active', 1)
		->get();

		$popularProds = ProductModel::where(['is_active' => 1, 'display_on_home' => 1])->get();

		$data = array(
			'title' => 'Home',
			'pageTitle' => 'Home',
			'menu' => 'home',
			'categoryList' => $categoryList,
			'popularProds' => $popularProds,
		);

		return view('frontend/home', $data);

	}

	public function doAddToCart(Request $request) {
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
			    'productId' => 'required|numeric',
			    'paperSize' => 'required|numeric',
			    'paperGsm' => 'required|numeric',
			    'paperType' => 'required|numeric',
			    'paperSides' => 'required',
			    'color' => 'required',
			    'binding' => 'sometimes|nullable|numeric',
			    'lamination' => 'sometimes|nullable|numeric',
			    'cover' => 'sometimes|nullable|numeric',
			    'noOfCopies' => 'required|numeric',
			    'documentLink' => 'required|url:http,https',
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

	        	$productId = $request->post('productId');
	        	$paperSize = $request->post('paperSize');
	        	$paperGsm = $request->post('paperGsm');
	        	$paperType = $request->post('paperType');
	        	$paperSides = $request->post('paperSides');
	        	$color = $request->post('color');
	        	$binding = $request->post('binding');
	        	$lamination = $request->post('lamination');
	        	$cover = $request->post('cover');
	        	$noOfCopies = $request->post('noOfCopies');
	        	$documentLink = $request->post('documentLink');

	        	//check if product exist for delivery
	        	$isProductExist = ProductModel::where(['id' => $productId, 'is_active' => 1])->first();

	        	if (!empty($isProductExist) && $isProductExist->count()) {
	        	
	        		$pricingObj = [
	        			'product_id' => $productId,
	        			'paper_size_id' => $paperSize,
	        			'paper_gsm_id' => $paperGsm,
	        			'paper_type_id' => $paperType,
	        			'side' => $paperSides,
	        			'color' => $color,
	        		];

	        		//check if pricing exist
	        		$isPricingExist = PricingModel::where($pricingObj)->first();

	        		if (!empty($isPricingExist) && $isPricingExist->count()) {

	        			$isBindingExist = true;
	        			$isLaminationExist = true;
	        			$isCoverExist = true;

	        			//Check Binding
	        			if (!empty($binding)) {
	        				
	        				$getBindingData = BindingModel::where('id', $binding)->count();

	        				if (!$getBindingData) {
	        					$isBindingExist = false;
	        				}

	        			}

	        			//check Lamination
	        			if (!empty($lamination)) {
	        				
	        				$getLaminationData = LaminationModel::where('id', $lamination)->count();

	        				if (!$getLaminationData) {
	        					$isLaminationExist = false;
	        				}

	        			}

	        			//check Cover
	        			if (!empty($cover)) {
	        				
	        				$getCoverData = CoverModel::where('id', $cover)->count();

	        				if (!$getCoverData) {
	        					$isCoverExist = false;
	        				}

	        			}

	        			if ($isBindingExist && $isLaminationExist && $isCoverExist) {

	        				$tempId = $request->cookie('tempUserId');

	        				$cartObj = [
	        					'temp_id' => $tempId,
	        					// 'user_id' => userId(),
	        					'product_id' => $productId,
	        					'paper_size_id' => $paperSize,
	        					'paper_gsm_id' => $paperGsm,
	        					'paper_type_id' => $paperType,
	        					'print_side' => $paperSides,
	        					'color' => $color,
	        					'binding_id' => $binding,
	        					'lamination_id' => $lamination,
	        					'cover_id' => $cover,
	        					'qty' => $noOfCopies,
	        					'document_link' => $documentLink,
	        				];

	        				CartModel::where('temp_id', $tempId)->delete();
	        				$isAdded = CartModel::create($cartObj);

	        				if ($isAdded) {
	        					$this->status = array(
									'error' => false,
									'msg' => 'The product has been added into the cart.'
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
								'msg' => 'The product pricing is not available.'
							);
	        			}


	        		} else {
	        			$this->status = array(
							'error' => true,
							'eType' => 'final',
							'msg' => 'The product pricing is not available.'
						);
	        		}

	        	} else {
	        		$this->status = array(
						'error' => true,
						'eType' => 'final',
						'msg' => 'The product is not available.'
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