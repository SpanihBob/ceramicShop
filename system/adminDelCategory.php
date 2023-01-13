<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";                                                             //подкл. к БД
    session_start();

    $_POST['id'] = trim($_POST['id']);                                                              //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['id'] = htmlspecialchars($_POST['id']); 

    $_POST['tableName'] = trim($_POST['tableName']);                                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['tableName'] = htmlspecialchars($_POST['tableName']); 
    
    $amount = $dbPDO->query("SELECT categoryId FROM category WHERE id = '$_POST[id]'");             //находим id-категории по id
    $category_number = $amount->fetch()[0];                                                         //номер найденый по id
    $cat_count = $dbPDO->query("SELECT id FROM category WHERE categoryId = '$category_number'");    //находим все id по id-категории
    $cat_counter = $cat_count->fetchAll(PDO::FETCH_NUM);                                            //номера найденые по id
    $matches_found = count($cat_counter);                                                           //колличество подкатегорий 
    if ($matches_found > 1) {                                                                       //если несколько подкатегорий        
        $dbPDO->query("DELETE FROM $_POST[tableName] WHERE id='$_POST[id]'");                       //удаляем подкатегорию из базы данных
    }
    else if ($matches_found = 1) {                                                                  //если единственная подкатегория в категории
        //...................................... Находим название категории
        $id = $dbPDO->query("SELECT categoryTableName FROM category WHERE id = '$_POST[id]'");
        $catName = $id->fetch()[0];     // <---вот оно 
        
        //...................................... Удаление маршрута категории в index.php
        // Вывести данные из файла в переменную
        $data = file_get_contents("../index.php"); 
        
        // удаляем маршрут
        $data = str_replace("elseif(\$_SERVER['REDIRECT_URL']==\"/$catName\"):require_once \"\$path/public/$catName.php\";","",$data);
        
        // Открыть файл, сделать его пустым
        $handle = fopen("../index.php","w+");
        
        // Записать переменную в файл
        fwrite($handle,$data); 
        
        // Закрыть файл
        fclose($handle); 
        
        //...................................... Удаление файла категории в папке public        
        unlink("../public/$catName.php");
        
        //...................................... Удаление данных категории из базы данных
        $dbPDO->query("DELETE FROM $_POST[tableName] WHERE categoryTableName='$catName'");
    }
        
?>