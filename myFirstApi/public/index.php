<?php
declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;
require __DIR__ . '/../../vendor/autoload.php';
require_once '../app/api/dbconnect.php';
//require_once '../app/api/articles.php';
//require_once '../app/api/articles.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/public");



$app->get('/', function (Request $request, Response $response, $args) {
	echo 'helloo';
    return $response;
});

/*$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});*/

$app->run();
