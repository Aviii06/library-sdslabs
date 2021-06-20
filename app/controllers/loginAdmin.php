<?php

namespace Controller;
session_start();

class LoginAdmin{
    public function get()
    {
        echo \View\Loader::make()->render("templates/loginAdmin.twig");
    }

    public function post()
    {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        $check = \Model\Auth::checkAdminIfPresent($email);

        if($check==0)
        {
            echo \View\Loader::make()->render("templates/loginAdmin.twig", array(
                "notExists" => true,
            ));
        }
        else
        {
            $data= \Model\Auth::loginAdmin($email);
            if(crypt($pwd,$data["pwd"])==$data["pwd"])
            {
                $_SESSION["role"]="admin";
                $_SESSION["id"]=$data["id"];
                $_SESSION["name"]=$data["name"];
                $_SESSION["email"]=$data["email"];
                header("Location: /admin");
            }
            else
            {
                echo \View\Loader::make()->render("templates/loginAdmin.twig", array(
                    "wrongPwd" => true,
                ));
            }
        }
    }
}