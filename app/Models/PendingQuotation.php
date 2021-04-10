<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingQuotation extends Model
{
    protected $table = 'tbl_pending';
    public $timestamps = false;
    use HasFactory;
}
