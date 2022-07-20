<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BucketListRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Bucket_list;
use App\Models\User;
use App\Models\Like;


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
		$user_auth_id=2; //Auth::id()

		Bucket_list::create(["user_id"=>$user_auth_id,"bucket_list_item"=>$request->new_todo,"is_done"=>false]);

		$user_data=User::with(['profile','bucket_lists','likes'])->find($user_auth_id)->toArray();
		$user_data['countLikes']=count($user_data['likes']);
		return view('my_page')->with('user_data',$user_data);
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

	public function update(Bucket_listRequest $bucket_listRequest,Bucket_list $bucket_lsit){
		\Log::info('update');
		$bucket_list->bucket_list_item=$bucket_listRequest->bucket_list_item;
		$bucket_list->is_done=$bucket_listRequest->is_done;


	//  'id'=>4,
	//         'bucket_list_item'=>"xxxxx",
	//     ];
	//     $bucket_list=Bucket_list::find(4);
	//     $bucket_list->id=$request['id'];
	//     $bucket_list->bucket_list_item=$request['bucket_list_item'];
	//     $result=$bucket_list->save();



	}
	public function deleteBucketList(Bucket_list $bucket_list){
		\Log::info('deleteBucketList');

        $bucket_list->delete();

		$user_data=User::with(['profile','bucket_lists','likes'])->find($user_auth_id)->toArray();
		$user_data['countLikes']=count($user_data['likes']);
		return view('my_page')->with('user_data',$user_data);
	}


}
