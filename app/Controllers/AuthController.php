<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function getLogin() {
        include '../views/Auth/login.php';
    }

    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        /*$user = User::where('email', $postData['email'])->first();
        if($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                header('Location: /');
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }*/

        if (password_verify($postData['password'], password_hash('123456', PASSWORD_DEFAULT))) {
            $_SESSION['userId'] = 2;
            header('Location: /');
            exit;
        } else {
            $responseMessage = 'Bad credentials';
        }

        header('Location: /login?message='. $responseMessage);

    }

    public function getLogout() {
        unset($_SESSION['userId']);
        header('Location: /login');
    }

    public function getSignUp() {
        include '../views/Auth/register.php';
    }
}