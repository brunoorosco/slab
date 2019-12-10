<?php

require __DIR__ . "/vendor/autoload.php";



$route = new \CoffeeCode\Router\Router(ROOT);

// Conectar com o banco de dados
if ($_SERVER['SERVER_NAME'] == 'localhost')
    require './Source/Config/config_dev.php';
else
    require './Source/Config/config_prod.php';
session_start();

Db::conectar($dbname, $user, $password, $host);

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
$route->post("/login/{email}", "Web:home");

$route->group("etiqueta");
$route->get("/","Atendimento:etiqueta");
$route->get("/busca","Atendimento:buscaEtiqueta");
/**
 * web
 * Atendimento de empresas
 */
$route->group("atendimento");
$route->get("/", "Atendimento:atendimento");
$route->get("/plano", "Atendimento:plano");
$route->post("/plano", "Atendimento:imprimirPlano");
$route->post("/", "WebEmpresa:buscar");

/**
 * web
 * Empresa
 */
$route->group("empresa");
$route->get("/", "WebEmpresa:empresa");
$route->get("/add", "WebEmpresa:incluir");
$route->post("/add", "WebEmpresa:adicionar");
$route->put("/edit/{id}", "WebEmpresa:editar");
$route->post("/excluir", "WebEmpresa:excluir");
$route->get("/{id}/editar", "WebEmpresa:editar");
//$route->post("/busca/?{id}","WebEmpresa:buscar");

$route->group("autocomplete");
$route->get("/?", "WebEmpresa:buscar");
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