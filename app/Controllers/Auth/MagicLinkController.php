<?php

namespace App\Controllers\Auth;

use App\Controllers\FrontendController;
use CodeIgniter\Shield\Models\UserModel;

class MagicLinkController extends FrontendController
{
    /**
     * @var UserModel
     */
    protected $provider;

    public function __construct()
    {
        helper('setting');

        /** @var class-string<UserModel> $providerClass */
        $providerClass = setting('Auth.userProvider');

        $this->provider = new $providerClass();
    }
    
    /**
     * Displays the view to enter their email address
     * so an email can be sent to them.
     *
     * @return RedirectResponse|string
     */
    public function loginView()
    {
        if (! setting('Auth.allowMagicLinkLogins')) {
            return redirect()->route('login')->with('error', lang('Auth.magicLinkDisabled'));
        }

        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        return view(setting('Auth.views')['magic-link-login'], $this->web);
    }
}
