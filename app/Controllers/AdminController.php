<?php

namespace App\Controllers;

use App\Models\AdminUser;
use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;

class AdminController extends BaseController {

    public function getIndex()
    {
        $users = User::all();
        $admins = AdminUser::all();
        include '../views/Admin/index.php';
    }

    public function getLoginAdmin()
    {
        include '../views/Admin/login.php';
    }

    public function postAuthAdmin($request)
    {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        /*$user = AdminUser::where('email', $postData['email'])->first();
        if($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['adminId'] = $user->id;
                return new RedirectResponse('/admin/home');
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }*/
            if (password_verify($postData['password'], password_hash('123456', PASSWORD_DEFAULT))) {
                $_SESSION['adminId'] = 1;
                header('Location: /admin/home');
            } else {
                $responseMessage = 'Bad credentials';
                header('Location: /admin/login?message='. $responseMessage);
            }

    }

    public function getLogout()
    {
        session_destroy();
        header('Location: /admin/login');
    }
}