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
        $category = $row['category'];
        $set = false;

        if ($category == 'cloth') {
            if (isset($_REQUEST['size']) && isset($_REQUEST['qty'])) {
                $qty = $_REQUEST['qty'];
                $size = $_REQUEST['size'];
            } else {
                $qty = '1';
                $size = 'M';
            }
        } else {
            $size = 'nan';
            if (isset($_REQUEST['qty'])) {
                $qty = $_REQUEST['qty'];
            } else {
                $qty = '1';
            }

        }

        if (isset($_COOKIE['cart_' . $goodId])) {
            $qty = intval($qty);
            $cart_Value_Old = json_decode($_COOKIE['cart_' . $goodId], true);
            setcookie('cart_' . $goodId, "", time() - 86400, '/');
            $cart_Value_New = array();
            $cart_Value_New['item_Id'] = $cart_Value_Old['item_Id'];
            if ($row['category'] == 'cloth') {
                $cart_Value_New['size_Qty']['S'] = $cart_Value_Old['size_Qty']['S'];
                $cart_Value_New['size_Qty']['M'] = $cart_Value_Old['size_Qty']['M'];
                $cart_Value_New['size_Qty']['L'] = $cart_Value_Old['size_Qty']['L'];
                $cart_Value_New['size_Qty']['XL'] = $cart_Value_Old['size_Qty']['XL'];

                $new_Qty = $cart_Value_Old['size_Qty'][$size];
                settype($new_Qty, "integer");
                $new_Qty = $new_Qty + $qty;

                $cart_Value_New['size_Qty'][$size] = strval($new_Qty);
            } else {
                $cart_Value_New['size_Qty']['nan'] = $cart_Value_Old['size_Qty']['nan'];
                $new_Qty = $cart_Value_Old['size_Qty']['nan'];
                settype($new_Qty, "integer");
                $new_Qty = $new_Qty + $qty;

                $cart_Value_New['size_Qty']['nan'] = strval($new_Qty);
            }

            setcookie('cart_' . $goodId, json_encode($cart_Value_New), time() + 86400, '/');
            $set = true;
            // $response = 'already have COOKIE:' . $name;
            print_r($cart_Value_Old);
            print_r($cart_Value_New);
            echo ("\nAllready have" . $new_Qty);

        }

        if ($set == false) {
            $new_Cart_Item = 'cart_' . $goodId;
            $cart_Value = array();
            $cart_Value['item_Id'] = $goodId;
            if ($row['category'] == 'cloth') {
                $cart_Value['size_Qty']['S'] = '0';
                $cart_Value['size_Qty']['M'] = $qty;
                $cart_Value['size_Qty']['L'] = '0';
                $cart_Value['size_Qty']['XL'] = '0';
            } else {
                $cart_Value['size_Qty']['nan'] = $qty;
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
                        <h2 class='section_Title'>Cart List</h4>
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

                $title = $row['title'];

                $price = $row['price'];
                $FileDir = $row['img_Locate'];
                $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
                $img = str_replace($rootDir, '', glob("$FileDir\*.jpg")[0]);
                $img = str_replace('\\', '/', $img);

                foreach ($cart_Value['size_Qty'] as $size => $qty) {
                    # code...

                    if ($qty !== '0') {
                        $single_Total = ($price * intval($qty));

                        $total = $total + $single_Total;
                        $response .= "
                            <tr class='table_Data_Row'>
                                <td class='table_Data'>$title</td>
                                <td class='table_Data'><img src='$img' alt=''></td>
                                <td class='table_Data'>{$size}</td>
                                <td class='table_Data'>\$$price</td>
                                <td class='table_Data'>{$qty}</td>
                                <td class='table_Data'>\${$single_Total}</td>
                                <td class='table_Data'><button class='delete_Cart' data-cartid='$key' data-qty='$qty'>Delete</button></td>
                            </tr>";
                    }

                }

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
    case 'delete_Cart':
        $cart_Id = $_GET['cartid'];
        $delete_Qty = $_GET['qty'];
        $item = explode('_', $cart_Id);
        $sql = "SELECT*FROM `goods`WHERE `id` = '{$item[1]}'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $price = $row['price'];
        $delete_Cookie = json_decode($_COOKIE[$cart_Id], true);
        $delete_Total = 0;

        $delete_Total = $delete_Total + ($price * intval($delete_Qty));

        $delete_Cookie = $cart_Id;
        setcookie($delete_Cookie, "", time() - 84600, "/");

        $total = 0;
        foreach ($_COOKIE as $key => $value) {
            $item = explode('_', $key);
            if ($item[0] == 'cart') {
                $cookieId = $item[1];
                $sql = "SELECT*FROM `goods`WHERE `id` = '$cookieId'";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $cart_Value = json_decode($_COOKIE[$key], true);
                $price = $row['price'];

                foreach ($cart_Value['size_Qty'] as $size => $qty) {
                    # code...

                    if ($qty !== '0') {
                        $single_Total = ($price * intval($qty));

                        $total = $total + $single_Total;
                    }
                }

                strval($total);
            }
            # code...
        }
        $total = $total - $delete_Total;
        $response = array('delete_result' => 'true', 'new_Total' => $total);
        echo json_encode($response);
        break;

    case 'show_Checkout':
        $total = 0;
        $response = "<div class='checkout_Item_ListWrapper'>
                        <h2 class='section_Title'>Check Out</h2>
                        <div class='checkout_Item_List'>
                            <h4 class='section_Title'>Checkout List</h4>
                            <table class='checkout_Item_Table'>
                                <thead>
                                    <tr>
                                        <th>Order Item</th>
                                        <th>Size & Quantity</th>
                                        <th>Subtotal</th>
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
                $title = $row['title'];
                $price = $row['price'];
                $cart_Value = json_decode($_COOKIE[$key], true);
                $subtotal = 0;

                $response .= "<tr>
                                <td>{$title}</td>
                                <td>";
                foreach ($cart_Value['size_Qty'] as $size => $qty) {
                    # code...
                    if ($qty !== '0') {
                        $response .= $size . ' x ' . $qty . '<br>';
                        $subtotal = $subtotal + ($price * intval($qty));
                    }

                }
                $response .= "</td>
                                <td>{$subtotal}</td>
                            </tr>";

                $total = $total + $subtotal;
            }
            # code...
        }

        $response .= "</tbody>
                    <tfoot>
                        <tr>
                            <td class='CheckSection' colspan='3'>
                                <div class='total_Title'>Total: \${$total}</div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>";

        session_start();
        if (isset($_SESSION['accountName'])) {
            $accountName = $_SESSION['accountName'];
            $sql = "SELECT `name`,`email`,`phone`,`address` FROM`account`WHERE `name` = '{$accountName}'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $response .= "<div class='sender_Information'>
                            <h3 class='section_Title'>Sender/ Receiver Information</h3>
                            <h5 class='section_Title'>Please Enter Information </h5>
                            <form action='' method='POST'>
                                <div class='sender_InputField'>
                                    <div class='inputWrapper input_Half'>
                                        <h4 class='sender_Title'>Name：</h4>
                                        <input class='sender_Input' type='text' name='input_AccountName' id='input_AccountName' placeholder='Enter Your Name' value='{$name}' required>
                                    </div>
                                    <div class='inputWrapper input_Half'>
                                        <h4 class='sender_Title'>Phone：</h4>
                                        <input class='sender_Input' type='number' name='input_Phone' id='input_Phone' placeholder='Enter Your Phone Number' value='{$phone}' required>
                                    </div>
                                    <div class='inputWrapper'>
                                        <h4 class='sender_Title'>E-mail：</h4>
                                        <input class='sender_Input' type='email' name='input_Email' id='input_Email' placeholder='Enter Your Phone Email' value='{$email}' required>
                                    </div>
                                    <div class='inputWrapper'>
                                        <h4 class='sender_Title'>Address：</h4>
                                        <input class='sender_Input' type='text' name='input_Address' id='input_Address' placeholder='Enter Your Phone Address' value='{$address}' required>
                                    </div>
                                    <div class='inputWrapper'>
                                        <h4 class='sender_Title'>Payment Method：</h4>
                                        <div class='checkboxWrapper'>
                                            <label for='input_COD'>
                                                <div class='iconWrapper'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64' width='100%' height='100%'>
                                                        <path
                                                            d='M61 2h-6a1 1 0 00-1 1v.382l-2.131-1.066A3.014 3.014 0 0050.528 2H35.872A3 3 0 0034 2.658L29.819 6H13a1 1 0 00-1 1v16a1 1 0 001 1h30a1 1 0 001-1v-7.552a9.026 9.026 0 007.943-.648l1.337-.8H54v1a1 1 0 001 1h6a1 1 0 001-1V3a1 1 0 00-1-1zM14 22V8h23.929l-1.121 1.122a3 3 0 004.242 4.242l.95-.95V22zm38.994-10a.993.993 0 00-.509.143l-1.571.942a7.03 7.03 0 01-6.24.482L44 13.293v-2.879l1.27-1.27.516.172a7.044 7.044 0 004.428 0l1.1-.367a1 1 0 00-.632-1.9l-1.1.368a5.029 5.029 0 01-3.162 0l-1.1-.368a1 1 0 00-1.023.242l-2 2-2.661 2.659a1 1 0 01-1.414 0 1 1 0 010-1.414l3.886-3.887a1 1 0 00-1.414-1.414L39.929 6h-6.908l2.226-1.781A1 1 0 0135.872 4h14.656a1.019 1.019 0 01.447.105L54 5.618v6.375zM60 14h-4V4h4z' />
                                                        <path
                                                            d='M28 12a1 1 0 011 1h2a3 3 0 00-2-2.816V9h-2v1.184A2.993 2.993 0 0028 16a1 1 0 11-1 1h-2a3 3 0 002 2.816V21h2v-1.184A2.993 2.993 0 0028 14a1 1 0 010-2zM22 14h-2a1 1 0 000 2h2a1 1 0 000-2zM36 14h-2a1 1 0 000 2h2a1 1 0 000-2zM43.458 49.773a2.989 2.989 0 00-4.1-1.1l-6.427 3.7A3 3 0 0030 50h-7.7l-.2-.134A10.968 10.968 0 0010 49.8V49a1 1 0 00-1-1H3a1 1 0 00-1 1v12a1 1 0 001 1h6a1 1 0 001-1v-.136l.934.62A2.98 2.98 0 0012.61 62h14.85a2.922 2.922 0 001.5-.4l13.4-7.73a3.017 3.017 0 001.5-2.606 2.97 2.97 0 00-.402-1.491zM8 60H4V50h4zm33.36-7.866l-13.415 7.739a.931.931 0 01-.485.127H12.61a.977.977 0 01-.557-.173L10 58.464V52a1 1 0 00.554-.167l.454-.3a8.976 8.976 0 019.985 0l.453.3A1 1 0 0022 52h8a1 1 0 010 2h-6a1 1 0 000 2h6a2.976 2.976 0 001.981-.764l8.387-4.836a.968.968 0 01.746-.1.994.994 0 01.611.472.966.966 0 01.135.488 1.011 1.011 0 01-.5.874z' />
                                                        <path
                                                            d='M41 28H15a1 1 0 00-1 1v18a1 1 0 001 1h26a1 1 0 001-1V29a1 1 0 00-1-1zm-12 2v4h-2v-4zm11 16H16V30h9v5a1 1 0 001 1h4a1 1 0 001-1v-5h9z' />
                                                        <path
                                                            d='M22 40h-4a1 1 0 000 2h4a1 1 0 000-2zM26 40h-1a1 1 0 000 2h1a1 1 0 000-2zM22 43h-4a1 1 0 000 2h4a1 1 0 000-2zM26 43h-1a1 1 0 000 2h1a1 1 0 000-2z' />
                                                    </svg>
                                                </div>
                                                Cash on delivery
                                                <input type='radio' name='input_Payment' id='input_COD' value='Cash' required>
                                            </label>
                                            <label for='input_CCP'>
                                                <div class='iconWrapper'>
                                                    <svg  viewBox='0 0 512.002 512.002' width='100%' height='100%'  xmlns='http://www.w3.org/2000/svg'>
                                                        <path
                                                            d='M502.903 96.829c-6.634-7.842-15.924-12.632-26.161-13.487L116.185 53.236c-10.238-.855-20.192 2.328-28.035 8.961-7.811 6.607-12.594 15.85-13.476 26.037L67.42 156.29H38.455C17.251 156.29 0 173.541 0 194.745v225.702c0 21.204 17.251 38.455 38.455 38.455h361.813c21.205 0 38.456-17.251 38.456-38.455v-36.613l12.839 1.072c1.083.09 2.16.135 3.228.135 19.768 0 36.62-15.209 38.294-35.257l18.781-224.919c.854-10.237-2.329-20.193-8.963-28.036zM38.455 176.29h361.813c10.176 0 18.456 8.279 18.456 18.455v20.566H20v-20.566c0-10.176 8.279-18.455 18.455-18.455zM20 235.311h398.724V276.8H20zm380.268 203.591H38.455c-10.176 0-18.455-8.279-18.455-18.455V296.8h398.724v123.647c0 10.176-8.28 18.455-18.456 18.455zM491.935 123.2l-18.781 224.919c-.847 10.141-9.788 17.706-19.927 16.856l-14.503-1.211V194.745c0-21.204-17.251-38.455-38.456-38.455H87.534l7.039-66.04c.008-.076.015-.151.021-.228.847-10.141 9.783-17.705 19.927-16.855l360.558 30.106c4.913.41 9.372 2.709 12.555 6.473s4.711 8.541 4.301 13.454z' />
                                                        <path
                                                            d='M376.873 326.532h-96.242c-5.523 0-10 4.477-10 10v62.789c0 5.523 4.477 10 10 10h96.242c5.523 0 10-4.477 10-10v-62.789c0-5.523-4.477-10-10-10zm-10 62.789h-76.242v-42.789h76.242z' />
                                                    </svg>
                                                </div>
                                                Credit card payment
                                                <input type='radio' name='input_Payment' id='input_CCP' value='Card' required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='submitWrapper'><button id='sender_Submit' type='submit'>Confirm</button></div>
                                </div>
                            </form>
                        </div>";
        } else {
            $response .= 'not login';
        }

        echo $response;
        break;
    default:
        # code...
        break;
}

mysqli_close($connect);