<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    print_r($_POST);
    $_POST['id'] = trim($_POST['id']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['id'] = htmlspecialchars($_POST['id']);                    //Преобразует специальные символы в HTML-сущности
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
    $dbPDO->query("UPDATE product SET 
     name = '$_POST[name]',                  
     category = '$_POST[category]',                      
     subcategory = '$_POST[subcategory]',   
     price = '$_POST[price]',               
     description = '$_POST[description]',
     amount = '$_POST[amount]',
     image = '$_POST[image]',
     table_name = '$_POST[table_name]'    
     WHERE id = '$_POST[id]'");
?>