<?php

namespace App\Controllers;

use App\Models\AdminUser;
use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;

class AdminController extends BaseController {

    /**
     * Funcion que llama a la pagina inicial de administradores
     * Obligatorio estar logeado antes de entrar a este metodo
     */
    public function getIndex()
    {
        $users = User::all();
        $admins = AdminUser::all();
        include '../views/Admin/index.php';
    }

    /**
     * Funcion para llamar la pagina de login de administradores
     */
    public function getLoginAdmin()
    {
        include '../views/Admin/login.php';
    }

    /**
     * @param $request
     *
     * Funcion que hace el login de administradores,
     * Se verifica si existe y redirecciona a la pagina de
     * home de los administradores
     *
     */
    public function postAuthAdmin($request)
    {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        $user = AdminUser::where('email', $postData['email'])->first();
        if($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['adminId'] = $user->id;
                header('Location: /admin/home');
                exit;
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }

        header('Location: /admin/login?message=' . $responseMessage);

    }

    /**
     * Funcion para cerrar session de un usuario administrador
     * Elimina la variables de session y redirecciona
     * a la funcion getLoginAdmin
     */
    public function getLogout()
    {
        session_destroy();
        header('Location: /admin/login');
    }
}