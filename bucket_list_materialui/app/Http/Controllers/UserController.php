<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function index(User $user){
        \Log::info('user/index');
        $user_data=User::with(['profile','likes','bucket_lists'])->select('id','name','email')->find($user->id)->toArray();
        \Log::debug($user);
        $is_liked_by_auth=$user->is_liked_by_auth();
        $user_data['countLikes']=count($user_data['likes']);
        $user_data['is_liked_by_auth']=$is_liked_by_auth;
        \Log::debug($user_data);
       return  view('list_user')->with(['user_data'=>$user_data]);
    }
    public function showProfile(User $user){
        \Log::info('showProfile');
        $user_data=User::with(['profile','likes'])->select('id','name','email')->find($user->id)->toArray();
        \Log::debug($user);
        $is_liked_by_auth=$user->is_liked_by_auth();
        $user_data['countLikes']=count($user_data['likes']);
        $user_data['is_liked_by_auth']=$is_liked_by_auth;
        \Log::debug($user_data);
      return view('my_profile')->with(['user_data'=>$user_data]);
    }

    public function editProfile(UserRequest $userRequest,User $user){
       \Log::info('user/editProfile');
       $user->name=$userRequest->name->save();
       $profile=Profile::find($user->id);
       $result=$profile->fill(['photo'=>$userRequest->photo,'question_1'=>$userRequest->question_1,'question_2'=>$userRequest->question_2,'question_3'=>$userRequest->question_3])->save();
       $result?response()->json($user,$profile):response()->json([],500);
       return view('my_profile')->with(['edit_mode'=>false]);
    }

    public function resetPassword(passwordRequest $passwordRequest,User $user){
        \Log::info('user/resetPassword');

        $user->password=\Hash::make($passwordRequest->password);
        $result=$user->save();
        $result===true?response()->json($result,201):response()->json([],500);
    }

    public function storeFarovite(FavoriteRequest $favoriteRequest){
        \Log::info('user/storeFavorite');
        $favoriteRequest->merge([
            'from_user'=>$favoriteRequest->Auth::id()
        ]);
        $favorite=Favorite::create($favoriteRequest->all());
        $favorite?response()->json($favorite,201):json([],500);
    }

    public function deleteFavorite(FavoriteRequest $favoriteRequest,Favorite $favorite){
        \Log::info('user/deleteFavorite');
        $result=$favorite->delete();
        $result===true?response()->json($favorite,201):response()->json([],500);
    }

    public function storeLike(LikeRequest $likeRequest){
        \Log::info('user/storeLike');
        $likeRequest->merge([
            'from_user'=>Auth::id()
        ]);
        $like=Like::create($likeRequest->all());
        $like?response()->json($favofite,201):json([],500);
    }

    public function deleteLike(LikeRequest $likeRequest,Like $like){
        \Log::info('user/deleteLike');
        $result=$like->delete();
        $result===true?response()->json($result,201):response()->json([],500);
    }

}
