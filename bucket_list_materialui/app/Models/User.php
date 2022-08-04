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
use App\Models\Favorite;
use App\Models\Bucket_list;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

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

	// protected $appends=[
	// 	'count_like','liked_by_auth'
	// ];

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

	use SoftDeletes;
	protected $dates=['deleted_at'];//carbon instance

	public function profile(){
	   return $this->hasOne(Profile::class,'user_id','id');
	}

	public function likes(){
		return $this->hasMany(Like::class,'to_user');
	}

	public function bucket_lists(){
		return $this->hasMany(Bucket_list::class,'user_id');
	}


	public function is_liked_by_auth($target_id){
		\Log::info('User model is_liked_by_auth');
		$likes=User::find($target_id)->likes()->get()->toArray();
		\Log::debug($likes);

		$result=false;
		for($i=0;$i<count($likes);$i++){
			\Log::debug($likes[$i]);
			if($likes[$i]['from_user']===6){
				\Log::info('matched');
				$result=true;
			}
		}
		return $result;
	}

	public function favorites(){
		return $this->hasMany(Favorite::class,'from_user');
	}

	public function is_favorite_by_auth(){
		$favorites=self::favorites()->get()->toArray();
		for($i=0;$i<count($favorites);$i++){
			if($favorites[$i]['from_user']===Auth::id()){
				return true;
			}
			return false;
		}
	}
	// public function pic_thum(){
	//     $fnamebase=\Config::get('fpath.thum').$this->id."/"."thum";
	//     if(file_exists(public_path().$fnamebase."jpg")){
	//         return $fnamebase."jpg";
	//     }elseif(file_exists(public_path().$fnamebase."jpeg")){
	//         return $fnamebase."jpeg";
	//     }elseif(file_exists(public_path()).$fnamebase."png"){
	//         return $fnamebase."png";
	//     }else{
	//         return \Config::get('fpath.noimage');
	//     }
	// }

	// public function getCountLikesAttribute(){
	// 	return $this->likes->count();
	// }

	// public function getLikedByAuthAttribute(){
	// 	if(Auth::guest()){
	// 		return false;
	// 	}

	// 	return $this->likes->contains(function($user){
  //       return $user->id===Auth::id();
	// 	});
	// }
}
