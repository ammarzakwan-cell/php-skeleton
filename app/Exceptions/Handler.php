<?php

namespace App\Exceptions;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use Throwable;

class Handler
{
    public function __construct(protected ResponseFactoryInterface $response, protected $view)
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param Throwable $throwable
     * @return mixed
     * @throws Throwable
     */
    public function __invoke(ServerRequestInterface $request, Throwable $throwable): mixed
    {
        if (method_exists($this, $handler = 'handle' . (new ReflectionClass($throwable))->getShortName())) {
            return $this->{$handler}($request);
        }

        throw $throwable;
    }

    /**
     * Undocumented function
     *
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function handleHttpNotFoundException(ServerRequestInterface $request): mixed
    {
        return $this->view->render(
            $this->response->createResponse(),
            'errors/404.twig'
        )->withStatus(404);
    }
}
