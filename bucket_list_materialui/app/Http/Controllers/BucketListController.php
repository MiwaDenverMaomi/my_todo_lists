<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BucketListRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Bucket_list;
use App\Models\User;
use App\Models\Like;
use Validator;
use Auth;


class BucketListController extends Controller
{
	public function index(){
		\Log::info('BucketLists index');
		\Log::debug(Auth::user());
		\Log::debug(Auth::id());

		$bucket_lists=User::with([
			'profile','bucket_lists','likes'
			 ])->select('id','name','email')->get()->toArray();
		\Log::debug($bucket_lists);
		for($i=0;$i<count($bucket_lists);$i++){
			$bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
		}
		\Log::debug($bucket_lists);
		return view('all_bucket_lists')->with('bucket_lists',$bucket_lists);
	}

	/**
	* @param \App\Models\User $user
	* @return \Illuminate\Http\JsonResponse
	 */
	public function show(User $user){
		\Log::info('BucketListController show');
		$user_data=User::with(['profile','bucket_lists','likes'])->find($user->id)->toArray();
		$user_data['countLikes']=count($user_data['likes']);

		return view('my_page')->with('user_data',$user_data);
	}

	public function create(Request $request){
		\Log::info('BucketListController create');
		\Log::debug($request);
		$user_auth_id=5; //Auth::id()

		//validation
		$validator=Validator::make($request->all(),[
			"new_todo"=>'required | max:255',
		],[
			"new_todo.required"=>"Input todo.",
			"new_todo.max"=>"Input less than 255 letters."
		]);

		if($validator->fails()){
			\Log::info('create validator failed');
			return back()
			->withErrors($validator)
			->withInput();

		}else{
				\Log::info('create validator success');
				$result=Bucket_list::create(["user_id"=>$user_auth_id,"bucket_list_item"=>$request->new_todo,"is_done"=>false]);

				if($result===true){
						$user_data=User::with(['profile','bucket_lists','likes'])->find($user_auth_id)->toArray();
						$user_data['countLikes']=count($user_data['likes']);
						if(!empty($user_data)){
							return redirect()->route('bucket-lists.show',['user'=>$user_auth_id]);

						}else{
							return back()
							->with(['create_error'=>'Failed to save data. Please try again later.'])
							->withInput();
						}

				}else{
							return back()
							->with(['create_error'=>'Failed to save data. Please try again later.'])
							->withInput();
				}
		}

	}

	public function storeLike(LikeRequest $likeRequest){
		$likeRequest->merge([
			'from_user'=>Auth::id()
		]);

		$like=Like::create($LikeRequest->all());
		$like?response()->json($like,201):
		response()->json([],500);
	}

	public function deleteLike(Like $like){
		\Log::info('deleteLike');
		return $like->delete()?
		response()->json($like,201):
		response()->json([],500);
	}

	 public function storeFavorite(FavoriteRequest $favoriteRequest){
		$FavoriteRequest->merge([
			'from_user'=>Auth::id()
		]);

		$favorite=Favorite::create($favoriteRequest->all());
		$favorite?response()->json($favorite,201):
		response()->json([],500);
	}

	public function deleteFavorite(Favorite $favorite){
		\Log::info('deleteFavorite');
		return $favofite->delete()?
		response()->json($favorite,201):
		response()->json([],500);
	}

	public function updateIsDone(Bucket_list $bucket_list){
		\Log::info('updateIsDone');

			$bucket_list->is_done=!$bucket_list->is_done;
			$result=$bucket_list->save();

			if($result===true){
				return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
			}else{
				return back()
				->with(['update_is_done_error'=>'Failed to save data. Please try again later.']);
			}
	}

	public function updateTitle(Request $request,Bucket_list $bucket_list){
		\Log::info('update');

		$validator=Validator::make($request->all(),[
			"title"=>"required | max:255"
		],[
			"title.required"=>"Input todo.",
			"tite.max"=>"Input less than 255 letters."
		]);

		if($validator->fails()){
			\Log::debug($validator);
			return back()
			->withErrors($validator)
			->withInput();

		}else{
			 $bucket_list->bucket_list_item=$request->title;
			 $result=$bucket_list->save();

			 if($result===true){
				 return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
			 }else{
         return back()->with([`update_title_error`=>'Failed to save data. Please try again later.']);
			 }
		}
	}

	public function delete(Bucket_list $bucket_list){
		\Log::info('deleteBucketList');
		$bucket_list->delete();

		$user_data=User::with(['profile','bucket_lists','likes'])->find($bucket_list->user_id)->toArray();
		if(!empty($user_data)){
			 $user_data['countLikes']=count($user_data['likes']);
			 return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
		}else{
			 return back()
			 ->with(['delete_error','Failed to save data. Please try again later!']);
		}
}
}
