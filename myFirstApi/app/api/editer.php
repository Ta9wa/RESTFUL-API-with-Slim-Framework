
<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

	
//$app->add(new Tuupola\Middleware\CorsMiddleware);




    $app->put('/editer.php/{id}', function(Request $request, Response $response, $args ){

     require_once 'dbconnect.php';

            $get_id = $request->getAttribute('id');

            $nom_article = $request->getParsedBody()['nom'];
            $categorie_article = $request->getParsedBody()['categorie'];
            $prix_article = $request->getParsedBody()['prix'];
            $description_article = $request->getParsedBody()['description'];
            $quantite_article = $request->getParsedBody()['quantite'];

     $sql = "UPDATE articles SET nom = ?,categorie = ?, prix = ?, description = ?, quantite = ? WHERE  id = $get_id";

     $stmt = $link->prepare($sql);

     $stmt->bind_param('ssdsd',$nom_article,$categorie_article, $prix_article, $description_article,$quantite_article);
     
     $stmt->execute();
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