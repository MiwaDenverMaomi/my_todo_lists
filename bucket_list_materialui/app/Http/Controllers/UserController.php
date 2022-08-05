<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Profile;
use App\Models\Favorite;
use Validator;
use Auth;
use App\Models\Bucket_list;
use Illuminate\Http\Exceptions\HttpResponseException;

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

	public function editProfileMode(User $user,Request $request){
	  \Log::info('editProfileMode');
	  \Log::debug($request->edit_mode);
	   $edit_mode=((bool) $request->edit_mode)===true?true:false;

	   return redirect()->route('user.showProfile',[
		'user'=>$user->id,
		'edit_mode'=>$edit_mode]);
	}

	public function showProfile(User $user,Request $request){
		\Log::info('showProfile');
		$edit_mode=((bool) $request->edit_mode)===true?true:false;
		$user_data=User::with(['profile','likes'])->select('id','name','email')->find($user->id)->toArray();
		\Log::debug($user);
		$is_liked_by_auth=$user->is_liked_by_auth($user->id);
		$user_data['countLikes']=count($user_data['likes']);
		$user_data['is_liked_by_auth']=$is_liked_by_auth;
		\Log::debug($user_data);
	  return view('my_profile')->with([
		'user_data'=>$user_data,
		'edit_mode'=>$edit_mode]);
	}


	public function editProfile(Request $request,User $user){
	   \Log::info('user/editProfile');

	   $validator=Validator::make($request->all(),[
		"photo"=>'image|mimes:jpeg,png,jpg|max:5120|dimensions:max_width=300',
		"name"=>"string|max:255",
		"question_1"=>"string |max:500",
		"question_2"=>"string |max:500",
		"question_3"=>"string |max:500",
	   ],[
		"photo.image"=>"Upload jpg or png file.",
		"photo.mimes"=>"Upload jpg or png file.",
		"photo.dimensions"=>"Maximum width is 300px",
		"photo.max"=>"Upload the photo within 5120 bytes.",
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
		->with(['edit_mode'=>true])
		->withInput();

	   }else{
		 $photo=!empty($request->photo)?$request->photho:'./image/no_image.jpg';
		 $name=!empty($request->name)?$request->name:'No name';
		 $question_1=!empty($request->question_1)?$request->question_1:'No comment';
		 $question_2=!empty($request->question_2)?$request->question_2:'No comment';
		 $question_3=!empty($request->question_3)?$request->question_3:'No comment';


		 $fileName=$request->file("img")!==null?$request->file("img")->store("public/img/uploads"):null;

		 $result=Profile::find($user->id)->fill([
		  'photo'=>$fileName,
		  'question_1'=>$question_1,
		  'question_2'=>$question_2,
		  'question_3'=>$question_3,
		 ])->save();

		if($result===true){
		 return redirect()->route('user.showProfile',[
			'user'=>$user->id,
			'edit_mode'=>false]);

		}else{
		  return back()
		  ->with([
			'error_edit_profile'=>'Failed to save data. Please try again.',
			'edit_mode'=>true]);
	   }
	  }
	}


	public function getResetPassword(){
		\Log::info('getResetPassword');
		return view('reset_password');
	}

	public function resetPassword(passwordRequest $passwordRequest,User $user){
		\Log::info('user/resetPassword');

		$user->password=\Hash::make($passwordRequest->password);
		$result=$user->save();
		$result===true?response()->json($result,201):response()->json([],500);
	}

	public function storeFarovite(Request $request){

		\Log::info('user/storeFavorite');
		$validator=Validator::make($request->all(),[
			'to_user'=>'required|number|max:255'
		],[
			'to_user.required'=>'Input required.',
			'to_user.number'=>'Input number.',
			'to_user.max'=>'Id number is invalid.'
		]);

		if($validator->fails()){
		  $resonse['errors']=$validator->errors()->toArray();
		  throw new HttpResponseException(response()->json($response));
		}
		$request->merge([
			'from_user'=>Auth::id()
		]);

		$favorite=Favorite::create($request->all());
		$result=User::find($user->id)->is_liked_by_auth();

		if($favorite===true&&$result===true){
			return response()->json(['is_success'=>true],201);
		}

		throw new HttpResponseException(response()->json(['is_success'=>false,
			'storeFavorite_error'=>'Failed to store favorite.']));
	}

	public function deleteFavorite(Favorite $favorite){
		\Log::info('user/deleteFavorite');

		// $result=$fa ue?response()->json($favorite,201):response()->json([],500);
	}

	public function storeLike(User $user){
		\Log::info('user/storeLike');
    $liked=$user->is_liked_by_auth($user->id);
    $result='';
		if($liked===true){
		  $result=Like::where('from_user','=',Auth::id())->where('to_user','=',$user->id)->delete();
			$is_liked_by_auth=false;
			$count_likes=$user->likes()->count();
		}else if($liked===false){
      $result=Like::create([
				'from_user'=>Auth::id(),
				'to_user'=>$user->id,
			]);
			$count_likes=$user->likes()->count();
		  $is_liked_by_auth=true;
		}

		if($result===''){
	   \Log::info('error');
		  $response=response()->json([
			'error'=>'Failed to like.... sorry.'
			]);
			throw new HttpResponseException($response);

		}else{
		 	\Log::info('got/lost like');
			\Log::debug(__METHOD__.'$is_liked_by_auth:'.$is_liked_by_auth);
			$response=[
				'is_liked_by_auth'=>$is_liked_by_auth,
				'count_likes'=>$count_likes
			];
      return response()->json($response,201);
		}
	}

	public function deleteLike(LikeRequest $likeRequest,Like $like){
		\Log::info('user/deleteLike');
		$result=$like->delete();
		$result===true?response()->json($result,201):response()->json([],500);
	}

	public function getFavorites(){
		\Log::info('getFavorites');
		$favorites=Favorite::where('from_user','=',Auth::id())
		->with('user','user.profile','user.bucket_lists','user.likes')->get()->toArray();

		// foreach($favorites as $favorite){
		// 	$favorite['count_likes']=count($favorite['user']['likes']);
		// }
		\Log::info('favorites');

		$arr=[];
		foreach($favorites as $favorite){
			$is_liked_by_auth=User::find($favorite['user']['id'])->is_liked_by_auth($favorite['user']['id']);
			$result=array_merge($favorite,['is_liked_by_auth'=>$is_liked_by_auth]);
			array_push($arr,$result);
		}
      \Log::debug($arr);

		if(!empty($favorites)){
			return view('favorites')->with(['favorites'=>$arr]);
		}else{
			return view('favorites')->with(['favorites_ error'=>'Failed to get data.Please try again later.']);
		}

	}

}
