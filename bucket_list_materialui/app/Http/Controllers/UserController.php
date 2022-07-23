<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Validator;

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

	public function editProfile(Request $request,User $user){
	   \Log::info('user/editProfile');

	   $validator=Validator::make($request->all(),[
		"photo"=>"string|max:255",
		"name"=>"string|max:255",
		"question_1"=>"string |max:500",
		"question_2"=>"string |max:500",
		"question_3"=>"string |max:500",
	   ],[
		"photo.string"=>"Upload jpg or png file.",
		"photo.max"=>"Upload the photo within XXX bytes.",
		"name.string"=>"Data type for name is not valid. ",
		"name.max"=>"Input name within 255 letters. ",
		"question_1.string"=>"Data type for answers are not valid. ",
		"question_2.string"=>"Data type for answers are not valid. ",
		"question_3.string"=>"Data type for answers are not valid. ",
		"question_1.max"=>"Input each answer within 500 letters. ",
		"question_2.max"=>"Input each answer within 500 letters. ",
		"question_3.max"=>"Input each answer within 500 letters. ",
	   ]);
	   if($validator->fails()){
		return back()
		->withErrors($validator)
		->withInput();

	   }else{
         $photo=!empty($request->photo)?$request->photho:'./image/no_image.jpg';
	     $name=!empty($request->name)?$request->name:'No name';
	     $question_1=!empty($request->question_1)?$request->question_1:'No comment';
	     $question_2=!empty($request->question_2)?$request->question_2:'No comment';
	     $question_3=!empty($request->question_3)?$request->question_3:'No comment';

         $result=Profile::find($user->id)->fill([
		  'photo'=>$photo,
		  'question_1'=>$question_1,
		  'question_2'=>$question_2,
		  'question_3'=>$question_3,
	     ])->save();

	    if($result===true){
         return redirect()->route('user.showProfile',['user'=>$user->id]);

		}else{
		  return back()
		  ->with(['error_edit_profile'=>'Failed to save data. Please try again.']);
	   }
	  }
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
