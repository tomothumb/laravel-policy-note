<?php

namespace App\Http\Controllers;

use App\Service\SampleService;
use App\User;

class SampleController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = User::firstOrCreate([
            'name' => 'normal',
            'email' => 'normal@example.com',
            'password' => 'xxxxxxx',
            'role' => User::ROLE_NORMAL,
        ]);
        \Auth::loginUsingId($this->user->id);
    }

    // Passする
    public function sample_allow()
    {
        $this->authorize('allow_sample', new SampleService());
        return "Hello, Allowed Sample.";
    }

    // Error AuthorizationException
    public function sample_deny()
    {
        $this->authorize('deny_sample',new SampleService());
        return "Hello, Denied Sample.";
    }

}
