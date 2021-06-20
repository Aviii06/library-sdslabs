<?php

namespace Controller;
session_start();
class LoginUser{
    public function get()
    {
        echo \View\Loader::make()->render("templates/loginUser.twig");
    }

    public function post()
    {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        $check = \Model\Auth::checkUserIfPresent($email);

        if($check==0)
        {
            echo \View\Loader::make()->render("templates/loginUser.twig", array(
                "notExists" => true,
            ));
        }
        else
        {
            $data= \Model\Auth::loginUser($email);
            if(crypt($pwd,$data["pwd"])==$data["pwd"])
            {
                $_SESSION["role"]="user";
                $_SESSION["id"]=$data["id"];
                $_SESSION["name"]=$data["name"];
                $_SESSION["email"]=$data["email"];
                header("Location: /user");
            }
            else
            {
                echo \View\Loader::make()->render("templates/loginUser.twig", array(
                    "wrongPwd" => true,
                ));
            }
        }
    }
}