<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmnIssueRec extends Model
{
    use HasFactory;
    protected $table = 'amn_issue_rec';
    protected $fillable = ['issue_id','amn_id','issued_qty','return_live','return_empty','return_lost','status'];

    
}
