<?php

namespace App\Policies;

use App\User;
use App\License;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function view(User $user, License $license)
    {
        // 誰でも確認できる
        return true;
    }

    /**
     * Determine whether the user can create licenses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // 試験場のみが免許証を発行できる
        return $user->isGovernment();
    }

    /**
     * Determine whether the user can update the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function update(User $user, License $license)
    {
        // 試験場(政府)か警察官なら更新できる
        return $user->isGovernment() || $user->isPolice();
    }

    /**
     * Determine whether the user can delete the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function delete(User $user, License $license)
    {
        // 試験場(政府)なら無条件で。警察官ならその免許証が0点になれば免許取り消しになる。
        return $user->isGovernment() || ($user->isPolice() && $license->point <= 0);
    }
}
