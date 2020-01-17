<?php

namespace Source\Controllers;

class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (!empty($_SESSION["user"])) {
            $this->router->redirect('app.home');
        }
    }

    public function login(): void
    {
        $head = $this->seo->optimize(
            "Faça login para continuar " . site("name"), //title
            site("desc"), //descrição
            $this->router->route("web.login"), //url
            routeImage("Login") //image          
        )->render(); //transforma tudo em string

        echo $this->view->render("theme/login", [
            "head" => $head,
            "title" => "Login"
        ]);
    }

    public function register($data): void
    {
        $head = $this->seo->optimize(
            "Crie sua conta no " . site("name"), //title
            site("desc"), //descrição
            $this->router->route("web.register"), //url
            routeImage("Register") //image
            //image
        )->render(); //transforma tudo em string

        $form_user = new \stdClass(); //cria uma classe anonima
        $form_user->first_name = null;
        $form_user->last_name = null;
        $form_user->email = null;

        echo $this->view->render("theme/register", [
            "head" => $head,
            "user" => $form_user
        ]);
    }
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recupere sua senha " . site("name"), //title
            site("desc"), //descrição
            $this->router->route("web.forget"), //url
            routeImage("Forget") //image
        )->render(); //transforma tudo em string

        echo $this->view->render("theme/forget", [
            "head" => $head
        ]);
    }
    public function reset($data): void
    {
        $head = $this->seo->optimize(
            "Crie sua nova senha " . site("name"), //title
            site("desc"), //descrição
            $this->router->route("web.reset"), //url
            routeImage("Reset")
        )->render(); //transforma tudo em string

        echo $this->view->render("theme/reset", [
            "head" => $head
        ]);
    }
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
        $head = $this->seo->optimize(
            "Ooooopsss {$error} | " . site("name"), //title
            site("desc"), //descrição
            $this->router->route("web.error", ["errcode" => $error]), //url
            routeImage($error)
        )->render(); //transforma tudo em string

        echo $this->view->render("theme/error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}
