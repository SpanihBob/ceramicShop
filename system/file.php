<?php
$data = file_get_contents("../index2.php"); // Вывести данные из файла в переменную
// /else.*\n.*login.php";/          // ^else - в начале строки, 
                                    // .* - любое колличество символов
                                    // \n - символ перевода строки
                                    // .* - любое колличество символов
                                    // ligon\.php\"\;$ - (ligon.php"\;) в конце строки
                             

// добавляем маршрут
$data = str_replace("elseif(\$_SERVER['REDIRECT_URL']==\"/login\"):require_once \"\$path/public/login.php\";","elseif(\$_SERVER['REDIRECT_URL']==\"/login\"):require_once \"\$path/public/login.php\";\nelseif(\$_SERVER['REDIRECT_URL']==\"/puk\"):require_once \"\$path/public/puk.php\";",$data); // Заменить 2-ки на пустые места

// удаляем маршрут
// $data = str_replace("elseif(\$_SERVER['REDIRECT_URL']==\"/puk\"):require_once \"\$path/public/puk.php\";","",$data);

// $data = str_replace("login","puk",$data); // Заменить 2-ки на пустые места
// $data = str_replace("6","",$data); // Заменить 6-ки на пкстые места
$handle = fopen("../index2.php","w+"); // Открыть файл, сделать его пустым
fwrite($handle,$data); // Записать переменную в файл
fclose($handle); // Закрыть файл
?>