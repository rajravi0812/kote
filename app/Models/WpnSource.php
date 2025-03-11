<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnSource extends Model
{
    use HasFactory;
    protected $table = 'wpn_source';

    protected $fillable = [
        'wpn_src_name',
    ];


}
