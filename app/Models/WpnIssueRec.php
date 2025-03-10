<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnIssueRec extends Model
{
    use HasFactory;
    protected $table = 'wpn_issue_rec';

    protected $fillable = [
        'emp_id',
        'wpn_id',
        'nature',
        'purpose',
        'megazins',
        'slings',
        'bayonet',
        'return_date',
        'ramark',
        'updated_at',
        'created_at',
    ];

    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id');
    // }

    // public function wpn_types()
    // {
    //     return $this->belongsTo(WpnType::class, 'wpn_type');
    // }
}
