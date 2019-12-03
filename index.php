<?php

require __DIR__ . "/vendor/autoload.php";

$route = new \CoffeeCode\Router\Router(ROOT);

/**
 * APP
 */
$route->namespace("Source\Controllers");

/**
 * web
 */
$route->group(null);
//$route->get("/", "Web:home");
$route->get("/", "Web:home");
$route->get("/contato", "Web:contact");
$route->get("/teste", "Web:layout");
$route->get("/login", "Web:layout");

$route->group("etiqueta");
$route->get("/","Web:etiqueta");
$route->get("/busca","Web:buscaEtiqueta");
/**
 * web
 * Atendimento de empresas
 */
$route->group("atendimento");
$route->get("/", "Atendimento:atendimento");
<<<<<<< HEAD
$route->get("/plano", "Atendimento:plano");
=======
$route->get("/plano", "Atendimento:imprimirPlano");
>>>>>>> fef7d235439f03b2290f9f0af242ee7d6428b6f4
$route->post("/plano", "Atendimento:imprimirPlano");

/**
 * web
 * Empresa
 */
$route->group("empresa");
$route->get("/", "WebEmpresa:empresa");
$route->get("/add", "WebEmpresa:adicionar");
$route->post("/add", "WebEmpresa:adicionar");
$route->put("/edit", "WebEmpresa:editar");

/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/**
 * PROCESS
 */
$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}