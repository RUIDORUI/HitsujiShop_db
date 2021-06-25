<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");
session_start();

if (isset($_SESSION['accountName'])){
    $accountName = $_SESSION['accountName'];
    $sql = "SELECT `name`,`password`,`gender`,`email`,`phone`,`address` FROM`account`WHERE `name` = '{$accountName}'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $password = $row['password'];
    $gender = $row['gender'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    
    $data = "<form method='POST' class='revise_Form' id='revise_Form' action='javascript:checkAccount()'>
    <h1>Revise Information</h1>
    <div class='revise_Field'>

        <div class='inputWrapper'>
            <h4 class='revise_FormTitle'>Account Name：</h4>
            <input class='revise_Input' type='text' name='input_AccountName' id='input_AccountName' placeholder='Enter Your Name' value='{$name}' required>
            <div class='input_Error' id='name_Error'>Accountname has been used</div>
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>Password：</h4>
            <input class='revise_Input' type='password' name='input_Password' id='input_RevisePassword' placeholder='Enter Your Password' value='{$password}' required>
            <i class='bi bi-eye-fill' id='toggle_Revise'></i>
            <div class='input_Error' id='password_Error'>Your Password doesn't match Confirm Password</div>
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>Confirm Password：</h4>
            <input class='revise_Input' type='password' name='input_ConfirmPass' id='input_ConfirmPass' placeholder='Confirm Your Password' value='{$password}' required>
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>Gender</h4>";

    if($gender=='M'){
        $data.=" <div class='checkboxWrapper'>
                    <label for='input_Male'>Male
                    <input type='radio' name='input_Gender' id='input_Male' value='M' checked>
                    </label>
                    <label for='input_Female'>
                        Female 
                        <input type='radio' name='input_Gender' id='input_Female' value='F'>
                    </label>

                </div>";
    }
    else if($gender=='F'){
        $data.=" <div class='checkboxWrapper'>
                    <label for='input_Male'>Male
                    <input type='radio' name='input_Gender' id='input_Male' value='M'>
                    </label>
                    <label for='input_Female'>
                        Female 
                        <input type='radio' name='input_Gender' id='input_Female' value='F' checked>
                    </label>

                </div>";
    }
    $data.="
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>E-mail：</h4>
            <input class='revise_Input' type='email' name='input_Email' id='input_Email' placeholder='Enter Email' value='{$email}' required>
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>Phone Number：</h4>
            <input class='revise_Input' type='number' name='input_Phone' id='input_Phone' placeholder='Enter Phone Number' value='{$phone}' required>
        </div>
        <div class='inputWrapper'>
            <h4 class='sign_FormTitle'>Address：</h4>
            <input class='revise_Input' type='text' name='input_Address' id='input_Address' placeholder='Enter Address' value='{$address}' required>
        </div>
        <button id='revise_Reset' onclick='toRvisePage()'>Reset</button>
        <button id='revise_Submit' type='submit' >Confirm Revise</button>


    </div>
</form>";


echo($data);
}