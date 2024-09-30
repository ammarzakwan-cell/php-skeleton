<?php

namespace App\Controllers;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    /**
     * Set up controllers to have access to the container.
     *
     * @param \Interop\Container\ContainerInterface $container
     */
    public function __construct(protected Container $c)
    {
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        return $this->c->get('view')->render($response, $template, $data);
    }

}
