<?php

namespace Controller;

class UserLog
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/userLog.twig", array(
            "orders"=> \Model\Admin::userLog(),
        ));
    }
}