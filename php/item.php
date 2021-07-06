<?php
require_once 'connect_db.php';
header('Content-Type: text/html; charset: utf-8');
$good = $_GET['good'];
// $good ='ruler';

$sql = "SELECT*FROM `goods`WHERE `title` = '$good'";
$result = mysqli_query($connect, $sql);

$num = mysqli_num_rows($result);

if ($num !== 0) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $title = $row['title'];
    $information = $row['information'];
    $price = $row['price'];
    $FileDir = $row['img_Locate'];
    $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
    $img = str_replace($rootDir, '', glob("$FileDir\*.jpg")[0]);
    $img = str_replace('\\', '/', $img);
    $countImg = count(glob("$FileDir\*.jpg"));

    $response = "<div id='item' class='itemWrapper'>
                    <div class='itemImg'>
                        <div class='img_MainWrapper'>
                            <div class='img_Main'style='background: center url({$img}) no-repeat;background-size: 100%;'></div>

                        </div>
                        <div class='img_Row'>";

    if ($countImg !== 0) {
        for ($i = 0; $i < $countImg; $i++) {
            $img = str_replace($rootDir, '', glob("$FileDir\*.jpg")[$i]);
            $img = str_replace('\\', '/', $img);
            $response .= "<div class='img_BottomWrapper'>
                            <a href='{$img}' data-lightbox='pic'>
                                <div class='img_Bottom' style='background: center url({$img}) no-repeat;background-size: cover;'></div>
                            </a>
                          </div>";
        }

    }
    $response .= "</div>
                    </div>
                    <div class='itemInform'>
                        <div class='item_Title'>$title</div>
                        <div class='item_IntroText'>
                            $information
                        </div>
                        <div class='itemInform_Bottom'>
                            <div class='informL'>
                                <div class='informText'>
                                    <ul>
                                        <li>We do not accept cancellations, size changes, quantity changes, exchanges, or returns except for defective products.</li>
                                        <li>Shipping, packing and handling fees will be charged for each order.</li>
                                        <li>Please note that the design, color tone and size of the actual product may differ.</li>
                                    </ul>
                                    <a href='http://hitsujishop_test.com:6080/hitsuji copy.html' class='back_Link'>Back</a>
                                </div>
                            </div>
                            <div class='informR'>
                                <form action='' method=''>
                                    <div class='item_Size'>
                                        <div class='informRTitle'>Size</div>
                                        <label for='size_S'>S &nbsp;<input type='radio' name='size' id='size_S' value='S'></label>
                                        <label for='size_M'>M &nbsp;<input type='radio' name='size' id='size_M' value='M'></label>
                                        <label for='size_L'>L &nbsp;<input type='radio' name='size' id='size_L' value='L'></label>
                                        <label for='size_XL'>XL &nbsp;<input type='radio' name='size' id='size_XL' value='XL'></label>
                                    </div>
                                    <div class='item_Number'>
                                        <div class='informRTitle'>Number</div>
                                        <select name='number' id='number'>
                                            <option disabled value>choose number</option>
                                            <option value='1'>1</option>
                                            <option value='2'>2</option>
                                            <option value='3'>3</option>
                                            <option value='4'>4</option>
                                            <option value='5'>5</option>
                                            <option value='6'>6</option>
                                            <option value='7'>7</option>
                                            <option value='8'>8</option>
                                        </select>
                                    </div>
                                    <div class='item_Price'>
                                        <div class='informRTitle'>Price</div>
                                        <div class='priceNumber'>\$$price</div>
                                    </div>
                                    <div class='item_Checkout'>
                                        <button id='submit' type='submit'>Checkout</button>
                                        <button id='submit' type='submit'>Add Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";

}
echo $response;
mysqli_free_result($result);
//資料庫離線
mysqli_close($connect);