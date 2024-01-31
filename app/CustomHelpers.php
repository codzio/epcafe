<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Request;

use App\Models\AdminModel;
use App\Models\MediaModel;
use App\Models\SettingModel;
use App\Models\CartModel;
use App\Models\PaperSizeModel;
use App\Models\GsmModel;
use App\Models\PaperTypeModel;
use App\Models\BindingModel;
use App\Models\LaminationModel;
use App\Models\CoverModel;
use App\Models\PricingModel;
use App\Models\CustomerModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

function getImg($imageId) {
	$mediaData = MediaModel::where('id', $imageId)->first();
	if (!empty($mediaData)) {
		return url('public/').'/'.$mediaData->path;
	} else {
		return '';
	}
}

// Project Related Function End

function adminInfo($col='') {
	
	$adminSess = Session::get('adminSess');

	if (!empty($adminSess)) {
		
		$getAdminDetail = AdminModel::select('admins.*', 'roles.role_name', 'roles.permissions', 'media.path', 'media.alt')
		->join('roles', 'admins.role_id', '=', 'roles.id')
		->leftJoin('media', 'admins.profile', '=', 'media.id')
		->where('admins.id', $adminSess['adminId'])
		->first();

		if ($adminSess) {
			if (!empty($col)) {
				return $getAdminDetail->{$col};
			} else {
				return $getAdminDetail;
			}
		}

	} else {
		return false;
	}
	
}

function adminId() {
	$adminSess = Session::get('adminSess');
	return $adminSess['adminId'];
}

function userInfo($col='') {
	
	$userSess = Session::get('userSess');

	if (!empty($userSess)) {
		
		$getUserDetail = UserModel::select('users.*', 'media.path', 'media.alt', 'badges.badge_img')
		->leftJoin('media', 'users.profile_picture', '=', 'media.id')
		->leftJoin('badges', 'users.badge_id', '=', 'badges.id')
		->where('users.id', $userSess['userId'])
		->first();

		if ($userSess) {
			if (!empty($col)) {
				return $getUserDetail->{$col};
			} else {
				return $getUserDetail;
			}
		}

	} else {
		return false;
	}
	
}

function userInfoById($id) {
	
	return UserModel::select('users.*', 'media.path', 'media.alt')
	->leftJoin('media', 'users.profile_picture', '=', 'media.id')
	->where('users.id', $id)
	->first();
}

function checkPermission($module, $permission) {
	$getAdminData = adminInfo();

	//super admin role id is 1
	if ($getAdminData->role_id == 1) {
		
		return true;

	} else {

		$getPermission = $getAdminData->permissions;

		if (!empty($getPermission)) {
			
			$getPermission = json_decode($getPermission);

			if (isset($getPermission->{$module}->{$permission}) && $getPermission->{$module}->{$permission}) {
				return true;
			}

			return false;

		} else {
			return false;
		}

	}
}

if (!function_exists('validateSlug')) {
	function validateSlug($tbl, $col, $slug, $id=null) {

		if (empty($id)) {
			$isSlugExist = DB::table($tbl)->where($col, 'like', $slug.'%')->select($col);
		} else {
			$isSlugExist = DB::table($tbl)->where($col, 'like', $slug.'%')->where('id', '!=', $id)->select($col);
		}

		$totalRow = $isSlugExist->count();
		$result = $isSlugExist->get();

		$data = array();

		if ($totalRow) {
			foreach ($result as $row) {
				$data[] = $row->{$col};
			}
		}

		if(in_array($slug, $data)) {
	    	$count = 0;
	    	while( in_array( ($slug . '-' . ++$count ), $data) );
	    	$slug = $slug . '-' . $count;
	   	}

	   	return $slug;
	}
}

