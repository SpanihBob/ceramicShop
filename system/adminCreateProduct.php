<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $_POST['name'] = trim($_POST['name']);                               
    $_POST['name'] = htmlspecialchars($_POST['name']);                                      
        $_POST['category'] = trim($_POST['category']);                               
        $_POST['category'] = htmlspecialchars($_POST['category']);                   
    $_POST['subcategory'] = trim($_POST['subcategory']);                               
    $_POST['subcategory'] = htmlspecialchars($_POST['subcategory']);                   
        $_POST['price'] = trim($_POST['price']);                               
        $_POST['price'] = htmlspecialchars($_POST['price']);                   
    $_POST['description'] = trim($_POST['description']);                               
    $_POST['description'] = htmlspecialchars($_POST['description']);                   
        $_POST['amount'] = trim($_POST['amount']);                               
        $_POST['amount'] = htmlspecialchars($_POST['amount']);                   
    $_POST['image'] = trim($_POST['image']);                               
    $_POST['image'] = htmlspecialchars($_POST['image']);                   
        $_POST['table_name'] = trim($_POST['table_name']);                               
        $_POST['table_name'] = htmlspecialchars($_POST['table_name']);
    //обновление товара
    $dbPDO->query("INSERT INTO product (name, category, subcategory, price, description, amount, image, table_name) 
                    VALUES('$_POST[name]', '$_POST[category]', '$_POST[subcategory]', '$_POST[price]', '$_POST[description]', '$_POST[amount]', '$_POST[image]', '$_POST[table_name]')");
?>