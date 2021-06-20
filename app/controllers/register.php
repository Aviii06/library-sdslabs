<?php

namespace Controller;

class Register
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig");
    }
    public function post()
    {

        $role = $_POST["role"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];

        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            $epwd = crypt($pwd, $salt);
        }



        if ($role == "admin") {
            $check = \Model\Register::check_admin_if_already_present($email);
            if ($check == 0) {
                \Model\Register::create_admin($name, $phone, $email, $epwd);

                echo \View\Loader::make()->render("templates/register.twig", array(
                    "posted" => true,
                ));
            } else {
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "exists" => true,
                ));
            }
        }
        else
        if ($role == "user") 
        {
            $check = \Model\Register::check_user_if_already_present($email);
            if ($check == 0) {
                \Model\Register::create_user($name, $phone, $email, $epwd);

                echo \View\Loader::make()->render("templates/register.twig", array(
                    "posted" => true,
                ));
            } else {
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "exists" => true,
                ));
            }
        }
    }
}
