<?php
require_once "connect_db.php";
header("Content-Type: text/html; charset: utf-8");

switch ($_GET['do']) {
    case 'cart':
        $goodId = $_GET['cartId'];


        $sql = "SELECT*FROM `goods`WHERE `id` = '$goodId'";
        $result = mysqli_query($connect, $sql);
        # code...
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $title = $row['title'];
        $set = false;

        
        if (isset($_COOKIE['cart_' . $goodId])) {
            $cart_Value_Old = json_decode($_COOKIE['cart_' . $goodId], true);
            setcookie('cart_' . $goodId, "", time() - 86400, '/');
            $cart_Value_New = array();
            $cart_Value_New['item_Id'] = $cart_Value_Old['item_Id'];

            $new_Qty = $cart_Value_Old['qty'];
            settype($new_Qty, "integer");
            $new_Qty = $new_Qty + 1;
            // strval($new_Qty);
            // $new_Qty = ;
            $cart_Value_New['qty'] = strval($new_Qty);

            if ($row['category'] == 'cloth') {
                $cart_Value_New['size'] = 'M';
            } else {
                $cart_Value_New['size'] = 'NaN';
            }
            setcookie('cart_' . $goodId, json_encode($cart_Value_New), time() + 86400, '/');
            $set = true;
            // $response = 'already have COOKIE:' . $name;
            print_r($cart_Value_Old);
            print_r($cart_Value_New);
            echo ("\nAllready have" . $new_Qty);
            break;
        }

        if ($set == false) {
            $new_Cart_Item = 'cart_' . $goodId;
            $cart_Value = array();
            $cart_Value['item_Id'] = $goodId;
            $cart_Value['qty'] = '1';
            if ($row['category'] == 'cloth') {
                $cart_Value['size'] = 'M';
            } else {
                $cart_Value['size'] = 'NaN';
            }
            setcookie($new_Cart_Item, json_encode($cart_Value), time() + 86400, '/');
            print_r($cart_Value);
            echo ("\nNew");

        }
        // $response =   json_decode($_COOKIE[$new_Cart_Item],true);

        break;
    case 'show_Cart':
        $total = 0;
        $response = "<div class='tableWrapper'>
                        <h2 class='table_Title'>Cart List</h4>
                        <table class='Cart_Table'>
                            <thead>
                                <tr class='table_Header_Row'>
                                    <th class='table_Header'>Item Name</th>
                                    <th class='table_Header'>Item Image</th>
                                    <th class='table_Header'>Size</th>
                                    <th class='table_Header'>Unit Price</th>
                                    <th class='table_Header'>Quantity</th>
                                    <th class='table_Header'>Subtotal</th>
                                    <th class='table_Header'>Edit</th>
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($_COOKIE as $key => $value) {
            $item = explode('_', $key);

            if ($item[0] == 'cart') {
                $cookieId = $item[1];
                $sql = "SELECT*FROM `goods`WHERE `id` = '$cookieId'";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $cart_Value = json_decode($_COOKIE[$key], true);

                $id = $row['id'];
                $title = $row['title'];
                $information = $row['information'];
                $price = $row['price'];
                $FileDir = $row['img_Locate'];
                $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
                $img = str_replace($rootDir, '', glob("$FileDir\*.jpg")[0]);
                $img = str_replace('\\', '/', $img);
                $single_Total = ($price*intval($cart_Value['qty']));

                $total = $total + $single_Total;
                $response .= "
                            <tr class='table_Data_Row'>
                                <td class='table_Data'>$title</td>
                                <td class='table_Data'><img src='$img' alt=''></td>
                                <td class='table_Data'>S</td>
                                <td class='table_Data'>$price</td>
                                <td class='table_Data'>{$cart_Value['qty']}</td>
                                <td class='table_Data'>\${$single_Total}</td>
                                <td class='table_Data'><button class='delete_Cart'>Delete</button></td>
                            </tr>";

            }
            
            # code...
        }
        $response .= "</tbody>

                <tfoot>
                    <tr>
                        <td class='CheckSection' colspan='7'>
                            <div class='total_Title'>Total: \${$total}</div>

                        </td>


                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <td>
                                <button class='checkout_Button'>Check Out</button>
                            </td>
                        </tr>

                </tfoot>
                </table>
                </div>";
            echo $response;
        break;
    default:
        # code...
        break;
}

mysqli_close($connect);