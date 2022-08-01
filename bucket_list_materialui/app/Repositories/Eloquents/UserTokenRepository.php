<?php

namespace App\Repositories\Eloquents;

use App\Models\UserToken;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserTokenRepository implements UserTokenRepositoryInterface{
  private $userToken;
   /**
     * constructor
     *
     * @param UserToken $userToken
     */

  public function __construct(UserToken $userToken){
    $this->userToken=$userToken;
  }
   /**
     * @inheritDoc
     */
   public function updateOrCreateUserToken(int $userId):UserToken
   {
    $now=Carbon::now();
    $provitionalToken=hash('sha256',$userId,'');
    return $this->userToken->updateOrCreate(
      [
        'user_id'=>$userId,
      ],
      [
        'token'=>uniqid(rand(),$provitionalToken),
        'expire_at'=>$now->addHours(48)->toDateTimeString(),
      ]);
   }

    /**
     * @inheritDoc
     */

     public function getUserTokenFromToken(string $token):UserToken{
      return $this->userToken->where('token',$token)->firstOrFail();
     }
}
