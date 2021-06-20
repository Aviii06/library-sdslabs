<?php

namespace Controller;

session_start();
class Checkout
{
    public function post()
    {
        $data = $_POST["book"];

        for ($i = 0; $i < count($data); $i++) {
            $isbn = $data[$i];

            $row = \Model\Fetch::findBook($isbn);
            $bname = $row[0]["bname"];
            $email = $_SESSION["email"];

            $check = \Model\User::checkIfReq($isbn, $email);

            if ($check == 0) {
                $status = "Requested";

                \Model\User::issueRequest($isbn, $bname, $email, $status);
            }
        }
    }
}
