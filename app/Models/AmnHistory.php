<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmnHistory extends Model
{
    use HasFactory;
    protected $table = 'amn_history';
    protected $fillable = ['amn_id', 'added_qty'];

    
}
