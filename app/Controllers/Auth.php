<?php

namespace App\Controllers;

use App\Libraries\AppEmail;
use App\Models\UserModel;

class Auth extends BaseController
{
    /**
     * Login.
     */
    public function login()
    {
        if ($this->checkRememberMe()) {
            return redirect()->to('home');
        }
        if ($this->request->getPost('login') && $this->validate('login')) {
            $user = UserModel::where('email', $this->request->getPost('email'))->first();
            // Check if user exist
            if (!$user) {
                alertError('Login or password incorrect!');

                return redirect()->to('login');
            }
            // Check if account is activated
            if ($user->token !== null) {
                alertError('Your account is not active.');

                return redirect()->to('login');
            }
            // Compare input password with stored user password
            if (password_verify($this->request->getPost('password'), $user->password)) {
                $this->rememberMe($user->id);
                $this->setUserSession($user);

                return redirect()->to('home')->withCookies();
            }
            alertError('Login or password incorrect!');
        }

        $this->twig->display('auth/login');
    }

    /**
     * Forgot password.
     */
    public function forgotPassword()
    {
        if ($this->request->getPost('send') && $this->validate('user_email')) {
            $user = UserModel::where('email', $this->request->getPost('email'))->first();
            $user->token = bin2hex(random_bytes(64));
            $user->save();

            $appmail = new AppEmail($this->twig);
            $appmail->resetPasswordEmail($user);

            alertSuccess('Please check your email inbox.');

            return redirect()->to('login');
        }
        $this->twig->display('auth/forgot_password');
    }

    /**
     * Reset forgot password.
     */
    public function resetPassword()
    {
        $user = UserModel::whereNotNull('token')->where('token', $this->request->getGet('token'))->first();

        if (!$user) {
            return redirect()->to('login');
        }

        if ($this->request->getPost('reset_password') && $this->validate('reset_password')) {
            $user->password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $user->token = null;
            $user->save();

            $appmail = new AppEmail($this->twig);
            $appmail->passwordChanged($user);

            alertSuccess('Password changed!');

            return redirect()->to('login');
        }
        $this->twig->display('auth/recovery_password', ['token' => $user->token]);
    }

    /**
     * Logout.
     */
    public function logout()
    {
        session()->destroy();
        delete_cookie('remember_token');
        UserModel::where('id', session()->id)->update(['remember_token' => null]);

        return redirect()->to('login')->withCookies();
    }

    /**
     * Register new user.
     */
    public function register()
    {
        if (!$this->myConfig->register) {
            // Display Error message
//            alertError('Regiser new members not allowed.<br>Please contact administrator', null, ['positionClass' => 'toast-top-center']);
//            return redirect()->to('login');
            // or Show 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if ($this->request->getPost('register') && $this->validate('register')) {
            $user = UserModel::create([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'token' => bin2hex(random_bytes(64)),
                'terms' => $this->request->getPost('terms') ? true : false,
            ]);

            $appmail = new AppEmail($this->twig);
            $appmail->activationEmail($user);

            alertSuccess('Account created successfully.<br> Please check your email inbox.');

            return redirect()->to('login');
        }

        $this->twig->display('auth/register');
    }

    /**
     * Activate the created account.
     */
    public function activation()
    {
        if (!$this->request->getGet('token')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // check token in link
        $user = UserModel::where('token', $this->request->getGet('token'))->first();

        if (!$user) {
            alertError('Some error occurred!');
        } else {
            // active account
            $user->update(['token' => null]);

            alertSuccess('Account activated successfully! Please check Your email inbox.');

            // email to user
            $appmail = new AppEmail($this->twig);
            $appmail->confirmEmail($user);
        }
        // redirect to login
        return redirect()->to('login');
    }

    /**
     * Check remember me.
     */
    private function checkRememberMe()
    {
        $cookie = get_cookie('remember_token');
        if (!$cookie) {
            return;
        }
        $user = UserModel::where('remember_token', $cookie)->first();
        if (!$user) {
            return;
        }
        $this->setUserSession($user);

        return true;
    }

    /**
     * Save user session.
     */
    private function setUserSession(object $user)
    {
        session()->set([
            'id' => $user->id,
            'name' => $user->full_name,
            'email' => $user->email,
            'isLoggedIn' => true,
        ]);
    }

    /**
     * Remember Me.
     */
    private function rememberMe(int $id)
    {
        $user = UserModel::find($id);
        $random_string = bin2hex(random_bytes(64));
        set_cookie('remember_token', $random_string, 2678400);
        $user->remember_token = $random_string;
        $user->save();
    }
}
