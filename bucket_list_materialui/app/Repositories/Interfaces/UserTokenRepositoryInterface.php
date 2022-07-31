<?php

namespace App\Repositories\Interfaces;

use App\Models\UserToken;

interface UserTokenRepositoryInterface
{
   /**
     *
     * @param int $userId
     * @return UserToken
     */

     public function updateOrCreateUserToken(int $userId):UserToken;
}
