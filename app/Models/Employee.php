<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';


    protected $fillable = [
        'emp_id',
        'rank_id',
        'mobile',
        'name',
        'unit_id',
        'status',
        'company_id',
        'fp_key',
        'photo',
          
    ];

    protected $casts = [
        'fp_key' => 'binary'
    ];


    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    // Relationship with Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // Relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
     public function wpn_types()
    {
        return $this->belongsTo(WpnType::class, 'wpn_type');
    }
}
