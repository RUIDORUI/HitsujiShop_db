<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");
session_start();

if (isset($_SESSION['accountName'])) {
    $accountName = $_SESSION['accountName'];
    $sql = "SELECT `name`,`password`,`gender`,`email`,`phone`,`address` FROM`account`WHERE `name` = '{$accountName}'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    echo ("
    <div class='accountInfor_Field'>
        <h1>Member Information</h1>
        <ul class='inputWrapper'>
            <li class='infor_Title'><span>Account Name：</span>
                <span class='infor_Text'>{$row['name']} </span>
            </li>
            <li class='infor_Title'><span>Password：</span>
                <span class='infor_Text'>{$row['password']}</span>
            </li>
            <li class='infor_Title'><span>Gender：</span>
                <span class='infor_Text'>{$row['gender']}</span>
            </li>
            <li class='infor_Title'><span>E-mail：</span>
                <span class='infor_Text'>{$row['email']}</span>
            </li>
            <li class='infor_Title'><span>Phone：</span>
                <span class='infor_Text'>{$row['phone']}</span>
            </li>
            <li class='infor_Title'><span>Address：</span>
                <span class='infor_Text'>{$row['address']}</span>
            </li>

            <div class='inforBtnWrapper'>
                <button id='infor_Back' onclick='location.href=`http://hitsujishop_test.com:6080/hitsuji.html`'>Back</button>
                <button id='infor_Revise' onclick='toRvisePage()'>Revise Information</button>
            </div>

        </ul>

    </div>");
}