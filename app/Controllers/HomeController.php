<?php

namespace App\Controllers;

class HomeController extends BaseController {
    public function indexAction() {

        include '../views/index.php';
    }
}