<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bucket_list extends Model
{
    use HasFactory;
    protected $fillable=['user_id','bucket_list_item','is_done'];
    protected $casts=[
        'is_done'=>'boolean'
    ];
    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}
