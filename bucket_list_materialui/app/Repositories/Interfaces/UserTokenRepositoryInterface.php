<?php

namespace App\Repositories\Interfaces;

use App\Models\UserToken;

interface UserTokenRepositoryInterface{
   /**
     *
     * @param int $userId
     * @return UserToken
     */

     public function updateOrCreateToken(int $userId):UserToken;
}
