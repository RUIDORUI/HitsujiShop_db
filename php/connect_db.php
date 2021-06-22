<?php
    date_default_timezone_set('Asia/Taipei');
    $user = 'root';
    $password = '';
    $host = '127.0.0.1';
    $db = 'shop';
    $port = '3306';

    //連結sql資料庫
    $connect = mysqli_connect($host,$user,$password);

    if($connect){
        //獲得shop資料庫
        mysqli_select_db($connect,$db);

        //讓字元顯示正確
        mysqli_query($connect,"SET NAMES 'UTF8'");
        mysqli_query($connect,"SET CHARACTER_SET_CLIENT = 'UTF8'");
        mysqli_query($connect,"SET CHARACTER_SET_RESULT = 'UTF8'");
        // echo 'connect db Shop success';

    }
    else{
        echo 'connect db Shop failed';
    }