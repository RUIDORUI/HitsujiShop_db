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

        break;
    case 'delete':
        break;
    case 'select':
        break;
    case 'signIn':
        $input_Name = $_REQUEST['signIn_Account'];
        $input_Password = $_REQUEST['signIn_Password'];
        $sql = "SELECT `name`,`password` FROM `account` WHERE `name` = '{$input_Name}'";
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
            if ($row[0] == $input_Name && $row[1] == $input_Password) {
                $response = array('accountName' => "{$input_Name}", 'result' => 'true');
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
    default:
        # code...
        break;
}