<?php 




require 'vendor/autoload.php';

use controllers\SearchController;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
        'displayErrorDetails' => true,

]];
$app = new \Slim\App($config);


//$aaa = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
//__construct ($dsn, $username, $passwd, $options) {}

//$aaa = new PDO('mysql:host=127.0.01:dbname=wih_local;port=2200','root', 'root', []);
//$aaa = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
//var_dump($aaa);
//exit;






$app->get('/search/words', function ($request, $response, $args) {

    $searchController = new SearchController($request);
    return $response->withJson($searchController->searchWords());

});


// Define app routes
//$app->get('/shit', function ($request, $response, $args) {
//    echo 'words in histo';exit;
//});



// Define app routes
// $app->get('/', function () {
//    echo 'words in history api.';
// });


//$app->get('/search/words/books', function ($request, $response, $args) {
//    $searchController = new SearchController();
//    return $response->withJson($searchController->searchWordsByBooks($request));
//});
//$app->get('/search/words/people', function ($request, $response, $args) {
//    $searchController = new SearchController();
//    return $response->withJson($searchController->searchWordsByPeople($request));
//});
//$app->get('/search/words/songs', function ($request, $response, $args) {
//    $searchController = new SearchController();
//    return $response->withJson($searchController->searchWordsBySongs($request));
//});
//$app->get('/search/words/films', function ($request, $response, $args) {
//    $searchController = new SearchController();
//    return $response->withJson($searchController->searchWordsByFilms($request));
//});








$app->run();