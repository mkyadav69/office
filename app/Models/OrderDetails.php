<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{   
    protected $table = 'tbl_order_details';
    public $timestamps = false;
    use HasFactory;
}
