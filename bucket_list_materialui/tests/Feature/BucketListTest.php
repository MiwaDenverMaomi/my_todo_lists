<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Request\BucketListRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth ;
use App\Models\Bucket_list;
use App\Models\User;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Favorite;
use Tests\TestCase;


class BucketListTest extends TestCase
{
    // use RefreshDatabase;//Reset all database after executing test codes.
    /**
     *
     * @test
     */
    public function test_index()
    {
        $response = $this->get('/');
        $response->assertOk();

        User::factory(20)->create();
        Profile::factory(20)->create();
        Like::factory(20)->create();
        Favorite::factory(20)->create();
        Bucket_list::factory(20)->create();

        $bucket_lists=User::with([
            'profile','bucket_lists','likes',
           ])->select('id','name','email')->get()->toArray();
        for($i=0;$i<count($bucket_lists);$i++){
            $bucket_lists[$i]['countLikes']=count($bucket_lists[$i]['likes']);
        }

        $this->assertNotNull($bucket_lists);
        $this->assertNotEmpty($bucket_lists);
        // dd(response()->json($bucket_lists,201));
        // dd(response()->json($bucket_lists,500));

    }

    /**
     * @test
     * @covers \App\Controllers\BucketListController::show
     */
    public function test_show(){

        User::factory(20)->create();
        Profile::factory(20)->create();
        Like::factory(20)->create();
        Favorite::factory(20)->create();
        Bucket_list::factory(20)->create();

        $query=[
            'user'=>1
        ];

        $response= $this->call('GET','/bucket-lists',$query);
        $response->assertStatus(201);

        $bucket_list=User::with(['profile','bucket_lists','likes'])->find($query['user'])->toArray();

        $bucket_list['countLikes']=count($bucket_list['likes']);

    //     $this->assertNotNull($bucket_list);
    //     $this->assertNotEmpty($bucket_list);

    }

    /**
     * @text
     * @dataProvider dataproviderValidation
     */

    // public function validationCheck(array $params,bool $expected):void{
    //     $request=new BucketListRequest;
    //     $rules=$request->rules();
    //     $validator=Validator::make($params,$rules);
    //     $result=$validator->passes();
    //     $this->assertEquals($expect,$result);
    // }

    // public function dataproviderValidation(){
    //      return [
    //         'bucket_list create success' => [
    //             [
    //                  'user_id'=>'bigInteger',
    //                  'bucket_list_item'=>'required | max:500 |string',
    //                  'is_done'=> boolean
    //             ],
    //             true,
    //         ],
    //         'bucket_list create null error' => [
    //             [
    //                 'bucket_list_item' => '{パラメータ}',
    //             ],
    //             {結果},
    //         ],
    //     ];
    // }
 /**
     * @test
     */
    // public function test_create(){

    //     $request=new Request();
    //     $request->bucket_list_item="Sleep with my cat.";
    //     $user=User::factory(1)->create();
    //     $request->user_id=$user->find(1)->id;
    //     $request->is_done=false;
    //     $bucket_list_item=Bucket_list::create(["user_id"=>1,"bucket_list_item"=>$request->bucket_list_item,"is_done"=>$request->is_done]);//Errors if write (create(request->all()))

    //     $this->assertNotNull($bucket_list_item);
    //     $this->assertNotEmpty($bucket_list_item);

    // }
 /**
     * @test
     */
    //  public function test_storeLike(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();

    //     $request=new Request();//
    //     $user=User::find(1);
    //     $request->to_user=2;
    //     $request->merge([
    //         'from_user'=>1//$user->id
    //     ]);

    //     $like=Like::create(['from_user'=>$request->from_user,'to_user'=>$request->to_user]);
    //     $this->assertNotNull($like);
    //     $this->assertNotEmpty($like);
    // }
    /**
     * @test
     */
    // public function deleteLike(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();
    //     // $request=new Request();//
    //     // $request->like=3;
    //     $like=Like::find(3);
    //     $result=$like->delete();
    //     $this->assertSame(true,$result);
    // }
    /**
     * @test
    */
    //  public function test_storeFavorite(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();
    //     $user=User::find(3);

    //     $request=[
    //         'from_user'=>$user->id,
    //         'to_user'=>5
    //     ];
    //     $favorite=Favorite::create($request);
    //     $this->assertNotNull($favorite);
    //     $this->assertNotNull($favorite);

        // $favorite=Favorite::create($favoriteRequest->all());
        // $favorite?response()->json($favorite,201):
        // response()->json([],500);
    // }

    // public function test_updateBucketListItem(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();

    //     $request=[
    //         'id'=>4,
    //         'bucket_list_item'=>"xxxxx",
    //     ];
    //     $bucket_list=Bucket_list::find(4);
    //     $bucket_list->id=$request['id'];
    //     $bucket_list->bucket_list_item=$request['bucket_list_item'];
    //     $result=$bucket_list->save();
    //     $this->assertTrue($result);
    // }

    // public function test_updateIsDone(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();

    //     $request=[
    //         'id'=>4,
    //         'is_done'=>done,
    //     ];
    //     $bucket_list=Bucket_list::find(4);
    //     $bucket_list->id=$request['id'];
    //     $bucket_list->is_done=$request['is_done'];
    //     $result=$bucket_list->save();
    //     $this->assertTrue($result);
    // }

    // public function test_deleteBucketList(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();

    //     $bucket_list=Bucket_list::find(5);
    //     $result=$bucket_list->delete();
    //     $this->assertTrue($result);

    // }
    // public function bucketListProvider(){
    //     return[
    //         [["user_id"=>1,"bucket_list_item"=>"Sleep with my cat."],
    //         1,
    //         "Sleep with my cat."],
    //          [["user_id"=>2,"bucket_list_item"=>"Sleep with my fish."],
    //         2,
    //         "Sleep with my fish."],
    //          [["user_id"=>3,"bucket_list_item"=>"Sleep with my dog."],
    //         3,
    //         "Sleep with my dog."],
    //     ];
    // }
}
