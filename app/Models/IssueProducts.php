<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueProducts extends Model
{
    use HasFactory;
    protected $table = 'issued_products';

    protected $fillable = [
        'product_id',
        'issued_qty',
        'serial_no',
        'issued_to',
        'branch_store_id'         
    ];

}
