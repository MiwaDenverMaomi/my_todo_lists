<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\User;
use App\Models\Like;
use App\Models\Bucket_list;


class Favorite extends Model
{
    use HasFactory;
    protected $fillable=['from_user','to_user'];

    //     public function favorites(){
    //     return $this->hasMany(Favorite::class,'from_user');
    // }
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','to_user');
    }
    public function user(){
        return $this->hasOne(User::class,'id');
    }

    public function bucket_lists(){
        return $this->hasMany(Bucket_list::class,'user_id','to_user');
    }

    public function likes(){
        return $this->hasMany(Like::class,'to_user');
    }

    public function is_liked_by_auth(){
        $likes=self::Likes();
        foreach($likes as $like){
            if($like['from_user']===3){
                return true;
            }else{
                return false;
            }
        }
    }
}
