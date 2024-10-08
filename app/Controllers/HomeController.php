<?php

namespace App\Controllers;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class HomeController extends Controller
{
    /**
     * Render the home page
     *
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return Response
     */
    public function index(Request $request, Response $response, $args): Response
    {
        return $this->render($response, 'home/index.twig', [
            'appName' => 'hardcoded',
        ]);
    }
}
