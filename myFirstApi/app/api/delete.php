
<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

	
$app->add(new Tuupola\Middleware\CorsMiddleware);





$app->DELETE('/delete.php/{id}', function(Request $request, Response $response, $args){
        require_once 'dbconnect.php';
        $get_id= $request->getAttribute('id');
        $sql="DELETE FROM articles WHERE id = $get_id ";
        $res=$link->query($sql);
        $link->close();
        return $response;
    });

    $app->run();