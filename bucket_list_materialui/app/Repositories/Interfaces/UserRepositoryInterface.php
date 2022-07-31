<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
  /**
   *
   * @param string
   * @return User
   */
  public function findFromEmail(string $email):User;
}
