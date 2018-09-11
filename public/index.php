<?php

/*======================================================
=  INICIANDO VARIABLES PARA MOSTRAR TODOS LOS ERRORES  =
======================================================*/

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

/*===== INCIANDO VARIABLES DE SESSION =====*/
session_start();


$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();


/*======================================================
=   INCIANDO CONECCION A LA DATABASE CON ELOQUENT      =
======================================================*/

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => getenv('DB_DRIVER'),
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    'port'      => getenv('DB_PORT')
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

/*======================================================
=         INICIANDO RESPUESTA CON DIACTOROS            =
======================================================*/

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

/*======================================================
=                   DEFINIENDO RUTAS                   =
======================================================*/

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

/*============ RUTAS DE USUARIO ============*/

$map->get('index', '/', [
    'controller'    => 'App\Controllers\HomeController',
    'action'        => 'indexAction'
]);
$map->get('login', '/login', [
    'controller'    => 'App\Controllers\AuthController',
    'action'        => 'getLogin'
]);
$map->get('logout', '/logout', [
    'controller'    => 'App\Controllers\AuthController',
    'action'        => 'getLogout'
]);
$map->get('register', '/register', [
    'controller'    => 'App\Controllers\AuthController',
    'action'        => 'getSignUp'
]);
$map->post('auth', '/auth', [
    'controller'    => 'App\Controllers\AuthController',
    'action'        => 'postLogin'
]);


/*============ RUTAS DE ADMIN ============*/

$map->get('admin.index', '/admin/home', [
   'controller'     => 'App\Controllers\AdminController',
   'action'         => 'getIndex',
   'admin'           => true
]);
$map->get('admin.login', '/admin/login', [
    'controller'    => 'App\Controllers\AdminController',
    'action'        => 'getLoginAdmin'
]);
$map->post('admin.auth', '/admin/auth', [
    'controller'    => 'App\Controllers\AdminController',
    'action'        => 'postAuthAdmin'
]);
$map->get('admin.logout', '/admin/logout', [
   'controller'     => 'App\Controllers\AdminController',
   'action'         => 'getLogout'
]);
$map->get('admin.addUser', '/admin/users/add', [
    'controller'    => 'App\Controllers\UsersController',
    'action'        => 'getAddUser'
]);
$map->post('admin.saveUser', 'admin//users/save', [
    'controller'    => 'App\Controllers\UsersController',
    'action'        => 'postSaveUser'
]);



$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

/*======================================================
=      ENVIO DE ERRORES Y PROTECCION DE RUTAS          =
======================================================*/

if (!$route) {
    echo 'No se encuentra la ruta o no esta definida';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;
    $justAdmin = $handlerData['admin'] ?? false;

    $sessionUserId = $_SESSION['userId'] ?? null;
    $sessionAdminId = $_SESSION['adminId'] ?? null;
    if ($needsAuth && !$sessionUserId) {
        header('Location: /');
    } elseif ($justAdmin && !$sessionAdminId){
        header('Location: /admin/login');
    }

    $controller = new $controllerName;
    $response = $controller->$actionName($request);

    /*foreach($response->getHeaders() as $name => $values)
    {
        foreach($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();*/

    /*===== ENVIANDO RESPUESTA =====*/
    echo $response;

}
