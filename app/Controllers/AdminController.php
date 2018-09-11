<?php

namespace App\Controllers;

use App\Models\AdminUser;
use Zend\Diactoros\Response\RedirectResponse;

class AdminController extends BaseController {

    public function getIndex()
    {
        include '../views/Admin/index.php';
    }

    public function getLoginAdmin()
    {
        include '../views/Admin/login.php';
    }

    public function postAuthAdmin()
    {
        $postData = $_POST;
        var_dump($postData);
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
                return new RedirectResponse('/admin/home');
            } else {
                $responseMessage = 'Bad credentials';
            }

    }
}