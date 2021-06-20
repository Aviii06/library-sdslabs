<?php

namespace Model;

class Auth
{
    public static function checkUserIfPresent($email)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(email) from user WHERE email= (?)");
        $check->execute([$email]);
        $count = $check->fetch();
        return $count[0];
    }

    public static function checkAdminIfPresent($email)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(email) from admin WHERE email= (?)");
        $check->execute([$email]);
        $count = $check->fetch();
        return $count[0];
    }

    public static function loginUser($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from user WHERE email= (?)");
        $stmt->execute([$email]);
        $data = $stmt->fetch();
        return $data;
    }

    public static function loginAdmin($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from admin WHERE email= (?)");
        $stmt->execute([$email]);
        $data = $stmt->fetch();
        return $data;
    }
}
