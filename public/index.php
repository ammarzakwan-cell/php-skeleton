<?php

define('ROOT_PATH', dirname(__DIR__));

use App\Exceptions\Handler;
use DI\DependencyException;
use DI\NotFoundException;
use Slim\Factory\AppFactory;
use Twig\Loader\FilesystemLoader;

require_once ROOT_PATH . '/vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    error_log($e->getMessage());
}

require_once ROOT_PATH . '/database/database.php';

$container = new DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set('view', function () {
    $loader = new FilesystemLoader(ROOT_PATH . '/resources/views');
    return new Slim\Views\Twig($loader, [
        'cache' => false,
    ]);
});

$errorMiddleware = $app->addErrorMiddleware(false, true, true);
try {
    $errorMiddleware->setDefaultErrorHandler(new Handler(
        $app->getResponseFactory(),
        $container->get('view')
    ));
} catch (DependencyException|NotFoundException $e) {
    error_log($e->getMessage());
}

require_once ROOT_PATH . '/routes/web.php';

$app->run();
