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
$route->get("/orcamento","Web:orcamento");
$route->get("/etiqueta","Web:etiqueta");
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