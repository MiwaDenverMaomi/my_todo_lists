<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function index(User $user){
        \Log::info('user/index');
        $user=User::with(['profile','likes'])->find($user->id)->get()->toArray();
        $user['countLikes']=count($user['likes']);
       return  $user?response()->json($user,201):response()->json([],500);
    }

    public function editProfile(UserRequest $userRequest,User $user){
       \Log::info('user/editProfile');
       $user->name=$userRequest->name->save();
       $profile=Profile::find($user->id);
       $result=$profile->fill(['photo'=>$userRequest->photo,'question_1'=>$userRequest->question_1,'question_2'=>$userRequest->question_2,'question_3'=>$userRequest->question_3])->save();
       $result?response()->json($user,$profile):response()->json([],500);
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
