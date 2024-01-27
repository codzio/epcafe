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

class Home extends Controller {

	private $status = array();

	public function index(Request $request) {

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

	public function about(Request $request) {

		$data = array(
			'title' => 'About Us',
			'pageTitle' => 'About Us',
			'menu' => 'about',
		);

		return view('frontend/about', $data);

	}

	public function contact(Request $request) {

		$data = array(
			'title' => 'Contact Us',
			'pageTitle' => 'Contact Us',
			'menu' => 'contact',
		);

		return view('frontend/contact', $data);

	}

	public function category(Request $request, $slug) {
		
		$isCategoryExist = CategoryModel::
		select('category.*', DB::raw('(SELECT COUNT(*) FROM product as b WHERE b.category_id = category.id) as totalProducts'))
		->where(['category.is_active' => 1, 'category.category_slug' => $slug])
		->first();

		if (!empty($isCategoryExist) && $isCategoryExist->count()) {

			$getProducts = ProductModel::where(['category_id' => $isCategoryExist->id, 'is_active' => 1])->get();
			
			$data = array(
				'title' => $isCategoryExist->category_name,
				'pageTitle' => $isCategoryExist->category_name,
				'menu' => 'category',
				'category' => $isCategoryExist,
				'products' => $getProducts
			);

			return view('frontend/category', $data);

		} else {
			return redirect()->to(route('homePage'));
		}
		
	}

	public function product(Request $request, $slug) {
		
		$isProdExist = ProductModel::
		where(['is_active' => 1, 'slug' => $slug])
		->first();

		if (!empty($isProdExist) && $isProdExist->count()) {

			$getRelProds = ProductModel::where(['is_active' => 1, 'category_id' => $isProdExist->category_id])->where('id', '!=', $isProdExist->id)->get();

			//Pricing
			$paperSize = PricingModel::
			join('paper_size', 'pricing.paper_size_id', '=', 'paper_size.id')
			->where('pricing.product_id', $isProdExist->id)
			->select('paper_size.*')
			->distinct('paper_size.id')
			->get();

			$covers = CoverModel::get();
			
			$data = array(
				'title' => $isProdExist->name,
				'pageTitle' => $isProdExist->name,
				'menu' => 'product',
				'product' => $isProdExist,
				'relProducts' => $getRelProds,
				'paperSize' => $paperSize,
				'covers' => $covers,
			);

			return view('frontend/product-detail', $data);

		} else {
			return redirect()->to(route('homePage'));
		}
		
	}

	public function getPricing(Request $request) {
		if ($request->ajax()) {

			$productId = $request->post('productId');
			$paperSize = $request->post('paperSize');
			$action = $request->post('action');

			if (!empty($action) && !empty($paperSize)) {
				
				if ($action == 'gsm') {
					
					$getGsm = PricingModel::
					join('gsm', 'pricing.paper_gsm_id', '=', 'gsm.id')
					->where(['pricing.product_id' => $productId, 'pricing.paper_size_id' => $paperSize])
					->select('gsm.*')
					->distinct('gsm.id')
					->get();

					$getBinding = BindingModel::where('paper_size_id', $paperSize)->get();
					$getLamination = LaminationModel::where('paper_size_id', $paperSize)->get();

					$gsmOptions = '<option value="">Select Paper GSM</option>';

					if (!empty($getGsm) && $getGsm->count()) {
						foreach ($getGsm as $gsm) {
							$gsmOptions .= '<option data-price="'.$gsm->rate.'" value="'.$gsm->id.'">'.$gsm->gsm.' GSM</option>';
						}
					}

					$bindingOptions = '<option value="">Select Binding</option>';

					if (!empty($getBinding) && $getBinding->count()) {
						foreach ($getBinding as $binding) {
							$bindingOptions .= '<option data-price="'.$binding->price.'" value="'.$binding->id.'">'.$binding->binding_name.'</option>';
						}
					}

					$laminationOptions = '<option value="">Select Lamination</option>';

					if (!empty($getLamination) && $getLamination->count()) {
						foreach ($getLamination as $lamination) {
							$laminationOptions .= '<option data-price="'.$lamination->price.'" value="'.$lamination->id.'">'.$lamination->lamination." - ".$lamination->lamination_type.'</option>';
						}
					}

					$this->status = array(
						'error' => false,
						'gsmOptions' => $gsmOptions,
						'bindingOptions' => $bindingOptions,
						'laminationOptions' => $laminationOptions,
					);

				} elseif ($action == 'paper_type') {
					
					$productId = $request->post('productId');
					$paperSize = $request->post('paperSize');
					$paperGsm = $request->post('paperGsm');

					$getPaperType = PricingModel::
					join('gsm', 'pricing.paper_type_id', '=', 'gsm.paper_type')
					->join('paper_type', 'gsm.paper_type', '=', 'paper_type.id')
					->where(['pricing.product_id' => $productId, 'pricing.paper_size_id' => $paperSize, 'pricing.paper_gsm_id' => $paperGsm])
					->select('pricing.paper_type_id', 'paper_type.paper_type', 'gsm.paper_type_price')
					->distinct('gsm.id')
					->get();

					$paperTypeOptions = '<option value="">Select Paper Type</option>';

					if (!empty($getPaperType) && $getPaperType->count()) {
						foreach ($getPaperType as $paperType) {
							$paperTypeOptions .= '<option data-price="'.$paperType->paper_type_price.'" value="'.$paperType->paper_type_id.'">'.$paperType->paper_type.'</option>';
						}
					}

					$this->status = array(
						'error' => false,
						'paperOptions' => $paperTypeOptions,
					);

				} elseif ($action == 'paper_sides') {
					
					$productId = $request->post('productId');
					$paperSize = $request->post('paperSize');
					$paperGsm = $request->post('paperGsm');
					$paperType = $request->post('paperType');

					$getPaperSides = PricingModel::
					where(['product_id' => $productId, 'paper_size_id' => $paperSize, 'paper_gsm_id' => $paperGsm, 'paper_type_id' => $paperType])
					->select('side', 'other_price')
					->distinct('side')
					->get();

					$paperSideOptions = '<option value="">Select Print Sides</option>';

					if (!empty($getPaperSides) && $getPaperSides->count()) {
						foreach ($getPaperSides as $paperSide) {
							$paperSideOptions .= '<option data-price="'.$paperSide->other_price.'" value="'.$paperSide->side.'">'.$paperSide->side.'</option>';
						}
					}

					$this->status = array(
						'error' => false,
						'paperSides' => $paperSideOptions,
					);

				} elseif ($action == 'paper_color') {
					
					$productId = $request->post('productId');
					$paperSize = $request->post('paperSize');
					$paperGsm = $request->post('paperGsm');
					$paperType = $request->post('paperType');
					$paperSides = $request->post('paperSides');

					$getPaperColor = PricingModel::
					where(['product_id' => $productId, 'paper_size_id' => $paperSize, 'paper_gsm_id' => $paperGsm, 'paper_type_id' => $paperType, 'side' => $paperSides])
					->select('color', 'other_price')
					->distinct('color')
					->get();

					$paperColorOptions = '<option value="">Select Color</option>';

					if (!empty($getPaperColor) && $getPaperColor->count()) {
						foreach ($getPaperColor as $color) {
							$paperColorOptions .= '<option data-price="'.$color->other_price.'" value="'.$color->color.'">'.$color->color.'</option>';
						}
					}

					$this->status = array(
						'error' => false,
						'paperColor' => $paperColorOptions,
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

	public function checkPincode(Request $request) {
		if ($request->ajax()) {

			$validator = Validator::make($request->post(), [
			    'pincode' => 'required|numeric|digits:6',
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

	        	$pincode = $request->post('pincode');

	        	//check if pincode exist for delivery
	        	$isExist = '';

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