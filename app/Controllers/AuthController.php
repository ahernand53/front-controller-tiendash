<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class AuthController
 * @package App\Controllers
 */
class AuthController extends BaseController {
    /**
     *
     */
    public function getLogin() {
        include '../views/Auth/login.php';
    }

    /**
     * @param $request
     */
    public function postLogin($request)
    {
        $postData = $request->getParsedBody();
        $responseMessage = null;
        var_dump($postData);
        $user = User::where('email', $postData['email'])->first();
        if($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                header('Location: /');
                exit;
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }


        header('Location: /login?message='. $responseMessage);

    }

    /**
     *
     */
    public function getLogout()
    {
        unset($_SESSION['userId']);
        header('Location: /login');
    }

    /**
     *
     */
    public function getSignUp() {
        include '../views/Auth/register.php';
    }
}