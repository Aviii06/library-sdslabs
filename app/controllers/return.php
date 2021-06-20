<?php

namespace Controller;
session_start();
class BookReturn
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/return.twig", array(
            "issues"=> \Model\User::bookIssue($_SESSION["email"]),
        ));
    }

    public function post()
    {
        $oid= $_POST["id"];
        \Model\User::bookReturn($oid);
        \Model\Fetch::increase($oid);
    }
}