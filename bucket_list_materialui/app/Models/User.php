<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Bucket_list;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
       return $this->hasOne(Profile::class,'user_id','id');
    }

    public function likes(){
        return $this->hasMany(Like::class,'to_user');
    }

    public function bucket_lists(){
        return $this->hasMany(Bucket_list::class,'user_id');
    }

    public function is_liked_by_auth(){
        $likes=self::likes()->get()->toArray();
        for($i=0;$i<count($likes);$i++){
            if($likes[$i]['from_user']===4){
                return true;
            }
        }
        return false;
    }
}
