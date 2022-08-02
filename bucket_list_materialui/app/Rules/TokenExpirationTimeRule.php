<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;

class TokenExpirationTimeRule implements Rule
{
    /**
     * Check if the expiration date of token is expired.
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function __construct()
    {
        $now=Carbon::now();
        $userTokenReposigory=app()->make(UserTokenRepositoryRepository::class);
        $userToken=$userTokenRepository->getUserTokenFromToken($value);
        $expireTime=new Carbon($userToken->expire_at);
        return $now->lte($expireTime);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return 'This link is expired. Send the email to reset password again.'
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
