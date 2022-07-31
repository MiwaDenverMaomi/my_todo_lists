<?php

namespace App\Repositories\Eloquents;

use App\Models\UserToken;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;

class UserTokenRepository implements UserTokenRepositoryInterface{
  private $userToken;
   /**
     * constructor
     *
     * @param UserToken $userToken
     */

  public function __contruct(UsserToken $userToken){
    $this->userToken=$userToken;
  }
   /**
     * @inheritDoc
     */
}
