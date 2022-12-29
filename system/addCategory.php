<?    
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    print_r($_POST);
    print_r($_FILES);
    $files = $_FILES['picture']['name'];
    echo $files;
    echo "<br>";

    $_POST['cat_name'] = trim($_POST['cat_name']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_name'] = htmlspecialchars($_POST['cat_name']);                    //Преобразует специальные символы в HTML-сущности
    
    $_POST['cat_table'] = trim($_POST['cat_table']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['cat_table'] = htmlspecialchars($_POST['cat_table']);                    //Преобразует специальные символы в HTML-сущности
    $_POST['cat_table'] = strtolower($_POST['cat_table']);

//...................................... Создание и заполнение нового php файла категории

// находим максимальный id существующей категории 
$max_id = $dbPDO->query("SELECT MAX(`categoryId`) FROM `category`");
$number = $max_id->fetch()[0];  //преобразование в ассоц массив  

    // Данные для заполнения нового файла 
    $content = '<?
    include_once "$path/private/head.php";
    ?>
    <body>
    <div class="container">			
    <?
            include_once "$path/private/header.php";						//HEADER
        ?>	

        <article class="article">											<!-- ARTICLE -->
        <?
        include_once "$path/private/sidebar.php";					//SIDEBAR
            ?>
            <div>
                <div class="crockeryContent" id="content">									<!-- CONTENT -->				
                </div>
            </div>


            <script>
                window.onload=()=>{
                    loadCategory("' . $_POST['cat_table'] . '","' . $number+1 . '")
                }
                </script>		
                </article>
                <?
                include_once "$path/private/footer.php"		//FOOTER
                ?>
                </div>
                </body>
                </html>';
                
    //создаем файл php для категории и заполняем его данными
    $new_file = file_put_contents('../public/' . $_POST['cat_table'] . '.php',$content);             
                
 
    
//...................................... Создание маршрута нового файла категории в index.php

// Вывести данные из файла в переменную
$data = file_get_contents("../index.php"); 

// добавляем маршрут
$data = str_replace("elseif(\$_SERVER['REDIRECT_URL']==\"/login\"):require_once \"\$path/public/login.php\";","elseif(\$_SERVER['REDIRECT_URL']==\"/login\"):require_once \"\$path/public/login.php\";\n\nelseif(\$_SERVER['REDIRECT_URL']==\"/" . $_POST['cat_table'] . "\"):require_once \"\$path/public/" . $_POST['cat_table'] . ".php\";",$data);

// удаляем маршрут
// $data = str_replace("elseif(\$_SERVER['REDIRECT_URL']==\"/puk\"):require_once \"\$path/public/puk.php\";","",$data);

// Открыть файл, сделать его пустым
$handle = fopen("../index.php","w+");

// Записать переменную в файл
fwrite($handle,$data); 

// Закрыть файл
fclose($handle); 

//...................................... Добавляем категорию в базу данных
    $dbPDO->query("INSERT INTO category(categoryName, categoryMicroImage, categoryTableName, categoryId) VALUES ('$_POST[cat_name]','$files','$_POST[cat_table]', $number+1)");    
?>


