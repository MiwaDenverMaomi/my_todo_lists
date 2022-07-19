<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('allBucketLists')->with('bucket_lists',$bucket_lists);
    }

    /**
    * @param \App\Models\User $user
    * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user){
        \Log::info('BucketListController show');
        $bucket_list=User::with(['profile','bucket_lists','likes'])->find($user->id)->toArray();
        \Log::debug($bucket_list);
        $bucket_list['countLikes']=count($bucket_list['likes']);
        return $bucket_list?response()->json($bucket_list,201):response()->json([],500);
    }

    public function store(Bucket_listRequest $bucket_listRequest){
        \Log::info('BucketListController store');
        $bucket_listRequest->merge([
            'user_id'=>Auth::id(),
        ]);
        // $buckt_list_item=Bucket_list::create($bucket_listRequest->all());
        $bucket_list_item===true?response()->json($bucket_list_item,201):response()->json([],500);
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
    }
    public function deleteBucketList(Bucket_list $bucket_list){
        \Log::info('deleteBucketList');
        return $bucket_list->delete()?
        response()->json($bucket_list,201):
        response()->json([],500);
    }


}
