<?php

namespace App\Controllers;

class AdminController extends BaseController {
    public function getAuthAdmin() {
        include '../views/Admin/login.php';
    }
}