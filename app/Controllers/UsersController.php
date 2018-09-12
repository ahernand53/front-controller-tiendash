<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;

/**
 * Class UsersController
 * @package App\Controllers
 */
class UsersController extends BaseController {

    public function getRegister() {
        include '../views/Auth/register.php';
    }

    /**
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function postRegister($response) {

        $postData = $response->getParsedBody();
        $message = null;

        $user = new User();
        $user->name = $postData['name'];
        $user->lastName = $postData['lastName'];
        $user->email = $postData['email'];
        $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $user->phone = $postData['phone'];
        $user->address = $postData['address'];
        $user->card = $postData['card'];
        $comprobar = $user->save();

        if($comprobar){
            header('Location: /login');
            exit;
        }

        $message = 'Error al validar los datos por favor, Corregir';
        header('Location: /register?message='. $message);

    }

    /**
     * @param $request
     *
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function postSaveUser($request) {
        $postData = $request->getParsedBody();

        // Validation here

        $user = new User();
        $user->email = $postData['email'];
        $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $user->save();
        return $this->renderHTML('addUser.twig');
    }
}