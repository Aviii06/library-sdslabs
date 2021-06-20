<?php

namespace Model;

class User
{

    public static function checkIfReq($isbn, $email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT count(email) FROM book_stats WHERE isbn= (?) AND email= (?) AND (status = 'Requested' OR status= 'Issued')");
        $stmt->execute([$isbn, $email]);
        $count= $stmt->fetch();
        return $count[0];
    }
    
    public static function issueRequest($isbn, $bname, $email, $status)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("INSERT into book_stats (isbn, bname, email, status, request_date) VALUES (?,?,?,?,?)");
        $date = date('Y-m-d');
        $stmt->execute([$isbn, $bname, $email, $status, $date]);
    }

    public static function userHistory($email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book_stats WHERE email= (?)");
        $stmt->execute([$email]);
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function bookIssue($email)
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from book_stats WHERE email= (?) AND status= 'Issued'");
        $stmt->execute([$email]);
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function bookReturn($oid)
    {
        $db = \DB::get_instance();
        $date = date('Y-m-d');
        $stmt= $db->prepare("UPDATE book_stats SET status= 'Returned' WHERE oid= (?)");
        $stmt->execute([$oid]);

        $stmt2= $db->prepare("UPDATE book_stats SET return_date= (?) WHERE oid= (?)");
        $stmt2->execute([$date, $oid]);
    }
}