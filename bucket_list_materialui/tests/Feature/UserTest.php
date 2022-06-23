<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Request\BucketListRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth ;
use App\Models\Bucket_list;
use App\Models\User;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Favorite;



class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    protected function setUp():void{
        parent::setUp();
        User::factory(20)->create();
        Profile::factory(20)->create();
        Like::factory(20)->create();
        Favorite::factory(20)->create();
        Bucket_list::factory(20)->create();

        $this->user=User::find(4);

    }
    // public function test_data_insert(){
    //         User::factory(20)->create();
    //         Profile::factory(20)->create();
    //         Like::factory(20)->create();
    //         Favorite::factory(20)->create();
    //         Bucket_list::factory(20)->create();
    // }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_index(){
    //     $data=[  ['from_user'=>5,'to_user'=>4],  ['from_user'=>8,'to_user'=>4],['from_user'=>4,'to_user'=>9],['from_user'=>7 ,'to_user'=>4]];
    //     $result=Like::insert($data);

    //     $user_data=User::with(['profile','likes'])->select('id','name','email')->find($this->user->id)->toArray();
    //     $is_liked_by_auth=$this->user->is_liked_by_auth();
    //     $user_data['countLikes']=count($user_data['likes']);
    //     $user_data['is_liked_by_auth']=$is_liked_by_auth;
    //     dd($user_data);
    //     // $this->assertNotNull($user_data);
    //     // $this->assertNotEmpty($user_data);
    // }

    // public function  test_editProfile(){

    //    User::factory(20)->create();
    //    Profile::factory(20)->create();
    //    Like::factory(20)->create();
    //    Favorite::factory(20)->create();
    //    Bucket_list::factory(20)->create();
    //    $userRequest=new Request();
    //    $userRequest->name='otto';
    //    $userRequest->photo="xxx";
    //    $userRequest->question_1='hoge';
    //    $userRequest->question_2='hoge';
    //    $userRequest->question_3='hoge';

    //    $user=User::find(4);
    //    $userResult=$user->fill(['name'=>$userRequest->name])->save();

    //    $profile=Profile::find($user->id);
    //    $profileResult=$profile->fill(['photo'=>$userRequest->photo,'question_1'=>$userRequest->question_1,'question_2'=>$userRequest->question_2,'question_3'=>$userRequest->question_3])->save();

    //     $this->assertTrue($userResult);
    //     $this->assertTrue($profileResult);
    // }

    // public function test_resetPassword(){
    //     User::factory(20)->create();
    //     Profile::factory(20)->create();
    //     Like::factory(20)->create();
    //     Favorite::factory(20)->create();
    //     Bucket_list::factory(20)->create();

    //     $requestResetPassword=new Request();
    //     $requestResetPassword->password='abc';
    //     $user=User::find(4);

    //     $result=$user->fill(['password'=>\Hash::make($requestResetPassword->password)])->save();
    //     dd($user);
    //     assertTrue( $result);
    // }

    public function test_storeFarovite(){
        //insert initial data to table 'likes'.
        $data=[
            ['from_user'=>5,'to_user'=>4],
            ['from_user'=>8,'to_user'=>4],
            ['from_user'=>4,'to_user'=>9],
            ['from_user'=>7 ,'to_user'=>4]];

        Like::insert($data);
        $favoriteRequest=new Request();

        //create requests
        $favoriteRequest->merge(['to_user'=>3]);

        $favoriteRequest->merge([
            'from_user'=>$this->user->id
        ]);

        //Create new records on table 'likes'.
        Favorite::create($favoriteRequest->all());

        //Check if the record ('likes') already exists.
        $result=User::find(9)->is_liked_by_auth();

        //If exists, return null. If not exists, create new record.
        if($result===false){
         $favorite=Favorite::create(['from_user'=>$this->user->id,'to_user'=>11]);
        }else{
         $favorite=null;
        }

        $this->assertNotNull($favorite);
        $this->assertNotEmpty($favorite);
    }

    // public function test_deleteFavorite(){
    //     $favoriteRequest=new Request();
    //     $favoriteRequest->merge(['id'=>3]);

    //     $result=Favorite::find($favoriteRequest->all()['id'])->delete();
    //     $this->assertTrue($result);
    // }

    // public function test_storeLike(){
    //     $likeRequest=new Request();
    //     $likeRequest->merge(['to_user'=>3]);

    //     $likeRequest->merge([
    //         'from_user'=>$this->user->id
    //     ]);

    //     $like=Like::create($likeRequest->all());

    //     $this->assertNotNull($like);
    //     $this->assertNotEmpty($like);
    // }

    // public function test_deleteLike(){
    //     $likeRequest=new Request();
    //     $likeRequest->merge(['id'=>3]);
    //     $like=Like::find($likeRequest->all()['id']);

    //     $result=$like->delete();
    //     $this->assertTrue($result);
    // }
}
