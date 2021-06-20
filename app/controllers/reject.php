<?php

namespace Controller;

class Reject
{
    public function post()
    {
        $oid= $_POST["id"];
        \Model\Admin::reject($oid);
    }
}