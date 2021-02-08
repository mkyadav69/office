<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'tbl_custowner';
    protected $fillable = [
        'ownber_name',
        'owner_desciption',
        'dt_created',
        'dt_created',
        'dt_modify',
    ];
}
