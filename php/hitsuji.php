<?php
require_once 'connect_db.php';
header('Content-Type: text/html; charset: utf-8');

$sql = 'SELECT*FROM `goods`';
$result = mysqli_query($connect, $sql);

$num = mysqli_num_rows($result);

if ($num !== 0) {
    $response = "<div class='goods_Row'>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $title = $row['title'];
            $information= $row['information'];
            $price = $row['price'];
            $FileDir=$row['img_Locate'];
            $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
            $img = str_replace($rootDir,'',glob("$FileDir\*.jpg")[0]);
            $img = str_replace('\\','/',$img);
            
        
            
            $response .="<a href='#' class='goods_Link' data-goodsid = '{$title}'>
                            <div class='goods_Wrapper'>
                                <div class='goods_Box'>
                                    <div class='goods_Img' id='goods1'style='background: center url({$img}) no-repeat;background-size: cover;'></div>
                                    <div class='goods_Title'>{$title} </div>
                                    <div class='goods_Price'>\$NT:{$price}</div>
                                    <div class='goods_Button'>
                                        <button class='goods_ButtonL goods_Link' ><a href='#'>Detail</a></button>
                                        <button class='goods_ButtonR'><a href=''>
                                            <svg id='_x31__px' height='100%'width='100%' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='m19.413 19h-9.403c-1.115 0-2.103-.747-2.401-1.816l-3.179-11.096c-.18-.642-.771-1.088-1.44-1.088h-2.49c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2.49c1.115 0 2.103.747 2.401 1.816l.627 2.184h16.481c.479 0 .918.22 1.203.604.286.384.371.868.233 1.326l-2.151 7.35c-.346 1.036-1.297 1.72-2.371 1.72zm-13.109-10 2.267 7.912c.179.642.77 1.088 1.439 1.088h9.403c.634 0 1.216-.419 1.416-1.018l2.149-7.338c.046-.153.017-.314-.078-.442-.095-.129-.241-.202-.401-.202z'/><path d='m11 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.552 0-1 .449-1 1s.448 1 1 1 1-.449 1-1-.448-1-1-1z'/><path d='m18 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.552 0-1 .449-1 1s.448 1 1 1 1-.449 1-1-.448-1-1-1z'/>
                                            </svg>
                                        </a></button>
                                    </div>
                                </div>
                            </div>
                        </a>";
        
       
    }
    $response .= '</div>';
    echo $response;
}
mysqli_free_result($result);
//資料庫離線
mysqli_close($connect);