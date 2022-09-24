<?php
/**
 * Index de notre site, permet de l'initialiser.
 * 
 * @category Gallerie
 * @package  Src
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

session_start();

require_once "Vendors/Autoload.php";

//var_dump($_GET);
//var_dump($_POST);

$request = new \Dialog\Request($_GET, $_POST, $_FILES, $_SERVER);
$response = new \Dialog\Response();
$authentificationManager = new \Managers\AuthentificationManager($request);
$accessManager = new \Managers\AccessManager();




$router = new \Routers\Router(
    $request, 
    $response, 
    $authentificationManager, 
    $accessManager
);
$front_controller = new \Controllers\FrontController($router);


$front_controller->main();
