<?php

namespace Controller;

class Accept
{
    public function post()
    {
        $oid = $_POST["id"];
        \Model\Admin::accept($oid);
        \Model\Fetch::decrease($oid);
    }
}
