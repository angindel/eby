<?php

namespace App\Controllers\Auth;

use App\Controllers\FrontendController;

class RegisterController extends FrontendController
{
    protected $helpers = ['setting'];
    
    public function __construct()
    {
        $this->web['title'] = 'EbyKarya';
    }

    public function register_page()
    {
        return view(setting('Auth.views')['register'], $this->web);
    }
}
