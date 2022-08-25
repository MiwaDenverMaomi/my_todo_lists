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

/**
* Gets page "Top" with the data of all user's todo lists and profiles.
* @return Illuminate\View\View
*/
	public function index(){
		\Log::info('BucketLists index');
		\Log::debug(Auth::user());
		\Log::debug(Auth::id());

		//Gets todo lists with user's profile, likes.
		$bucket_lists=User::with([
			'profile','bucket_lists','likes'
			 ])->select('id','name','email')->get()->sortByDesc('id')->toArray();
		\Log::debug($bucket_lists);

		//Adds the number of 'likes' and check if the user is liked by auth user. Disguise email address of each user.
		for($i=0;$i<count($bucket_lists);$i++){
			$bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
			$bucket_lists[$i]['is_liked_by_auth']=User::find($bucket_lists[$i]['id'])->is_liked_by_auth($bucket_lists[$i]['id']);
			$bucket_lists[$i]['is_favorite_by_auth']=User::find($bucket_lists[$i]['id'])->is_favorite_by_auth($bucket_lists[$i]['id']);
			$bucket_lists[$i]['email']= substr($bucket_lists[$i]['email'],0,5).'***';
		}

		$arr_bucket_lists_not_empty=[];
		$arr_bucket_lists_empty=[];

		//Sort users into 2 groups.One is users with no item in their todo lists(groupA) and the other one is with more than one item(groupB).
		foreach($bucket_lists as $item){
			if(!empty($item['bucket_lists'])){
				array_push($arr_bucket_lists_not_empty,$item);
			}
		}
		//Sort groupB according to 'updated_at' of the latest todo item.
		usort($arr_bucket_lists_not_empty,function($a,$b){
			 return $a['bucket_lists'][0]['updated_at']<$b['bucket_lists'][0]['updated_at']?1:-1;
		});

		//This is group A.
		foreach($bucket_lists as $item){
			if(empty($item['bucket_lists'])){
				array_push($arr_bucket_lists_empty,$item);
			}
		}
    //Merge group A and B.
		$result=array_merge($arr_bucket_lists_not_empty,$arr_bucket_lists_empty);
		\Log::debug($result);
		return view('all_bucket_lists')->with('bucket_lists',$result);
	}

	/**
	* Shows page of auth user's todo list .
	* @param \App\Models\User $user
	* @return \Illuminate\View\View
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

		try{
     $user_data=User::with(['profile','bucket_lists','likes'])->find($user->id)->toArray();
		  $user_data['countLikes']=count($user_data['likes']);
      if(!empty($user_data)){
				return view('my_page')->with('user_data',$user_data);
			}else{
				throw new \Exception('$bucket_lists is empty!');
			}

		}catch(\Exception $e){
			\Log::debug(__METHOD__.':'.$e->getMessage());
		   return view('my_page')
		   ->with([
			'show_result'=>'Failed to show your todo list... sorry!'
		]);
		}

	}

/**
	* Posts the created todo item.
	* @param \App\Models\User $user
	* @param Illuminate\Http\Request
	* @return \Illuminate\View\View
	*/
	public function create(Request $request){
		\Log::info('BucketListController create');

		\Log::debug($request);

		//Validation messages
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

	/**
	* Updates the todo item is checked.
	* @param \App\Models\Bucket_list $bucket_list
	* @return Illuminate\Http\RedirectResponse|\Illuminate\View\View
	*/
	public function updateIsDone(Bucket_list $bucket_list){
		\Log::info('updateIsDone');

		//Check if the user is authorized
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
	/**
	* Updates the todo item if it is editted.
	* @param Illuminate\Http\Request $request
	* @param App\Models\Bucket_list $bucket_list
	* @return Illuminate\Http\RedirectResponse|Illuminate\View\View
	*/
	public function updateTitle(Request $request,Bucket_list $bucket_list){
		\Log::info('update');
		//Check if the user is authorized
		$this->authorize('checkUser',$bucket_list);

		//Validation messages
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
	/**
	* Deletes the todo item.
	* @param \App\Models\Bucket_list $bucket_list
	* @return \Illuminate\View\View
	*/

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

	/**
	* Searches the todo lists by name and todo items
	* @param Illuminate\Http\Request $request
	* @return \Illuminate\View\View
	*/
public function searchKeyword(Request $request){
	 \Log::info('searchKeyword');
	 \Log::debug($request);

  if(empty($request->keyword)){
		return redirect()->route('bucket-lists.index');
	 }

	 $keyword=trim($request->keyword);
	 $request->keyword=$keyword;

	 //Validation
	 $validator=Validator::make($request->all(),
	 [
		'keyword'=>'string|max:255'
	 ],[
		'keyword.required'=>'Input valid data.',
		'keyword.max'=>'Input within 255 letters.'
	 ]);

	 if($validator->fails()){
		return back()
		->withErrors($validator)
		->withInput();
	 }

	try{
	 $space_conversion=mb_convert_kana($keyword);
	 $word_array_searched = preg_split('/[\s,]+/', $space_conversion, -1, PREG_SPLIT_NO_EMPTY);
	 \Log::info(' $word_array_searched ');
   \Log::debug( $word_array_searched );

	 $bucket_lists_searched_in_bucket_lists_table=User::with('profile','bucket_lists','likes')->whereHas('bucket_lists',function($q) use($word_array_searched){
			for($i=0;$i<count($word_array_searched);$i++) {
				if($i===0){
					 $q->where('bucket_list_item', 'iLIKE', '%'.$word_array_searched[$i].'%');
				}else{
					 $q->orWhere('bucket_list_item', 'iLIKE', '%'.$word_array_searched[$i].'%');
				}

						}
	 })->select('id','name','email')->get()->sortByDesc('updated_at'
	 )->toArray();

	 $query=User::query();
	 foreach($word_array_searched as $value){
		$query->orWhere('name','iLIKE','%'.$value.'%');
	 }

	 $bucket_lists_searched_in_users_table=$query->with('profile','bucket_lists','likes')->select('id','name','email')->get()->sortByDesc('updated_at')->toArray();

	\Log::info('bucket_lists_searched_in_bucket_lists_table');
	\Log::debug($bucket_lists_searched_in_bucket_lists_table);
	\Log::info('bucket_lists_searched_in_users_table');
	\Log::debug($bucket_lists_searched_in_users_table);

  $bucket_lists=array_unique(array_merge($bucket_lists_searched_in_bucket_lists_table,$bucket_lists_searched_in_users_table), SORT_REGULAR);
	\Log::info('array_unique');
	\Log::debug($bucket_lists);


	//change by the order of the users' todo lists according to the latest 'update_at' of the latest todo item.
	if(!empty($bucket_lists)){
		$bucket_lists_not_empty=[];
		$bucket_lists_empty=[];
    //Add the number of likes and check if the user is liked by auth user.
		for($i=0;$i<count($bucket_lists);$i++){
			$bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
			$bucket_lists[$i]['is_liked_by_auth']=User::find($bucket_lists[$i]['id'])->is_liked_by_auth($bucket_lists[$i]['id']);
			$bucket_lists[$i]['is_favorite_by_auth']=User::find($bucket_lists[$i]['id'])->is_favorite_by_auth($bucket_lists[$i]['id']);
		}
    //Sort the users into 2 groups. GroupA:users with no todo item,
		//groupB: users with more than 1 item.
		foreach($bucket_lists as $list){
			if(!empty($list['bucket_lists'])){
				array_push($bucket_lists_not_empty,$list);
			}else{
				array_push($bucket_lists_empty,$list);
			}
		}
    //Change order of the users in group B according to the latest 'updated_at.'
		usort($bucket_lists_not_empty,function($a,$b){
			return $a['bucket_lists'][0]['updated_at']>$b['bucket_lists'][0]['updated_at']?-1:1;
		});
    //Combine group A and B.
		$result=array_merge($bucket_lists_not_empty,$bucket_lists_empty);

		$count=!empty($result)?count($result):0;
		 return view('all_bucket_lists')
		 ->with([
			'keyword'=>$keyword,
			'bucket_lists'=>$result,
			'result_count'=>$count,
		]);
	}else{
		throw new \Exception('$bucket_lists is empty!');
	}
	}catch(\Exception $e){
		\Log::debug(__METHOD__.':'.$e->getMessage());
		 return view('all_bucket_lists')
		 ->with([
			'keyword'=>$keyword,
			'search_result'=>'Failed to search... sorry!'
		]);
	}
	}
}
