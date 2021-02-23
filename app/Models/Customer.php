<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'tbl_customer';
    protected $fillable = [
        'customer_name',
        'customer_last_name',
        'customer_address',
        'customer_region',
        'customer_mobile',
        'customer_city',
        'customer_state',
        'customer_pincode',
        'customer_contry',
        'persion1_name',
        'persion1_email',
        'persion1_mobile',
        'persion2_name',
        'branch_name',
    ];
}
