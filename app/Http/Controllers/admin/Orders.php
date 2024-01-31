<?php

namespace App\Http\Controllers\admin;

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

use App\Models\OrderModel;
use App\Models\AdminModel;
use App\Models\CustomerModel;


class Orders extends Controller {

	private $status = array();

	public function index(Request $request) {

		if (!can('read', 'orders')){
			return redirect(route('adminDashboard'));
		}

		$data = array(
			'title' => 'Orders',
			'pageTitle' => 'Orders',
			'menu' => 'order',
		);

		return view('admin/order/index', $data);

	}

	public function get(Request $request) {
		if ($request->ajax()) {

			$draw = $request->get('draw');

			if (!can('read', 'orders')){
				$response = array(
			        "draw" => intval($draw),
			        "iTotalRecords" => 0,
			        "iTotalDisplayRecords" => 0,
			        "aaData" => []
			    );

			    echo json_encode($response);
			    exit;
			}
			
		    $start = $request->get("start");
		    $rowperpage = $request->get("length"); // Rows display per page
		    $inputName = $request->get('field');

		    $singleDelUrl = route('adminDeleteOrders');

		    //get type
		    $columnIndex_arr = $request->get('orders');
		    $columnName_arr = $request->get('columns');
		    $order_arr = $request->get('orders');
		    $search_arr = $request->get('search');

		    $columnIndex = isset($columnIndex_arr[0]['column'])? $columnIndex_arr[0]['column']:''; // Column index
		    $columnName = !empty($columnIndex)? $columnName_arr[$columnIndex]['data']:''; // Column name
		    $columnSortOrder = !empty($order_arr)? $order_arr[0]['dir']:''; // asc or desc
		    $searchValue = $search_arr['value']; // Search value

		     // Total records
		    $totalRecords = OrderModel::join('customer', 'orders.user_id', '=', 'customer.id')->select('count(*) as allcount');
		    $totalRecords = $totalRecords->count();

		    $totalRecordswithFilter = OrderModel::join('customer', 'orders.user_id', '=', 'customer.id')->select('count(*) as allcount');

		    // if (!empty($searchValue)) {
		    // 	$totalRecordswithFilter->where('admins.name', 'like', '%' .$searchValue . '%');
		    // }

		    if (!empty($searchValue)) {
			    $totalRecordswithFilter->where(function ($query) use ($searchValue) {

			        $query->where('orders.order_id', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('customer.name', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('customer.phone', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.product_name', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.qty', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.paid_amount', 'like', '%' . $searchValue . '%');

			        // if (strtolower($searchValue) == 'active') {
			        // 	$query->orWhere('orders.is_active', 'like', '%1%');
			        // } elseif (strtolower($searchValue) == 'inactive') {
			        // 	$query->orWhere('orders.is_active', 'like', '%0%');
			        // }

			    });
			}

		    $totalRecordswithFilter = $totalRecordswithFilter->count();

		     // Fetch records
		    $records = OrderModel::join('customer', 'orders.user_id', '=', 'customer.id')->select('orders.*', 'customer.name','customer.phone')->skip($start)->take($rowperpage);

		    // if (!empty($searchValue)) {
		    // 	$records->where('admins.name', 'like', '%' .$searchValue . '%');
		    // }

		    if (!empty($searchValue)) {
			    $records->where(function ($query) use ($searchValue) {
			        $query->where('orders.order_id', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('customer.name', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('customer.phone', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.product_name', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.qty', 'like', '%' . $searchValue . '%')
			        	  ->orWhere('orders.paid_amount', 'like', '%' . $searchValue . '%');

			        // if (strtolower($searchValue) == 'active') {
			        // 	$query->orWhere('orders.is_active', 'like', '%1%');
			        // } elseif (strtolower($searchValue) == 'inactive') {
			        // 	$query->orWhere('orders.is_active', 'like', '%0%');
			        // }

			    });
			}

		    if (!empty($columnName) && !empty($columnSortOrder)) {
		    	$records->orderBy($columnName, $columnSortOrder);
		    } elseif (!empty($columnName)) {
		    	$records->orderBy($columnName, 'desc');	
		    } else {
		    	$records->orderBy('orders.id','desc');
		    }

		    $records = $records->get();

		    $data_arr = array();
		     
		    if (!empty($records)) {
		    	foreach($records as $record){
			        $id = $record->id;

			        $viewUrl = route('adminViewOrder', $id);

			        // $editUrl = route('adminEditShipping', $id);

			        $checkbox = '<div onclick="checkCheckbox(this)" class="form-check form-check-sm form-check-custom form-check-solid">
							<input name="delete[]" data-kt-check-target="#media .single-check-input" class="form-check-input" type="checkbox" value="'.$id.'" />
						</div>';

					$action = '
			          	<td class="text-end" data-kt-filemanager-table="action_dropdown">
						<div class="d-flex justify-content-end">
							<div class="ms-2">
								<div class="menu menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
									
									<div class="menu-item">
										<a title="ViewOrder" href="'.$viewUrl.'" class="menu-link px-3">
											<span class="menu-icon"><i class="ki-outline ki-eye fs-2"></i></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</td>';

					if ($record->is_active) {
						$status = '<div class="badge badge-success">Active</div>';
					} else {
						$status = '<div class="badge badge-danger">Inactive</div>';
					}


			        $data_arr[] = array(
			        	"checkbox" => $checkbox,
			          	"order_id" => strtoupper($record->order_id),
			          	"name" => $record->name,
			          	"phone" => $record->phone,
			          	"product_name" => $record->product_name,
			          	"qty" => $record->qty,
			          	"paid_amount" => $record->paid_amount,
			          	"action" => $action
			        );
			    }
		    }

		    $response = array(
		        "draw" => intval($draw),
		        "iTotalRecords" => $totalRecords,
		        "iTotalDisplayRecords" => $totalRecordswithFilter,
		        "aaData" => $data_arr
		    );

		    echo json_encode($response);
		    exit;

		} else {
			$this->status = array(
				'error' => true,
				'eType' => 'final',
				'msg' => 'Something went wrong'
			);
		}

		echo json_encode($this->status);
	}


	public function view(Request $request, $id) {

		if (!can('read', 'orders')){
			return redirect(route('adminDashboard'));
		}

		$orderData = OrderModel::where('id', $id)->first();

		if (!empty($orderData) && $orderData->count()){

			$userId = $orderData->user_id;
			$customerData = CustomerModel::where('id', $userId)->first();
			$priceDetail = json_decode($orderData->price_details);
			$transactionDetail = json_decode($orderData->transaction_details);
			$addressDetails = json_decode($orderData->customer_address);

			$data = array(
				'title' => 'Order Detail',
				'pageTitle' => 'Order Detail',
				'menu' => 'order',
				'order' => $orderData,
				'customer' => $customerData,
				'priceDetail' => $priceDetail,
				'transactionDetail' => $transactionDetail,
				'addressDetails' => $addressDetails
			);

			return view('admin/order/view', $data);
			
		} else {
			return redirect(route('adminOrders'));
		}

	}

}