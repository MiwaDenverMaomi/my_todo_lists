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
			 ])->select('id','name','email')->get()->sortByDesc('id')->toArray();
		\Log::debug($bucket_lists);
		for($i=0;$i<count($bucket_lists);$i++){
			$bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
			$bucket_lists[$i]['email']= substr($bucket_lists[$i]['email'],0,5).'***';
		}
    $arr_bucket_lists_not_empty=[];
		$arr_bucket_lists_empty=[];
		foreach($bucket_lists as $item){
			if(!empty($item['bucket_lists'])){
				array_push($arr_bucket_lists_not_empty,$item);
			}
		}
		usort($arr_bucket_lists_not_empty,function($a,$b){
			 return $a['bucket_lists'][0]['updated_at']<$b['bucket_lists'][0]['updated_at']?1:-1;
		});
		foreach($bucket_lists as $item){
			if(empty($item['bucket_lists'])){
				array_push($arr_bucket_lists_empty,$item);
			}
		}

		$result=array_merge($arr_bucket_lists_not_empty,$arr_bucket_lists_empty);
    \Log::debug($result);
		// $result=usort($bucket_lists,function($a,$b){
		// 	\Log::info('sort');
		// 	\Log::debug($a);
		// 	\Log::debug($b);
    //   if(!empty($a['bucket_lists'])){
    //     if(!empty($b['bucket_lists'])){
    //        return $a['bucket_lists'][0]['updated_at']>$b['bucket_lists'][0]['updated_at']?1:-1;
		// 		}else{
    //        return $a['bucket_lists'][0]['updated_at']>$b['bucket_lists'][0]['updated_at']?1:-1;
		// 		}
		// 	}else{
    //     if(!empty($b['bucket_lists'])){
    //        return 1;
		// 		}
		// 	}
		// });
		// \Log::debug($resu);
		return view('all_bucket_lists')->with('bucket_lists',$result);
	}

	/**
	* @param \App\Models\User $user
	* @return \Illuminate\Http\JsonResponse
	 */
	public function show(User $user){
		\Log::info('BucketListController show');
		//Check the user is allowed to access this page
		$bucket_list=Bucket_list::where('user_id','=',$user->id)->first();
		if(!empty($bucket_list)){//if the user has at least a record
      $this->authorize('checkUser',$bucket_list);
		}else{
			if($user->id!==Auth::id()){//if the user does not have any record
				abort(403);
			}
		}
		\Log::debug($bucket_list);


		$user_data=User::with(['profile','bucket_lists','likes'])->find($user->id)->toArray();
		$user_data['countLikes']=count($user_data['likes']);

		return view('my_page')->with('user_data',$user_data);
	}

	public function create(Request $request){
		\Log::info('BucketListController create');

		\Log::debug($request);
		//validation
		$validator=Validator::make($request->all(),[
			"new_todo"=>'required |string| max:255',
		],[
			"new_todo.required"=>"Input todo.",
			"new_todo.string"=>"Input valid data.",
			"new_todo.max"=>"Input less than 255 letters."
		]);

		if($validator->fails()){
			\Log::info('create validator failed');
			return back()
			->withErrors($validator)
			->withInput();

		}else{
				\Log::info('create validator success');
				$result=Bucket_list::create(["user_id"=>Auth::id(),"bucket_list_item"=>$request->new_todo,"is_done"=>false]);
				\Log::debug(__METHOD__.'/result:'.$result);

				if(!empty($result)){
						$user_data=User::with(['profile','bucket_lists','likes'])->find(Auth::id())->toArray();
						$user_data['countLikes']=count($user_data['likes']);
						if(!empty($user_data)){
							return redirect()->route('bucket-lists.show',['user'=>Auth::id()]);

						}else{
							return view('my_page')
							->with(['create_error'=>'Failed to save data. Please try again later.'])
							->withInput();
						}

				}else{
							return view('my_page')
							->with(['create_error'=>'Failed to save data. Please try again later.'])
							->withInput();
				}
		}

	}

	public function updateIsDone(Bucket_list $bucket_list){
		\Log::info('updateIsDone');

		$this->authorize('checkUser',$bucket_list);
			$bucket_list->is_done=!$bucket_list->is_done;
			$result=$bucket_list->save();

			if($result===true){
				return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
			}else{
				return view('my_page')
				->with(['update_is_done_error'=>'Failed to save data. Please try again later.']);
			}
	}

	public function updateTitle(Request $request,Bucket_list $bucket_list){
		\Log::info('update');
    $this->authorize('checkUser',$bucket_list);

		$validator=Validator::make($request->all(),[
			"title"=>"required|string | max:255"
		],[
			"title.required"=>"Input todo.",
			"title.string"=>"Input valid data.",
			"title.max"=>"Input less than 255 letters."
		]);

		if($validator->fails()){
			\Log::debug($validator->errors());
			return back()
			->withErrors($validator)
			->withInput();

		}else{
			 $bucket_list->bucket_list_item=$request->title;
			 $result=$bucket_list->save();

			 if($result===true){
				 return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
			 }else{
				 return view('my_page')->with([`update_title_error`=>'Failed to save data. Please try again later.']);
			 }
		}
	}

	public function delete(Bucket_list $bucket_list){
		\Log::info('deleteBucketList');
		$this->authorize('checkUser',$bucket_list);

		$result=$bucket_list->delete();

		if($result===true){
			 return redirect()->route('bucket-lists.show',['user'=>$bucket_list->user_id]);
		}else{
			 return view('my_page')
			 ->with(['delete_error','Failed to save data. Please try again later!']);
		}
}

public function searchKeyword(Request $request){
	 \Log::info('searchKeyword');
	 \Log::debug($request);
	 $keyword=trim($request->keyword);
	 $request->keyword=$keyword;

	 $validator=Validator::make($request->all(),
	 [
		'keyword'=>'required|max:255'
	 ],[
		'keyword.required'=>'Input keyword.',
		'keyword.max'=>'Input within 255 letters.'
	 ]);

	 if($validator->fails()){
		return back()
		->withErrors($validator)
		->withInput();
	 }

	 $space_conversion=mb_convert_kana($keyword);
	 $word_array_searched = preg_split('/[\s,]+/', $space_conversion, -1, PREG_SPLIT_NO_EMPTY);

	 $bucket_lists=User::with('profile','bucket_lists','likes')->whereHas('bucket_lists',function($q) use($word_array_searched){
			foreach($word_array_searched as $value) {
						 $q->where('bucket_list_item', 'like', '%'.$value.'%');
						}
	 })
	 ->select('id','name','email')->orderBy('users.updated_at'
	 )->get()->toArray();

	 for($i=0;$i<count($bucket_lists);$i++){
			$bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
		}
	 \Log::debug($bucket_lists);
		$count=!empty($bucket_lists)?count($bucket_lists):0;
		 return view('all_bucket_lists')
		 ->with([
			'keyword'=>$keyword,
			'bucket_lists'=>$bucket_lists,
			'result_count'=>$count,
		]);
	}

}
