<?php

namespace App\Controllers;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends BaseController {
    /**
     * Funcion de la pagina incial
     */
    public function indexAction() {

        include '../views/index.php';
    }
}