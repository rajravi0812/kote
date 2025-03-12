<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ammunition extends Model
{
    use HasFactory;
    protected $table = 'ammunition';
    protected $fillable = ['amn_name', 'qty'];

    // public function wpnTypes()
    // {
    //     return $this->belongsToMany(WpnType::class, 'wpn_type_amn', 'amn_id', 'wpn_type_id');
    // }
}
