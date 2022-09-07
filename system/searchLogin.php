<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    
    $_POST['searchLogin'] = trim($_POST['searchLogin']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['searchLogin'] = htmlspecialchars($_POST['searchLogin']);                    //Преобразует специальные символы в HTML-сущности

    $query=$dbPDO->query("SELECT `id` FROM `users` WHERE `login` = '$_POST[searchLogin]'");
    // _______________________________________________________________________________
    // $query=$dbPDO->query("SELECT * FROM `users`");
    // print_r($query->fetch(PDO::FETCH_ASSOC));
    // echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    // _______________________________________________________________________________

    if($query -> rowCount() > 0) {                          //если колличество строк > 0
        echo "<span style='color:red'>login занят!</span>";
    }
    else {
        echo "<span style='color:green'>login свободен!</span>";
    }
?>