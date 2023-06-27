<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use ZiffMedia\LaravelOnelogin\Controllers\OneloginController as ControllersOneloginController;

class OneLoginController extends ControllersOneloginController
{
    public function login(Request $request, AuthManager $auth)
    {
        if (! isset($request->code_challenge)) {
            return response("O parâmetro 'code_challenge' é obrigatório", 400);
        }

        Cache::put($request->code_challenge, $request->code_challenge);

        $redirect = $this->getRedirectUrl($request, true);

        if (app()->isLocal() && config('app.debug') && config('onelogin.user.local_dev_user.enable')) {
            $user = $this->resolveLocalUser();

            $auth->guard($this->guard)->login($user);

            return redirect($redirect);
        }

        // prevent logged in users from triggering a onelogin saml flow
        if ($request->user($this->guard)) {
            return redirect($redirect);
        }

        $url = null;

        try {
            $url = $this->oneLogin->login($redirect, [], false, false, true);
        } catch (\Error $errorException) {
            abort(500, 'Onelogin URL Generation error: ' . $errorException->getMessage());
        }

        return redirect($url);
    }


    
}
