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

    /**
     * Update the password of the user (in argument)
     *
     * @param string $password
     * @param int $id
     * @return void
     */

  public function updateUserPassword(string $password,int $id):void;
}
