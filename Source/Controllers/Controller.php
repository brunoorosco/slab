<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Router\Router;
use CoffeCode\Optimizer\Optimizer;


abstract class Controller
{
    /** @var Engine */
    protected $view;

    /** @var Router */
    protected $router;

    /** @var Optimizer */
    protected $seo;

    public function __construct($router)
    {
        $this->router = $router;
        //$this->view = Engine::create(dirname(__DIR__, 2)."/Views","php");
        $this->view = Engine::create(__DIR__ . "/../Views/theme", "php");
        $this->view->addData(["router" => $this->router]);

        //$this->seo = new Optimizer();
    }

    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}
