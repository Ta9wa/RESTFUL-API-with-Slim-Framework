<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/slimapp/myFirstApi/myFirstApi/app/api");
$app->addBodyParsingMiddleware();

$app->add(new Tuupola\Middleware\CorsMiddleware);

$app->get('/articles.php', function (Request $request, Response $response, $args) {
    require_once 'dbconnect.php';
    
    $sql='SELECT * FROM articles;';
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

  

    
    
    /*$app->post('/add',function(Request $request, Response $response, $args){
        require_once 'dbconnect.php';
        $sql='INSERT INTO articles (id,nom,prix,libille,stock,articlescol) VALUES (?,?,?)';
        $res=$link->prepare($sql);
        $res->bind_param($i,$n,$p,$l,$s,$c);

        $i=$request->getParsedBody()['id'];
        $n=$request->getParsedBody()['nom'];
        $p=$request->getParsedBody()['prix'];
        $l=$request->getParsedBody()['libille'];
        $s=$request->getParsedBody()['stock'];
        $c=$request->getParsedBody()['articlescol'];
        $res->execute();
        return $response;
    });*/

$app->run();
