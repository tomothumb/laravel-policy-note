<?php

namespace App\Policies;

use App\Service\SampleService;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SamplePolicy
{
    use HandlesAuthorization;

    public function allow_sample(User $user, SampleService $sampel_service)
    {
        return $sampel_service->returnTrue();
    }

    public function deny_sample(User $user, SampleService $sampel_service)
    {
        return $sampel_service->returnFalse();
    }

}
