<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BucketListRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Bucket_list;
use App\Models\User;
use App\Models\Like;
use Validator;


class BucketListController extends Controller
{
	public function index(){
		\Log::info('BucketLists index');
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

						}else
						  return back()
							->with('Failed to save data. Please try again later.')
							->withInput();

				}else{
              return back()
							->with('Failed to save data. Please try again later.')
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
			 $bucket_list->save();

			 return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
	}

	public function updateTitle(Request $request){
		\Log::info('update');

		Bucket_list::find($request->id)->bucket_list_item=$request->title->save();



	}

	public function delete(Bucket_list $bucket_list){
		\Log::info('deleteBucketList');
		$user_auth_id=5;//auth::id()
		$bucket_list->delete();

		$user_data=User::with(['profile','bucket_lists','likes'])->find($user_auth_id)->toArray();
		$user_data['countLikes']=count($user_data['likes']);
		return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
}

}
