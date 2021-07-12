<?php
// require_once 'connect_db.php';
// $FileDir='D:\\xampp\htdocs\shopTest\shopImg\Item1';
// $rootDir = realpath($_SERVER['DOCUMENT_ROOT']);
// $FileNum=count(glob('$FileDir/*.jpg'));
// echo glob('$FileDir/*.jpg');
// print_r(glob('$FileDir/*.jpg')[0]);
// echo $rootDir;

// echo $dir_Num;

// mysqli_free_result($result);
// //資料庫離線
// mysqli_close($connect);
// http://hitsujishop_test.com:6080/shopImg/Item1

// require_once 'connect_db.php';
// header('Content-Type: text/html; charset: utf-8');

// $goodId = '00005';
// $number='1';
// $number= intval($number);

// $sql = 'SELECT*FROM `goods`WHERE `id` = '$goodId'';
// $result = mysqli_query($connect, $sql);
// # code...
// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// $title = $row['title'];
// $set = false;

// if (isset($_COOKIE['cart_' . $goodId])) {
//     $cart_Value_Old = json_decode($_COOKIE['cart_' . $goodId], true);
//     setcookie('cart_' . $goodId, '', time() - 86400, '/');
//     $cart_Value_New = array();
//     $cart_Value_New['item_Id'] = $cart_Value_Old['item_Id'];
//     if ($row['category'] == 'cloth') {
//         $cart_Value_New['size_Qty']['S'] = $cart_Value_Old['size_Qty']['S'];
//         $cart_Value_New['size_Qty']['M'] = $cart_Value_Old['size_Qty']['M'];
//         $cart_Value_New['size_Qty']['L'] = $cart_Value_Old['size_Qty']['L'];
//         $cart_Value_New['size_Qty']['XL'] = $cart_Value_Old['size_Qty']['XL'];
//     } else {
//         $cart_Value_New['size_Qty']['nan'] = $cart_Value_Old['size_Qty']['nan'];;
//     }
//     $new_Qty = $cart_Value_Old['size_Qty']['M'];
//     settype($new_Qty, 'integer');
//     $new_Qty = $new_Qty + $number;

//     $cart_Value_New['size_Qty']['M'] = strval($new_Qty);

//     setcookie('cart_' . $goodId, json_encode($cart_Value_New), time() + 86400, '/');
//     $set = true;
//     // $response = 'already have COOKIE:' . $name;
//     print_r($cart_Value_Old);
//     print_r($cart_Value_New);
//     echo ('\nAllready have' . $new_Qty);

// }

// if ($set == false) {
//     $new_Cart_Item = 'cart_' . $goodId;
//     $cart_Value = array();
//     $cart_Value['item_Id'] = $goodId;
//     if ($row['category'] == 'cloth') {
//         $cart_Value['size_Qty']['S'] ='0';
//         $cart_Value['size_Qty']['M'] = '1';
//         $cart_Value['size_Qty']['L'] = '0';
//         $cart_Value['size_Qty']['XL'] = '0';
//     } else {
//         $cart_Value['size_Qty']['nan'] = '1';
//     }

//     setcookie($new_Cart_Item, json_encode($cart_Value), time() + 86400, '/');
//     print_r($cart_Value);
//     echo ('\nNew');

// }
// mysqli_close($connect);