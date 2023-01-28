<?    
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    $files = $_FILES['picture']['name'];
    $subfiles = $_FILES['sub_picture']['name'];
    
    echo "<pre>";
    print_r($_POST);
    print_r($files);
    print_r($subfiles);
    echo "</pre>";


    $_POST['cat_id'] = trim($_POST['cat_id']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_id'] = htmlspecialchars($_POST['cat_id']);                    //Преобразует специальные символы в HTML-сущности

    $_POST['cat_name'] = trim($_POST['cat_name']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_name'] = htmlspecialchars($_POST['cat_name']);                    //Преобразует специальные символы в HTML-сущности
    
    $_POST['cat_table'] = trim($_POST['cat_table']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_table'] = htmlspecialchars($_POST['cat_table']);                    //Преобразует специальные символы в HTML-сущности
    
    $_POST['subcat_name'] = trim($_POST['subcat_name']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['subcat_name'] = htmlspecialchars($_POST['subcat_name']);                    //Преобразует специальные символы в HTML-сущности

    //обновление колличества товара в корзине
    $dbPDO->query("UPDATE category SET categoryName = '$_POST[cat_name]', categoryMicroImage = '$files', categoryTableName = '$_POST[cat_table]', subcategory = '$_POST[subcat_name]', subcategoryImage = '$subfiles' WHERE id='$_POST[cat_id]'");

?>