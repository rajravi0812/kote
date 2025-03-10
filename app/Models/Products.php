<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_qty',
        'issued_qty',
        'having_serial',
        'serial_no',
        'product_cat_id',
        'product_img',
        'fund_sub_cat_id',
        'fund_sub_id',
        'crv_no',
        'crv_date', 
        'ledger_no',
        'ledger_page_no',
        'issue_voucher_no',
        'issue_voucher_date',
        'bill_no',
        'bill_date',
        'warranty_yr',
        'warranty_exp_date',
        'amc_due_date',
        'price',
        'annual_dep',
        'current_price',
        'scan_barcode',
        'remarks',
        'created_at',
        'updated_at', 
    ];


}