if (!function_exists('validateMediaSlug')) {
	function validateMediaSlug($tbl, $col, $slug, $id=null) {

		if (empty($id)) {
			$isSlugExist = DB::table($tbl)
			->where($col, 'like', $slug.'%')
			->where('year', '=', date('Y'))
			->where('month', '=', date('m'))
			->where('date', '=', date('d'))
			->select($col);
		} else {
			$isSlugExist = DB::table($tbl)
			->where($col, 'like', $slug.'%')
			->where('year', '=', date('Y'))
			->where('month', '=', date('m'))
			->where('date', '=', date('d'))
			->where('id', '!=', $id)
			->select($col);
		}

		$totalRow = $isSlugExist->count();
		$result = $isSlugExist->get();

		$data = array();

		if ($totalRow) {
			foreach ($result as $row) {
				$data[] = $row->{$col};
			}
		}

		if(in_array($slug, $data)) {
	    	$count = 0;
	    	while( in_array( ($slug . '-' . ++$count ), $data) );
	    	$slug = $slug . '-' . $count;
	   	}

	   	return $slug;
	}
}

function formatSize($bytes){ 
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;

	if (($bytes >= 0) && ($bytes < $kb)) {
		return $bytes . ' B';
	} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . ' KB';
	} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . ' MB';
	} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . ' GB';
	} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . ' TB';
	} else {
		return $bytes . ' B';
	}
}

function folderSize($dir){
	$total_size = 0;
	$count = 0;
	$dir_array = scandir($dir);
  	foreach($dir_array as $key=>$filename){
    	if($filename!=".." && $filename!="."){
       		if(is_dir($dir."/".$filename)){
          		$new_foldersize = foldersize($dir."/".$filename);
          		$total_size = $total_size+ $new_foldersize;
	        }else if(is_file($dir."/".$filename)){
	          	$total_size = $total_size + filesize($dir."/".$filename);
	         	$count++;
	        }
   		}
   	}
	return $total_size;
}

function setting($field) {
	$setting = new SettingModel();
	$data = $setting->getSetting($field);
	
	if (isset($data)) {
		return $data;
	}

	return false;
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "https://" . $url;
    }
    return $url;
}

function can($permission, $module) {
	if (!empty($permission) && !empty($module)) {
		
		$adminData = adminInfo();

		if (!empty($adminData)) {
			
			if ($adminData->role_id == 1) {
				return true;
			}

			if (!empty($adminData->permissions)) {
				
				$getPermission = json_decode($adminData->permissions);

				if (isset($getPermission->{$module}->{$permission})) {
					return true;
				} else {
					return false;				
				}

			}

			return false;

		} else {
			return false;
		}

	} else {
		return false;
	}
}


//Customer

function customerId() {
	$customerSess = Session::get('customerSess');
	if (isset($customerSess['customerId']) && !empty($customerSess['customerId'])) {
		return $customerSess['customerId'];
	} else {
		return null;
	}
}

function cartData() {
	$tempId = Request::cookie('tempUserId');
	$userId = customerId();

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
		return $getCartData;
	} else {
		return false;
	}

}

function getCartId() {
	$tempId = Request::cookie('tempUserId');
	$userId = customerId();

	$cond = ['product.is_active' => 1];
	if (!empty($userId)) {
		$cond['cart.user_id'] = $userId;
	} else {
		$cond['cart.temp_id'] = $tempId;
	}

	return CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->value('cart.id');
}

function getCartProductId() {
	$tempId = Request::cookie('tempUserId');
	$userId = customerId();

	$cond = ['product.is_active' => 1];
	if (!empty($userId)) {
		$cond['cart.user_id'] = $userId;
	} else {
		$cond['cart.temp_id'] = $tempId;
	}

	return CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->value('cart.product_id');
}

