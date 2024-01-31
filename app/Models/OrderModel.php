<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    
    protected $table = 'orders';
    protected $fillable = ['order_id', 'user_id', 'product_id', 'product_name', 'product_details', 'weight_details', 'coupon_code', 'discount', 'shipping', 'paid_amount', 'price_details', 'transaction_details', 'customer_address', 'document_link', 'qty'];
    protected $guarded = ['id'];

}