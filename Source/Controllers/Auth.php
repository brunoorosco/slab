<?php

namespace Source\Controllers;

use Source\Models\User;

class Auth extends Controller
{
    /** @param $router
     * 
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param $data 
     * */
    public function register($data)
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar-se"
            ]);
            return;
        }
        $user = new User();

        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("app.home")
        ]);
    }
}
