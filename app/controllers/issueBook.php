<?php

namespace Controller;

class IssueBook
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/issue.twig", array(
            "issues"=> \Model\Admin::getRequests(),
        ));
    }

}