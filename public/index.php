<?php
require __DIR__ . "/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/loginUser" => "\Controller\LoginUser",
    "/loginAdmin" => "\Controller\LoginAdmin",
    "/register" => "\Controller\Register",
    "/admin" => "\Controller\Admin",
    "/user" => "\Controller\User",
    "/logout" => "\Controller\Logout",
    "/addBook" => "\Controller\AddBook",
    "/viewBook" => "\Controller\ViewBook",
    "/viewUser" => "\Controller\ViewUser",
    "/bookList" => "\Controller\BookList",
    "/checkout" => "\Controller\Checkout",
    "/userHist" => "\Controller\UserHistory",
    "/userLog" => "\Controller\UserLog",
    "/issueBook" => "\Controller\IssueBook",
    "/accept" => "\Controller\Accept",
    "/reject" => "\Controller\Reject",
    "/return" => "\Controller\BookReturn"
));