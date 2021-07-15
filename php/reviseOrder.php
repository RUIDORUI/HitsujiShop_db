<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");

$newsenderName = $_REQUEST['input_SenderName'];
$senderPhone = $_REQUEST['input_SenderPhone'];
$senderEmail = $_REQUEST['input_SenderEmail'];
$senderAddress = $_REQUEST['input_SenderAddress'];
$senderPayment = $_REQUEST['input_Payment'];
$serial = $_GET['serial'];

$sql = "SELECT`member_Sender_Id`FROM `order_list`WHERE `serial`='{$serial}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$sender_Name = json_decode($row['member_Sender_Id'], true);
$sender_Name['sender_Name'] = $newsenderName;
$new_SenderName_Array = json_encode($sender_Name);

$sql = "UPDATE `order_list` SET `member_Sender_Id` = '{$new_SenderName_Array}',`phone` = '{$senderPhone}',`email` = '{$senderEmail}',`address` = '{$senderAddress}',`payment` = '{$senderPayment}'WHERE`serial` = '{$serial}'";

$result = mysqli_query($connect, $sql);

echo $sql;
// mysqli_free_result($result);
//資料庫離線
mysqli_close($connect);