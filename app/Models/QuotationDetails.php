<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetails extends Model
{   
    protected $table = 'quotation_details';
    public $timestamps = false;
    use HasFactory;
}
