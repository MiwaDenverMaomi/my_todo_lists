<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
  private $user;
  /**
     * constructor
     *
     * @param User $user
     */
  public function __construct(User $user){
    $this->user=$user;
  }

   /**
     * @inheritDoc
     */
  public function findFromEmail(string $email):User{
    return $this->user->where('email',$email)->firstOrFail();
  }
}
