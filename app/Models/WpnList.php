<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnList extends Model
{
    use HasFactory;
    protected $table = 'wpn_list';

    protected $fillable = [
        'wpn_tag',
        'wpn_type',
        'regd_no',
        'butt_no',
        'company_id',
        'remarks',
        'emp_id',
        'status',
        'servicability',
        // 'asgn_type',
        'updated_at',
        'created_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function wpn_types()
    {
        return $this->belongsTo(WpnType::class, 'wpn_type');
    }
}
