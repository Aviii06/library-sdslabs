<?php
namespace Controller;
session_start();
class Admin{
    public function get()
    {
        if((isset($_SESSION["id"]))&&($_SESSION["role"]=="admin"))
        echo \View\Loader::make()->render("templates/admin.twig");
        else
        {
            header("Location: /loginAdmin");
        }
        
    }
}