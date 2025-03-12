<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpnTypeAmmunition extends Model
{
    use HasFactory;
    protected $table = 'wpn_type_amn';
    protected $fillable = ['amn_id', 'wpn_type_id'];

    public function wpn_name()
    {
        return $this->belongsTo(WpnType::class, 'wpn_type_id');
    }
}
