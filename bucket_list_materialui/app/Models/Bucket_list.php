<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bucket_list extends Model
{
    use HasFactory;
    protected $fillable=['author_id','bucket_list_item','is_done'];

    public function user(){
        return $this->belongsTo(User::class,'id','author_id');
    }
}
