<?php
// require_once 'connect_db.php';
$FileDir="D:\\xampp\htdocs\shopTest\shopImg\Item1";
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
$FileNum=count(glob("$FileDir/*.jpg"));
// echo glob("$FileDir/*.jpg");
// print_r(glob("$FileDir/*.jpg")[0]);
echo $rootDir;

// echo $dir_Num;

// mysqli_free_result($result);
// //資料庫離線
// mysqli_close($connect);
// http://hitsujishop_test.com:6080/shopImg/Item1