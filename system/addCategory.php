<?    
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    print_r($_POST);
    print_r($_FILES);
    $files = $_FILES['picture']['name'];
    echo $files;

    $_POST['cat_name'] = trim($_POST['cat_name']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_name'] = htmlspecialchars($_POST['cat_name']);                    //Преобразует специальные символы в HTML-сущности
    
    $_POST['cat_table'] = trim($_POST['cat_table']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_table'] = htmlspecialchars($_POST['cat_table']);                    //Преобразует специальные символы в HTML-сущности


    //обновление колличества товара в корзине
    // $dbPDO->query("UPDATE category SET categoryName = '$_POST[cat_name]', categoryMicroImage = '$files', categoryTableName = '$_POST[cat_table]' WHERE id='$_POST[cat_id]'");
    $dbPDO->query("INSERT INTO category(categoryName, categoryMicroImage, categoryTableName) VALUES ('$_POST[cat_name]','$files','$_POST[cat_table]')");
?>


