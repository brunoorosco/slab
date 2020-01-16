<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use CoffeeCode\Optimizer\Optimizer;
use League\Plates\Engine;


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
        $this->view = Engine::create(dirname(__DIR__, 1)."/Views","php");
       
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(site("name"),site("locale"),"article");
        // ->publisher("","")
        // ->twitterCard(" "," "," ")
        // ->facebook(" ");
    }

    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}
