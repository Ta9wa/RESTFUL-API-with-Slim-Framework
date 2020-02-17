<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
//use Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface;
//use Tuupola\Middleware\HttpBasicAuthentication;
require __DIR__ . '/../../../vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

	
//$app->add(new Tuupola\Middleware\CorsMiddleware);
//$app->add(new Tuupola\Middleware\HttpBasicAuthentication);

/*class RandomAuthenticator implements AuthenticatorInterface {
    public function __invoke(array $arguments): bool {
        return (bool)rand(0,1);
    }
}*/
/*$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "admin" => "root",
        
    ],
    "realm" => "Protected",
    "secure" => false,
    "path" => '/login.php',
    "error" => function ($request, $response, $arguments) {
        $data = [];
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
    }
    ]));*/

$app->post('/login.php',function(Request $request, Response $response, $args)
    {
        require_once 'dbconnect.php';
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $lid=$request->getParsedBody()['login'];
        $pwd=$request->getParsedBody()['mdp'];
        //mysql_select_db("slim_db");
        $sql='SELECT login,mdp FROM auth WHERE login = "'.$lid.'" and mdp= "'.$pwd.'" ' ;
        //var_dump($sql);
        $res = $link->query($sql);
        //var_dump($res); 
        while($row=$res->fetch_assoc())
        {
            $data[]=$row;
        }
        if(isset($data)){
        echo ("succes !");
        }else echo"errer";
        return $response;
    });








$app->run();

