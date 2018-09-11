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
$map->get('loginForm', '/login', [
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

$map->get('loginAdmin', '/admin', [
    'controller'    => 'App\Controllers\AdminController',
    'action'        => 'getAuthAdmin'
]);
$map->post('authAdmin', '/authAdmin', [

]);
$map->get('addUser', '/users/add', [
    'controller'    => 'App\Controllers\UsersController',
    'action'        => 'getAddUser'
]);
$map->post('saveUser', '/users/save', [
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

    $sessionUserId = $_SESSION['userId'] ?? null;
    if ($needsAuth && !$sessionUserId) {
        header('Location: /');
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
