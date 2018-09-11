<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;

/**
 * Class UsersController
 * @package App\Controllers
 */
class UsersController extends BaseController {
    /**
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function getAddUser() {
        return $this->renderHTML('addUser.twig');
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