function productSpec($cartId) {
	
	$cartData = CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where(['cart.id' => $cartId, 'product.is_active' => 1])
		->select('cart.*', 'product.name', 'product.thumbnail_id')
		->first();

	if (!empty($cartData)) {
			
		$productId = $cartData->product_id;
		$paperSizeId = $cartData->paper_size_id;
		$paperGsmId = $cartData->paper_gsm_id;
		$paperTypeId = $cartData->paper_type_id;
		$printSide = $cartData->print_side;
		$color = $cartData->color;
		$bindingId = $cartData->binding_id;
		$laminationId = $cartData->lamination_id;
		$coverId = $cartData->cover_id;

		$spec = '';

		//Get Paper Size
		$getPaperSize = PaperSizeModel::where('id', $paperSizeId)->value('size');

		if (!empty($getPaperSize)) {
			$spec .= "<p><strong>Paper Size:</strong> ".$getPaperSize."</p>";
		}

		//Get Paper Gsm
		$getPaperGsm = GsmModel::where('id', $paperGsmId)->value('gsm');

		if (!empty($getPaperGsm)) {
			$spec .= "<p><strong>Paper GSM:</strong> ".$getPaperGsm."</p>";
		}

		//Get Paper Type
		$getPaperType = PaperTypeModel::where('id', $paperTypeId)->value('paper_type');

		if (!empty($getPaperType)) {
			$spec .= "<p><strong>Paper Type:</strong> ".$getPaperType."</p>";
		}

		//Get Print Side
		$spec .= "<p><strong>Print Side:</strong> ".$cartData->print_side."</p>";

		//Get Color
		$spec .= "<p><strong>Color:</strong> ".$cartData->color."</p>";

		//Get Binding
		$getBinding = BindingModel::where('id', $bindingId)->value('binding_name');

		if (!empty($getBinding)) {
			$spec .= "<p><strong>Binding:</strong> ".$getBinding."</p>";
		}

		//Get Lamination
		$getLamination = LaminationModel::where('id', $laminationId)->first();

		if (!empty($getLamination)) {
			$spec .= "<p><strong>Lamination:</strong> ".$getLamination->lamination.' - '.$getLamination->lamination_type."</p>";
		}

		//Get Cover
		$getCover = CoverModel::where('id', $coverId)->value('cover');

		if (!empty($getCover)) {
			$spec .= "<p><strong>Cover:</strong> ".$getCover."</p>";
		}

		return $spec;

	} else {
		return false;
	}
}

function productPrice() {

	$tempId = Request::cookie('tempUserId');
	$userId = customerId();

	$cond = ['product.is_active' => 1];
	if (!empty($userId)) {
		$cond['cart.user_id'] = $userId;
	} else {
		$cond['cart.temp_id'] = $tempId;
	}

	$cartData = CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->select('cart.*', 'product.name', 'product.thumbnail_id')
		->first();

	if (!empty($cartData)) {
			
		$productId = $cartData->product_id;
		$paperSizeId = $cartData->paper_size_id;
		$paperGsmId = $cartData->paper_gsm_id;
		$paperTypeId = $cartData->paper_type_id;
		$printSide = $cartData->print_side;
		$color = $cartData->color;
		$bindingId = $cartData->binding_id;
		$laminationId = $cartData->lamination_id;
		$coverId = $cartData->cover_id;

		$data = [
			'per_sheet_weight' => 0,
			'paper_type_price' => 0,
			'printSideAndColorPrice' => 0,
			'binding' => 0,
			'lamination' => 0,
			'cover' => 0,
			'price' => 0,
			'shipping' => 0,
			'discount' => 0,
			'total' => 0
		];

		$getPaperGsm = GsmModel::where(['paper_size' => $paperSizeId, 'id' => $paperGsmId, 'paper_type' => $paperTypeId])->first();

		if (!empty($getPaperGsm)) {
			$data['per_sheet_weight'] = $getPaperGsm->per_sheet_weight;
			$data['paper_type_price'] = $getPaperGsm->paper_type_price;
		}

		$printSideAndColorPrice = PricingModel::where(['product_id' => $productId, 'paper_size_id' => $paperSizeId, 'paper_gsm_id' => $paperGsmId, 'paper_type_id' => $paperTypeId, 'side' => $printSide, 'color' => $color])->value('other_price');

		if (!empty($printSideAndColorPrice)) {
			$data['printSideAndColorPrice'] = $printSideAndColorPrice;
		}

		if (!empty($bindingId)) {
			
			$bindingData = BindingModel::where('id', $bindingId)->value('price');

			if (!empty($bindingData)) {
				$data['binding'] = $bindingData;
			}

		}

		if (!empty($laminationId)) {
			
			$laminationData = LaminationModel::where('id', $laminationId)->value('price');

			if (!empty($laminationData)) {
				$data['lamination'] = $laminationData;
			}

		}

		// $data['price'] = $data['per_sheet_weight']+$data['paper_type_price']+$data['printSideAndColorPrice']+$data['binding']+$data['lamination']+$data['cover'];

		$data['price'] = $data['paper_type_price']+$data['printSideAndColorPrice']+$data['binding']+$data['lamination']+$data['cover'];

		$getCouponData = Session::get('couponSess');

		$discount = 0;

		if (!empty($getCouponData)) {
			$discount = $getCouponData['discount'];
		}

		//Shipping
		$shipping = 0;
		$getShippingData = Session::get('shippingSess');

		if (!empty($getShippingData)) {
			$shipping = $getShippingData['shipping'];
		}

		$data['discount'] = $discount;
		$data['shipping'] = $shipping;
		$data['total'] = (($data['price']*$cartData->qty)-$discount)+$shipping;

		return (object) $data;

	} else {
		return false;
	}

}

