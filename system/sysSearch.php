<?
    
    // if(isset($_GET['idcat'])) {
    //     $queryGoods = $dbPDO -> prepare("SELECT * FROM `goods` WHERE `cat_id` = '$_GET[idcat]'");
    //     $queryGoods -> execute();
    //     foreach($queryGoods as $rowGoods) {
    //         echo "<div> $rowGoods[name] </div>";
    //     }
    // }
    // if(isset($_GET['idcrockery'])) {
    //     $queryGoods = $dbPDO -> prepare("SELECT * FROM product WHERE `id` = '$_GET[idcrockery]'");
    //     $queryGoods -> execute();
    //     foreach($queryGoods as $rowGoods) {
    //         echo "<div> $rowGoods[name] </div>";
    //     }
    // }

    // принимаем $_GET['searchProduct']
    if(isset($_GET['searchProduct'])) {
        $queryCat = $dbPDO -> query("SELECT * FROM category WHERE categoryName LIKE '$_GET[searchProduct]%' ORDER BY categoryName ASC");    //выбираем соответствие шаблону с сортировкой по возрастанию, %-позволяет не писать слово целиком
        if( $queryCat -> rowCount() > 0) {
            echo "<h3>Совпадения по категориям</h3>";
            foreach($queryCat as $row) {
                echo "<div><a href='/search?idcat=$row[id]'> $row[categoryName] </a></div>";
            }                        
        }
        $queryCrockery = $dbPDO -> query("SELECT * FROM crockery WHERE crockeryName LIKE '$_GET[searchProduct]%' ORDER BY crockeryName ASC");    //выбираем соответствие шаблону с сортировкой по возрастанию, %-позволяет не писать слово целиком
        if( $queryCrockery -> rowCount() > 0) {
            echo "<h3>Совпадения по категориям</h3>";
            foreach($queryCrockery as $row) {
                echo "<div><a href='/search?idcrockery=$row[id]'> $row[crockeryName] </a></div>";
            }                        
        }
        $queryProduct = $dbPDO -> query("SELECT * FROM product WHERE name LIKE '$_GET[searchProduct]%' ORDER BY name ASC");
        if( $queryProduct -> rowCount() > 0) {
            echo "<h3>Совпадения по товарам</h3>";
            foreach($queryProduct as $rowProduct) {                                
                echo <<<html
                    <div class="mainCard" data-product-id = $rowProduct[id]>
                        <div class="mainCard__img">img</div>
                        <div class="mainCard__cont">
                            <div class="mainCard__cont_row1">
                                <div>$rowProduct[name]</div>
                                <div>Close</div>
                            </div>
                            <div class="mainCard__cont_row2">
                                desc.
                            </div>
                            <div class="mainCard__cont_row3">
                                <div>x</div>
                                <div>prise</div>
                                <div class="mainCard__cont_row3__productToCart">add to cart</div>
                            </div>
                        </div>
                    </div>
                html;
            }                        
        }
    }
?>