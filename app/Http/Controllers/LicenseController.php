<?php

namespace App\Http\Controllers;

use App\License;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LicenseController extends Controller
{
    public $user;
    public $license;

    private function setupNormal(){
        $this->user = User::firstOrCreate([
            'name' => 'normal',
            'email' => 'normal@example.com',
            'password' => 'xxxxxxx',
            'role' => User::ROLE_NORMAL,
        ]);
        \Auth::loginUsingId($this->user->id);
    }
    private function setupGovernment(){
        $this->user = User::firstOrCreate([
            'name' => 'gov',
            'email' => 'gov@example.com',
            'password' => 'xxxxxxx',
            'role' => User::ROLE_GOVERNMENT,
        ]);
        \Auth::loginUsingId($this->user->id);
    }
    private function setupPolice(){
        $this->user = User::firstOrCreate([
            'name' => 'pol',
            'email' => 'pol@example.com',
            'password' => 'xxxxxxx',
            'role' => User::ROLE_POLICE,
        ]);
        \Auth::loginUsingId($this->user->id);
    }

    private function attachLicense(){
        $this->license = License::firstOrCreate([
            'user_id' => $this->user->id,
            'point' => 15,
            'address' => "日本のどこそこ",
        ]);
    }

    private function pointZero(){
        $this->license->point = 0;
        $this->license->save();
    }

    /**
     * 一般ユーザ：閲覧権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function indexNormal(){
        $this->setupNormal();
        $this->attachLicense();
        $this->authorize('view', $this->license);
        return '成功';
//        if ($this->user->can('view', $this->license)) {
//            return '成功';
//        }
//        return '失敗';
    }

    /**
     * 一般ユーザ：作成権限なし
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createNormal(){
        $this->setupNormal();
        $this->authorize('create', License::class); // ここで終わり
        return '成功';
    }
    /**
     * 一般ユーザ：更新権限なし
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateNormal(){
        $this->setupNormal();
        $this->attachLicense();
        $this->authorize('update', $this->license); // ここで終わり
        return '成功';
    }
    /**
     * 一般ユーザ：削除権限なし
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteNormal(){
        $this->setupNormal();
        $this->attachLicense();
        $this->authorize('delete', $this->license); // ここで終わり
        return '成功';
    }

    /**
     * スーパーユーザ：閲覧権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function indexGovernment(){
        $this->setupGovernment();
        $this->attachLicense();

        $this->authorize('view', $this->license);
        return '成功';
    }
    /**
     * スーパーユーザ：作成権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createGovernment(){
        $this->setupGovernment();
        $this->authorize('create', License::class);
        return '成功';
    }
    /**
     * スーパーユーザ：更新権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateGovernment(){
        $this->setupGovernment();
        $this->attachLicense();
        $this->authorize('update', $this->license);
        return '成功';
    }
    /**
     * スーパーユーザ：削除権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteGovernment(){
        $this->setupGovernment();
        $this->attachLicense();
        $this->authorize('delete', $this->license);
        return '成功';
    }

    /**
     * 一部許可ユーザ：閲覧権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function indexPolice(){
        $this->setupPolice();
        $this->attachLicense();
        $this->authorize('view', $this->license);
        return '成功';
    }
    /**
     * 一部許可ユーザ：作成権限なし
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createPolice(){
        $this->setupPolice();
        $this->authorize('create', License::class);
        return '成功';
    }

    /**
     * 一部許可ユーザ：更新権限あり
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updatePolice(){
        $this->setupPolice();
        $this->attachLicense();
        $this->authorize('update', $this->license);
        return '成功';
    }

    /**
     * 一部許可ユーザ：削除権限条件付きであり。この場合はエラー
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deletePolice(){
        $this->setupPolice();
        $this->attachLicense();
        $this->authorize('delete', $this->license); // ここで終わり
        return '成功';
    }

    /**
     * 一部許可ユーザ：削除権限条件付きであり。この場合はOK
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deletePoliceAfterZeroPoint(){
        $this->setupPolice();
        $this->attachLicense();
        $this->pointZero();
        $this->authorize('delete', $this->license);
        return '成功';
    }

}
