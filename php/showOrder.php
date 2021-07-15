<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");
session_start();

if (isset($_SESSION['accountName'])) {
    $accountName = $_SESSION['accountName'];
    $level = $_SESSION['level'];
    $sql = "SELECT `id` FROM`account`WHERE `name` = '{$accountName}'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $accountid = $row['id'];

    if ($level = 'administrator') {
        $sql = "SELECT `serial`,`item`,`payment`,`time` FROM`order_list` WHERE  `status`='nonshipped'";
    } else {
        $sql = "SELECT `serial`,`item`,`payment`,`time` FROM`order_list` WHERE JSON_EXTRACT(member_Sender_Id, '$.account_Id')='{$accountid}' AND `status`='nonshipped'";
    }

    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);
    if ($num !== 0) {

        $response = "<div class='tableWrapper'>
                        <h2 class='section_Title'>Not Shipped Order</h2>
                        <table class='Cart_Table'>
                            <thead>
                                <tr class='table_Header_Row'>
                                    <th class='table_Header'>Order Number</th>
                                    <th class='table_Header'>Item&Size&Qty</th>
                                    <th class='table_Header'>Payment</th>
                                    <th class='table_Header'>Total</th>
                                    <th class='table_Header'>Order Time</th>
                                    <th class='table_Header'>Edit</th>
                                </tr>
                            </thead>
                            <tbody>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $serial = $row['serial'];
            $item_List = json_decode($row['item'], true);
            $split_Time = explode(' ', $row['time']);
            $split_Time = $split_Time[0];
            // $time = explode('-', $split_Time);
            $payment = $row['payment'];
            if ($payment == 'Cash') {
                $payment = 'Cach on Delivery';
            } else if ($payment == 'Card') {
                $payment = 'Credit Card';
            }

            $response .= "<tr class='table_Data_Row'>
                                <td class='table_Data'>{$serial}</td>
                                <td class='table_Data'>";
            $total = 0;
            foreach ($item_List as $key => $value) {
                $key = strval($key);
                $item_Sql = "SELECT `title`,`price` FROM `goods` WHERE  `id` = '{$item_List[$key]['item']}'";
                $item_Result = mysqli_query($connect, $item_Sql);
                $item_Row = mysqli_fetch_assoc($item_Result);
                $response .= "<p>{$item_Row['title']}";
                $single_Price = intval($item_Row['price']);
                foreach ($item_List[$key]['size_Qty'] as $size => $qty) {
                    # code...
                    if ($size == "nan") {
                        $response .= " * " . $qty . ",";
                    } else {
                        $response .= $size . " * " . $qty . ',';
                    }

                    $total = $total + $single_Price * intval($qty);
                }
                $response .= "</p>";
            }

            $response .= "
                                </td>
                                <td class='table_Data'>{$payment}</td>
                                <td class='table_Data'>\${$total}</td>
                                <td class='table_Data'> {$split_Time}</td>

                                <td class='table_Data'>
                                    <button class='revise_Btn' data-serial='{$serial}' data-active='revise'>Revise</button>
                                </td>
                            </tr>";
        }
        $response .= "</tbody>
                </table>
            </div>";
    } else {
        $response = "<div class='tableWrapper'>
                        <h2 class='section_Title'>Shipped Order</h2>
                        <h3>No Orders</h3>
                       </div>";
    }
// SELECT Shipped Order
    if ($level = 'administrator') {
        $sql = "SELECT `serial`,`item`,`payment`,`time` FROM`order_list` WHERE  `status`='shipped'";
    } else {
        $sql = "SELECT `serial`,`item`,`payment`,`time` FROM`order_list` WHERE JSON_EXTRACT(member_Sender_Id, '$.account_Id')='{$accountid}' AND `status`='shipped'";
    }

    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);
    if ($num !== 0) {

        $response .= "<div class='tableWrapper'>
                        <h2 class='section_Title'>Shipped Order</h2>
                        <table class='Cart_Table'>
                            <thead>
                                <tr class='table_Header_Row'>
                                    <th class='table_Header'>Order Number</th>
                                    <th class='table_Header'>Item&Size&Qty</th>
                                    <th class='table_Header'>Payment</th>
                                    <th class='table_Header'>Total</th>
                                    <th class='table_Header'>Order Time</th>
                                    <th class='table_Header'>Edit</th>
                                </tr>
                            </thead>
                            <tbody>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $serial = $row['serial'];
            $item_List = json_decode($row['item'], true);
            $split_Time = explode(' ', $row['time']);
            $split_Time = $split_Time[0];
            // $time = explode('-', $split_Time);
            $payment = $row['payment'];
            if ($payment == 'Cash') {
                $payment = 'Cach on Delivery';
            } else if ($payment == 'Card') {
                $payment = 'Credit Card';
            }

            $response .= "<tr class='table_Data_Row'>
                                <td class='table_Data'>{$serial}</td>
                                <td class='table_Data'>";
            $total = 0;
            foreach ($item_List as $key => $value) {
                $key = strval($key);
                $item_Sql = "SELECT `title`,`price` FROM `goods` WHERE  `id` = '{$item_List[$key]['item']}'";
                $item_Result = mysqli_query($connect, $item_Sql);
                $item_Row = mysqli_fetch_assoc($item_Result);
                $response .= "<p>{$item_Row['title']}";
                $single_Price = intval($item_Row['price']);
                foreach ($item_List[$key]['size_Qty'] as $size => $qty) {
                    # code...
                    if ($size == "nan") {
                        $response .= " * " . $qty . ",";
                    } else {
                        $response .= $size . " * " . $qty . ',';
                    }

                    $total = $total + $single_Price * intval($qty);
                }
                $response .= "</p>";
            }

            $response .= "
                                </td>
                                <td class='table_Data'>{$payment}</td>
                                <td class='table_Data'>\${$total}</td>
                                <td class='table_Data'> {$split_Time}</td>

                                <td class='table_Data'>
                                    <button class='revise_Btn' data-serial='{$serial}' data-active='detail' >Detail</button>
                                </td>
                            </tr>";
        }
        $response .= "</tbody>
                </table>
            </div>";
    } else {
        $response .= "<div class='tableWrapper'>
                        <h2 class='section_Title'>Shipped Order</h2>
                        <h3>No Shipped Orders</h3>
                       </div>";
    }

    echo $response;
}