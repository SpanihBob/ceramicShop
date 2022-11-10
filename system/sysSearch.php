<?
    // принимаем $_GET['searchProduct']
    if(isset($_GET['searchProduct'])) {
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