<?php

require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");
$name = $_REQUEST['input_AccountName'];
$do = $_GET['do'];

switch ($do) {
    case 'create':
        # code...
        $sql = "SELECT*FROM `account` WHERE `name` = '{$name}'";
        // $sql = "SELECT*FROM `account` WHERE `name` LIKE 'JOJO'";

        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_row($result);

        if (gettype($row) == 'array') {
 
            // mysqli_close($connect);
            // mysqli_free_result($result);
            echo 'false';
        } else {
            mysqli_close($connect);
            echo 'true';

        }
        break;
    case 'update':
         # code...
         $sql = "SELECT*FROM `account` WHERE `name` = '{$name}'";
         // $sql = "SELECT*FROM `account` WHERE `name` LIKE 'JOJO'";
 
         $result = mysqli_query($connect, $sql);
         $row = mysqli_fetch_assoc($result);

         if (gettype($row) == 'array') {

            // mysqli_close($connect);
            // mysqli_free_result($result);
            echo $row['name'];
        } else {
            mysqli_close($connect);
            echo $row['name'];

        }
        break;
    default:
        # code...
        break;
}

//資料庫離線