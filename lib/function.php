<?php
// database initilize
$db = mysqli_connect("localhost","root","root","db_ibooks");
mysqli_set_charset($db,"utf8");

class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "জানুয়ারী", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "অগাস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্ব্যার");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}
// total_price function Starts //
function _2boughtprice(){
    global $db;
    $total = 0;
    $query = "SELECT `price` FROM `tbl_books` WHERE buy_priority=1";
    $result = mysqli_query($db,$query);
    while($record=mysqli_fetch_array($result)){
        $sub_total = $record['price'];
        $sub_total = BanglaConverter::bn2en($sub_total);
        $sub_total = intval($sub_total);
        $total += $sub_total;
    }
    echo BanglaConverter::en2bn($total);
}

// total price of recently bought books.
function boughtprice(){
    global $db;
    $total = 0;
    $query = "SELECT `discount` FROM `tbl_books` WHERE buy_priority=2";
    $result = mysqli_query($db,$query);
    while($record=mysqli_fetch_array($result)){
        $sub_total = $record['discount'];
        $sub_total = BanglaConverter::bn2en($sub_total);
        $sub_total = intval($sub_total);
        $total += $sub_total;
    }
    echo BanglaConverter::en2bn($total);
}
// function to detairmain total price
function totalprice(){
    global $db;
    $total = 0;
    $query = "SELECT `price` FROM `tbl_books` WHERE status=1";
    $result = mysqli_query($db,$query);
    while($record=mysqli_fetch_array($result)){
        $sub_total = $record['price'];
        $sub_total = BanglaConverter::bn2en($sub_total);
        $sub_total = intval($sub_total);
        $total += $sub_total;
    }
    echo BanglaConverter::en2bn($total);
}

function sepComma($name){
    return explode(',', $name);
}
?>