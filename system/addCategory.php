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


    $max_id->query("SELECT MAX(`categoryId`) FROM `category`");
    echo $max_id;
    //создаем файл php для категории и заполняем его данными
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
                    loadCategory("' . $_POST['cat_table'] . '","2")
                }
            </script>		
        </article>
        <?
            include_once "$path/private/footer.php"		//FOOTER
        ?>
    </div>
</body>
</html>';
    $new_file = file_put_contents('../public/' . $_POST['cat_table'] . '.php',$content);              //создать файл php пустой для категории
    
    //обновление колличества товара в корзине
    // $dbPDO->query("UPDATE category SET categoryName = '$_POST[cat_name]', categoryMicroImage = '$files', categoryTableName = '$_POST[cat_table]' WHERE id='$_POST[cat_id]'");

    //добавляем категорию в базу данных:
    $dbPDO->query("INSERT INTO category(categoryName, categoryMicroImage, categoryTableName) VALUES ('$_POST[cat_name]','$files','$_POST[cat_table]')");    
?>


