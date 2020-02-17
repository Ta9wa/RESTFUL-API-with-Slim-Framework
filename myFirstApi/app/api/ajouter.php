<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

	
//$app->add(new Tuupola\Middleware\CorsMiddleware);
//$app->add(new Tuupola\Middleware\HttpBasicAuthentication);



    
    $app->post('/ajouter.php',function(Request $request, Response $response, $args){
        require_once 'dbconnect.php';
        $no=$request->getParsedBody()['nom'];
        $n=$request->getParsedBody()['categorie'];
        $p=$request->getParsedBody()['prix'];
        $l=$request->getParsedBody()['description'];
        $q=$request->getParsedBody()['quantite'];
        $sql='INSERT INTO articles (nom,categorie,prix,description,quantite) VALUES (?,?,?,?,?)';
        $res=$link->prepare($sql);
        $res->bind_param('ssdsd',$no,$n,$p,$l,$q);
        $res->execute();
        $link->close();
        
    return $response;
    });
    
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
    
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
                ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
    
    

$app->run();
