<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
	use HandlesAuthorization;

	 /**
	 * Check if the user($user->id) is the same as the owner of profile ($profie->user_id)
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Profile  $profile
	 * @return bool
	 */
	public function checkUser(User $user,Profile $profile){
		return $user->id===$profile->user_id;
	}
}
