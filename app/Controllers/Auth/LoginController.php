<?php

namespace App\Controllers\Auth;

use App\Controllers\FrontendController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Validation\ValidationRules;

class LoginController extends FrontendController
{

    protected $helpers = ['setting'];
    
    public function __construct()
    {
        $this->web['title'] = 'EbyKarya';
    }

    public function dashboard_page()
    {
        $user = auth()->user();
        $this->web['user'] = $user;
        $this->web['data'] = $user->toRawArray();
        return view(setting('Auth.views')['dashboard'], $this->web);
    }

    public function login_page()
    {
        helper('form');
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }

        $api_google = new \Google_Client();
        $api_google->setClientId(GOOGLE_CLIENT_ID);
        $api_google->setClientSecret(GOOGLE_CLIENT_SECRET);
        $api_google->setRedirectUri(GOOGLE_REDIRECT_URI);
        $api_google->addScope('email');
        $api_google->addScope('profile');
        $api_google->setAccessType('offline');
        $api_google->setPrompt('select_account consent');
        $api_google->setIncludeGrantedScopes(true);

        $this->web['google_url'] = $api_google->createAuthUrl();

        return view(setting('Auth.views')['login'], $this->web);
    }

    public function login_proses()
    {
        
    }

    public function login_google_proses()
    {
        $api_google = new \Google_Client();
        $api_google->setClientId(GOOGLE_CLIENT_ID);
        $api_google->setClientSecret(GOOGLE_CLIENT_SECRET);
        $api_google->setRedirectUri(GOOGLE_REDIRECT_URI);
        $api_google->addScope('email');
        $api_google->addScope('profile');
        $api_google->setAccessType('offline');
        $api_google->setPrompt('select_account consent');
        $api_google->setIncludeGrantedScopes(true);

        $code = $this->request->getvar('code');
        $scope = $this->request->getvar('scope');
        $authuser = $this->request->getvar('authuser');
        $prompt = $this->request->getvar('prompt');
        if($code)
        {
            $token = $api_google->fetchAccessTokenWithAuthCode($code);
            $api_google->setAccessToken($token);
            session()->access_token = $token['access_token'];

            if($api_google->isAccessTokenExpired()) {
                $api_google->fetchAccessTokenWithRefreshToken($api_google->getRefreshToken());
            }

            $google_oauth = new \Google_Service_Oauth2($api_google);
            $userinfo = $google_oauth->userinfo->get();
            $user_data = [
                'google_id' => $userinfo->id,
                'email' => $userinfo->email,
                'name' => $userinfo->name,
                'picture' => $userinfo->picture,
            ];

            $users = new Users();
            $data = $users->where('google_id', $userinfo->id)->find();
            if(!$data)
            {
                if( $users->insert($user_data) ){
                    $user_data['group'] = 1;
                    session()->auth = $user_data;
                    return redirect()->to('/user/dashboard');
                }
            }else{
                session()->auth = $user_data;
                return redirect()->to('/user/dashboard');
            }
        }
    }

    public function logout(){
        $url = config('Auth')->logoutRedirect();

        auth()->logout();

        return redirect()->to($url)->with('message', lang('Auth.successLogout'));
    }
}
