<?php

namespace Model;

class Register
{

    #checks if email id already present in database
    public static function checkUserIfAlreadyPresent($email)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(email) from user WHERE email= (?)");
        $check->execute([$email]);
        $count = $check->fetch();
        return $count[0];
    }

    public static function checkAdminIfAlreadyPresent($email)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(email) from admin WHERE email= (?)");
        $check->execute([$email]);
        $count = $check->fetch();
        return $count[0];
    }

    #inserts user into table user
    public static function createUser($name, $phone, $email, $pwd)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO user (name, phone, email, pwd) VALUES (?,?,?,?)");
        $stmt->execute([$name, $phone, $email, $pwd]);
    }

    #inserts admin into table admin
    public static function createAdmin($name, $phone, $email, $pwd)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO admin (name, phone, email, pwd) VALUES (?,?,?,?)");
        $stmt->execute([$name, $phone, $email, $pwd]);
    }
}