function cartWeight() {

	$tempId = Request::cookie('tempUserId');
	$userId = customerId();

	$cond = ['product.is_active' => 1];
	if (!empty($userId)) {
		$cond['cart.user_id'] = $userId;
	} else {
		$cond['cart.temp_id'] = $tempId;
	}

	$cartData = CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->select('cart.*', 'product.name', 'product.thumbnail_id')
		->first();

	if (!empty($cartData)) {
			
		$productId = $cartData->product_id;
		$paperSizeId = $cartData->paper_size_id; 
		$paperGsmId = $cartData->paper_gsm_id; //weight
		$paperTypeId = $cartData->paper_type_id;
		$printSide = $cartData->print_side;
		$color = $cartData->color;
		$bindingId = $cartData->binding_id;
		$laminationId = $cartData->lamination_id;
		$coverId = $cartData->cover_id;

		$weight = 0;

		//Get GSM Data
		$getWeight = GsmModel::where(['paper_size' => $paperSizeId, 'id' => $paperGsmId])->value('per_sheet_weight');

		$weight = $getWeight;
		$totalWeight = $weight*$cartData->qty;

		return $totalWeight;

	} else {
		return false;
	}

}

function updateUserIdInCart() {

	$tempId = Request::cookie('tempUserId');

	$cond = ['product.is_active' => 1];
	$cond['cart.temp_id'] = $tempId;

	$cartData = CartModel::join('product', 'cart.product_id', '=', 'product.id')
		->where($cond)
		->count();

	if ($cartData) {
		$userId = customerId();
		CartModel::where('temp_id', $tempId)->update(['user_id' => $userId]);
	}

	return $cartData;
}

function customerData($col='') {
	$customerSess = Session::get('customerSess');

	if (!empty($customerSess)) {

		$customerId = $customerSess['customerId'];
		
		$getCusDetail = CustomerModel::where('id', $customerId)->first();

		if (!empty($getCusDetail) && $getCusDetail->count()) {
			if (!empty($col)) {
				return $getCusDetail->{$col};
			} else {
				return $getCusDetail;
			}
		} else {
			return false;
		}

	} else {
		return false;
	}
}

function isPaymentInit() {
	$isPaymentInit = Session::get('paymentSess');

	if (!empty($isPaymentInit)) {
		return true;
	} else {
		return false;
	}
}

//Product Related

function getProductCatList() {
	return CategoryModel::where('is_active', 1)->get();
}

function getProductList($catId) {
	return ProductModel::where(['is_active' => 1, 'category_id' => $catId])->get();
}