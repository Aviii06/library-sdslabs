<?php

namespace Controller;
session_start();
class BookList
{
    public function get()
    {
        if((isset($_SESSION["id"]))&&($_SESSION["role"]=="user"))
        echo \View\Loader::make()->render("templates/bookList.twig", array(
            "books"=> \Model\Fetch::getAllBooks(),
        ));
        else
        {
            header("Location: /loginUser");
        }
    }

    public function post()
    {
        $search= $_POST["search_book"];
        echo \View\Loader::make()->render("templates/bookList.twig", array(
            "books"=> \Model\Fetch::searchAllBooks($search),
        ));   
    }
}