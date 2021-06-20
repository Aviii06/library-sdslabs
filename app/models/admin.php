<?php

namespace Model;

class Admin
{

    public static function checkBookExists($isbn)
    {
        $db = \DB::get_instance();
        $check = $db->prepare("SELECT count(isbn) FROM book WHERE isbn= (?)");
        $check->execute([$isbn]);
        $count= $check->fetch();
        return $count[0];
    }

    public static function addBook($bname, $author, $genre, $isbn, $pages, $publisher, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO book (bname, author, genre, isbn, pages, publisher, quantity) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$bname, $author, $genre, $isbn, $pages, $publisher, $quantity]);
    }

    public static function getAllUsers()
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from user ORDER BY id");
        $stmt->execute();
        $rows=$stmt->fetchAll();
        return $rows;
    }

    public static function getAllAdmin()
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * from admin ORDER BY id");
        $stmt->execute();
        $rows=$stmt->fetchAll();
        return $rows;
    }

    public static function userLog()
    {
        $db= \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM book_stats LEFT JOIN user ON book_stats.email=user.email ORDER BY book_stats.oid ");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function getRequests()
    {
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM book_stats LEFT JOIN book ON book_stats.isbn=book.isbn LEFT JOIN user ON book_stats.email= user.email WHERE book_stats.status= 'Requested' ORDER BY book_stats.oid");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows;
    }

    public static function accept($oid)
    {
        $db = \DB::get_instance();
        $date = date('Y-m-d');
        $stmt= $db->prepare("UPDATE book_stats SET status= 'Issued' WHERE oid= (?)");
        $stmt->execute([$oid]);

        $stmt2= $db->prepare("UPDATE book_stats SET issue_date= (?) WHERE oid= (?)");
        $stmt2->execute([$date, $oid]);
    }

    public static function reject($oid)
    {
        $db = \DB::get_instance();
        $stmt= $db->prepare("UPDATE book_stats SET STATUS= 'Rejected' WHERE oid= (?)");
        $stmt->execute([$oid]);
    }

}