<?php

namespace Controller;
session_start();
class ViewBook
{
    public function get()
    {
        if((isset($_SESSION["id"]))&&($_SESSION["role"]=="admin"))
        echo \View\Loader::make()->render("templates/viewBook.twig", array(
            "books"=> \Model\Fetch::getAllBooks(),
        ));
        else
        {
            header("Location: /loginAdmin");
        }
    }

    public function post()
    {
        $search= $_POST["search_book"];
        echo \View\Loader::make()->render("templates/viewBook.twig", array(
            "books"=> \Model\Fetch::searchAllBooks($search),
        ));   
    }
}