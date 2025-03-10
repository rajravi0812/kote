<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnType extends Model
{
    use HasFactory;
    protected $table = 'wpn_types';

    protected $fillable = [
        'type',
        'qty',
    ];


}
