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
use \InterventionImage;

class UserController extends Controller
{
/**
* Gets page of each user's todo list and profile.
* @param App\Models\User $user
* @return Illuminate\View\View
*/
	public function index(User $user){
		\Log::info('user/index');
		$user_data=User::with(['profile','likes','bucket_lists'])->select('id','name','email')->find($user->id)->toArray();
		\Log::debug($user);
		$is_liked_by_auth=$user->is_liked_by_auth($user->id);
		$is_favorite_by_auth=$user->is_favorite_by_auth($user->id);
		$user_data['countLikes']=count($user_data['likes']);
		$user_data['is_liked_by_auth']=$is_liked_by_auth;
		$user_data['is_favorite_by_auth']=$is_favorite_by_auth;
    $user_data['email']= substr($user_data['email'],0,5).'***';
		\Log::debug($user_data);
		 return  view('list_user')->with(['user_data'=>$user_data]);
	}

/**
* Switches to the edit profile mode by returning boolean in profile page.
* @param App\Models\User $user
* @param Illuminate\Http\Request $request
* @return Illuminate\Http\RedirectResponse
*/
	public function editProfileMode(User $user,Request $request){
		\Log::info('editProfileMode');
		$profile=Profile::where('user_id','=',$user->id)->first();
		if(!empty($profile)){
			\Log::info('not empty');
     $this->authorize('checkUser',$profile);
		}else{
			\Log::info('empty');
     if($user->id!==Auth::id()){
			 \Log::info('user->id !==Auth::id()');
			 abort(403);
		 }
		}

		\Log::debug($request->edit_mode);
		$edit_mode=((bool) $request->edit_mode)===true?true:false;

		 return redirect()->route('user.showProfile',[
		'user'=>$user->id,
		'edit_mode'=>$edit_mode]);
	}

/**
* Show user's profile before edit.
* @param App\Models\User $user
* @param Illuminate\Http\Request $request
* @return Illuminate\View\View
*/
	public function showProfile(User $user,Request $request){
		\Log::info('showProfile');
		$profile=Profile::where('user_id','=',$user->id)->first();
		if(!empty($profile)){
			\Log::debug('not empty');
			$this->authorize('checkUser',$profile);
		}else{
			\Log::info('$profile=empty');
			if($user->id!==Auth::id()){
				\Log::debug($user->id);
				\Log::debug(Auth::id());
				\Log::debug($user->id!==Auth::id());
        abort(403);
			}
		}

		$edit_mode=((bool) $request->edit_mode)===true?true:false;
		$user_data=User::with(['profile','likes'])->select('id','name','email')->find($user->id)->toArray();
		\Log::debug($user);
		$is_liked_by_auth=$user->is_liked_by_auth($user->id);
		$is_favorite_by_auth=$user->is_favorite_by_auth($user->id);
		$user_data['countLikes']=count($user_data['likes']);
		$user_data['is_liked_by_auth']=$is_liked_by_auth;
		$user_data['is_favorite_by_auth']=$is_favorite_by_auth;
		\Log::debug($user_data);
		return view('my_profile')->with([
		'user_data'=>$user_data,
		'edit_mode'=>$edit_mode]);
	}

/**
* Posts edited profile data.
* @param Illuminate\Http\Request $request
* @param App\Models\User $user
* @return Illuminate\Http\RedirectResponse|Illuminate\View\View
*/
	public function editProfile(Request $request,User $user){
		 \Log::info('user/editProfile');
		 \Log::debug('user->id:'.$user->id);
		 \Log::debug(__METHOD__.'$request:'.$request);
		 \Log::debug($request->all());

		 $profile=Profile::where('user_id','=',$user->id)->first();
		 if(!empty($profile)){
      $this->authorize('checkUser',$profile);
		 }else{
			if($user->id!==Auth::id()){
        abort(403);
			}
		 }

    //Validation messages
		 $validator=Validator::make($request->all(),[
		"photo"=>'max:2048|nullable|image|mimes:jpeg,png,jpg',//800万画素->8MB
		"name"=>"nullable|string|max:255",
		"question_1"=>"nullable|string |max:500",
		"question_2"=>"nullable|string |max:500",
		"question_3"=>"nullable|string |max:500",
		 ],[
		"photo.image"=>"Upload image file.",
		"photo.mimes"=>"Upload jpg or png file.",
		"photo.max"=>"Upload the photo within 2MB bytes.",
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
		\Log::debug(__METHOD__.':valid failed');
		return back()
		->withErrors($validator)
		->with(['edit_mode'=>true])
		->withInput();

		 }else{
			\Log::debug(__METHOD__.':valid success');
		 $name=!empty($request->name)?$request->name:'No name';
		 $question_1=!empty($request->question_1)?$request->question_1:'No comment';
		 $question_2=!empty($request->question_2)?$request->question_2:'No comment';
		 $question_3=!empty($request->question_3)?$request->question_3:'No comment';

		 if(!empty($request->file('photo'))){
			//if photo was selected
			// $dir='user_photo';
			// $file_name=$request->file('photo')->getClientOriginalName();
		  // $request->file('photo')->storeAs('public/img/uploads/'.$dir,$file_name);
		  // $photo_path='storage/img/uploads/'.$dir.'/'.$file_name;
			$photo_path = base64_encode(file_get_contents($request->photo->getRealPath()));
			// $interventionImage=InterventionImage::make($request->photo)->resize(8192,null,function($constraint){$constraint->aspectRatio();});
			// $photo_path=base64_encode(file_get_coentents($interventionImage->getRealPath()));
			$result_profile=Profile::updateOrCreate([
			'user_id'=>$user->id],[
      'photo'=>$photo_path,
			'question_1'=>$question_1,
			'question_2'=>$question_2,
			'question_3'=>$question_3,
			]);

		 }else{//if photo was not selected
			$photo_in_db=Profile::where('user_id','=',$user->id)->first();

			if(empty($photo_in_db)){//if profile table has data in 'photo'
			 $photo_path=null;
			 $result_profile=Profile::updateOrCreate([
			'user_id'=>$user->id],[
      'photo'=>$photo_path,
			'question_1'=>$question_1,
			'question_2'=>$question_2,
			'question_3'=>$question_3,
			]);

			}else{
			$result_profile=Profile::updateOrCreate([
			'user_id'=>$user->id],[
			'question_1'=>$question_1,
			'question_2'=>$question_2,
			'question_3'=>$question_3,
			]);
			}
		 }

    //Updates name
		$result_name=User::find($user->id)->update([
			'name'=>$name
		]);

		\Log::debug($result_profile);
		\Log::debug($result_name);

	  //Saving data is success
		if(!empty($result_profile)&&$result_name===true){
			\Log::debug(__METHOD__.':saving data success!');
		 return redirect()->route('user.showProfile',[
			'user'=>$user->id,
			'edit_mode'=>false]);

		}else{
		//Fails to save data
			\Log::debug(__METHOD__.':saveing data failed!');
			return view('my_profile')
			->with([
			'error_edit_profile'=>'Failed to save data. Please try again.',
			'edit_mode'=>true]);
		 }
		}
	}

/**
* Updates favorites (delete/cerate records in Favorites table)
* @param App\Models\User $user ->User's id who got favorite
* @return \Illuminate\Http\JsonResponse
*/
	public function storeFavorite(User $user){
		\Log::info('user/storeFavorite');
		$is_favorite_by_auth=$user->is_favorite_by_auth($user->id);
		$result='';
		if($is_favorite_by_auth===true){
			$result=Favorite::where('from_user','=',Auth::id())
			->where('to_user','=',$user->id)->delete();
			$is_favorite_by_auth=false;
		}else if($is_favorite_by_auth===false){
			$result=Favorite::create([
				'from_user'=>Auth::id(),
				'to_user'=>$user->id,
			]);
			$is_favorite_by_auth=true;
		}
		\Log::debug($result);
		if($result===''){
			\Log::info('error');
			 \Log::debug(__METHOD__.'id:'.$user->id.'failed to update favorite...');
			return response()->json([
			'error'=>'Failed to favorite.... sorry.'
			],500);
			throw new HttpResponseException($response);
		}else{
			 \Log::info('success');
		 return	response()->json([
				'is_favorite_by_auth'=>$is_favorite_by_auth
			],201);
		}
	}
/**
* Updates likes (delete/cerate records in Likes table)
* @param App\Models\User $user ->User's id who got like
* @return  \Illuminate\Http\JsonResponse
*/
	public function storeLike(User $user){
		\Log::info('user/storeLike');
		\Log::debug($user->id);
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

/**
* Shows page "Favorite" with user's data who got favorite by the auth user.
*
* @return  Illuminate\View\View
*/
	public function getFavorites(){
		\Log::info('getFavorites');
		$favorites=Favorite::where('from_user','=',Auth::id())
		->with('user','user.profile','user.bucket_lists','user.likes')->get()->toArray();

		\Log::info('favorites');

		$arr=[];
		foreach($favorites as $favorite){
			$is_liked_by_auth=User::find($favorite['user']['id'])->is_liked_by_auth($favorite['user']['id']);
			$is_favorite_by_auth=User::find($favorite['user']['id'])->is_favorite_by_auth($favorite['user']['id']);
			$result=array_merge($favorite,[
				'is_liked_by_auth'=>$is_liked_by_auth,
			 	'is_favorite_by_auth'=>$is_favorite_by_auth]);
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
