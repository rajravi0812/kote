<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnAllot extends Model
{
    use HasFactory;
    protected $table = 'wpn_allot';

    protected $fillable = [
        'emp_id',
        'wpn_id',
        'assign_type',
        'created_at',
        'updated_at'
    ];

    public function wpns_list(){
        return $this->belongsTo(WpnList::class, 'wpn_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'emp_id');
    }

}
