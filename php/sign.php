<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");
switch ($_GET['do']) {
    case 'create':
        # code...
        $account_Name = $_REQUEST['input_AccountName'];
        $account_Password = $_REQUEST['input_Password'];
        $gender = $_REQUEST['input_Gender'];
        $email = $_REQUEST['input_Email'];
        $phone = $_REQUEST['input_Phone'];
        $address = $_REQUEST['input_Address'];

        $sql = "INSERT INTO `account` (`name`,`password`,`gender`,`email`,`phone`,`address`)VALUES(";
        $sql .= "'{$account_Name}','{$account_Password}','{$gender}','{$email}','{$phone}','{$address}')";
        // echo "'{$account_Name} + {$account_Password} + {$gender} + {$email} + {$phone} + {$address}'";
        // echo $sql;

        $result = mysqli_query($connect, $sql);
        // if ($result) {echo 'inserted';} else {echo 'insert failed';}
        echo $result;
        // mysqli_free_result($result);
        //資料庫離線
        mysqli_close($connect);
        break;

    case 'update':
        session_start();
        $oldName = $_SESSION['accountName'];
        $new_Name = $_REQUEST['input_AccountName'];
        $new_Password = $_REQUEST['input_Password'];
        $new_Gender = $_REQUEST['input_Gender'];
        $new_Email = $_REQUEST['input_Email'];
        $new_Phone = $_REQUEST['input_Phone'];
        $new_Address = $_REQUEST['input_Address'];

        $sql = "UPDATE `account` SET`name` = '{$new_Name}',`password` = '{$new_Password}',`gender` = '{$new_Gender}',`email` = '{$new_Email}',`phone` = '{$new_Phone}',`address` = '{$new_Address}'WHERE`name` = '{$oldName}'";

        $result = mysqli_query($connect, $sql);

        echo $result;
        // mysqli_free_result($result);
        //資料庫離線
        mysqli_close($connect);

        break;
    case 'delete':
        break;
    case 'select':
        break;
    case 'signIn':
        $input_Name = $_REQUEST['signIn_Account'];
        $input_Password = $_REQUEST['signIn_Password'];
        $sql = "SELECT `name`,`password`,`level` FROM `account` WHERE `name` = '{$input_Name}'";
        $result = mysqli_query($connect, $sql);
        // print_r($result);
        // echo $sql;
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $response = array('accountName' => 'This Account Name is not exist.', 'result' => 'false');
            echo json_encode($response);

            mysqli_free_result($result);
            //資料庫離線
            mysqli_close($connect);
            break;
        }
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            session_start();
            $_SESSION['accountName'] = $input_Name;
            $_SESSION['signed'] = 'true';
            $_SESSION['level'] = $row[2];
            if ($row[0] == $input_Name && $row[1] == $input_Password) {
                $response = array('accountName' => "{$input_Name}", 'result' => 'true', 'session' => $_SESSION['accountName'], 'signed' => $_SESSION['signed']);

                echo json_encode($response);

            } else if ($row[0] == $input_Name && $row[1] !== $input_Password) {
                $response = array('accountName' => 'Wrong Password.', 'result' => 'name_False');
                echo json_encode($response);

            }

        }

        mysqli_free_result($result);
        //資料庫離線
        mysqli_close($connect);

        break;
    case 'logOut':
        session_start();
        unset($_SESSION['accountName']);
        unset($_SESSION['signed']);
        echo 'Log Out';

        break;

    default:
        # code...
        break;
}