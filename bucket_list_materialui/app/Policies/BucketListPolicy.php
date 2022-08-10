<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bucket_list;
use Illuminate\Auth\Access\HandlesAuthorization;

class BucketListPolicy
{
	use HandlesAuthorization;

	/**
	 * Check if the user ($user->id) is the same as the owner of Bucket_list($bucket_list->user_id)
	 * @param \App\Models\User
	 * @param \App\Models\Bucket_list
	 * @return void
	 */
	public function checkUser(User $user,Bucket_list $bucket_list)
	{
          return  $user->id===$bucket_list->user_id;

	}
}
