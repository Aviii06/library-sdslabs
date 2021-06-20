<?php

namespace Controller;
session_start();
class ViewUser
{
    public function get()
    {
        if((isset($_SESSION["id"]))&&($_SESSION["role"]=="admin"))
        echo \View\Loader::make()->render("templates/viewUser.twig", array(
            "users"=> \Model\Admin::getAllUsers(),
            "admins"=> \Model\Admin::getAllAdmin(),
        ));
        else
        {
            header("Location: /loginAdmin");
        }
    }
}