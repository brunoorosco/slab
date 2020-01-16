<?php

namespace Source\Controllers;

use Source\Models\FuncionarioModel;

class App extends Controller
{
    /** @var FuncionarioModal   */
    protected $user;

    public function __construct($router)
    {
        parent::__construct($router);
        if (empty($_SESSION["user"]) || !$this->user = (new FuncionarioModel())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);
           
            flash("error", "Acesso negado!");
            $this->router->redirect("web.login");
        }
    }

    public function home(): void
    {
        $head = $this->seo->optimize(
            "Bem vind@ {$this->user->Nome} | ". site("name"), //title
            site("desc"), //descrição
            $this->router->route("app.home"), //url
            routeImage("Home") //image
        )->render(); //transforma tudo em string

        echo $this->view->render("home", [
             "head" => $head ,
             "user" => $this->user
        ]);
    }


    public function logoff()
    {
        unset($_SESSION['user']);

        flash("info", "Você saiu comm sucesso, volte logo {$this->user->Nome}");

        $this->router->redirect("web.login");
    }
}
