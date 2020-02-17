<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

	
$app->add(new Tuupola\Middleware\CorsMiddleware);

$app->get('/categorie.php', function (Request $request, Response $response, $args) {
    require_once 'dbconnect.php';
    
    $sql='SELECT * FROM categorie;';
    $res = $link->query($sql);
    //var_dump($res);
    
    while($row=$res->fetch_assoc()) {
        $data[] = $row;
    }
    if (isset($data)) {
        echo json_encode($data);
    }
    $link->close();
    return  $response;
    
    });



$app->run();
