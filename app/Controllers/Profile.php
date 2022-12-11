<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $user = userModel::find(session()->id);
        $this->twig->display('profile/index', compact('user'));
    }

    public function update()
    {
        $user = userModel::find(session()->id);
        $rules = [
            'name' => ['label' => 'Full name', 'rules' => 'required|min_length[3]|max_length[20]'],
        ];
        $user->name = $this->request->getPost('name');
        if ($this->request->getPost('password') != null) {
            $rules['password'] = ['label' => 'Password', 'rules' => 'required|min_length[8]|max_length[255]'];
            $rules['confirm_password'] = ['label' => 'Confirm password', 'rules' => 'matches[password]'];
            $user->password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->validate($rules)) {
            $user->save();
            alertSuccess('Profile Updated!');

            return redirect()->to('profile');
        }

        return redirect()->back()->withInput();
    }
}
