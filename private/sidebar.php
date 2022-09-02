<div class="sidebar">
    <?
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once "$path/system/db.php"; //подкл. к БД
        session_start();                    //вкл. сессию

        $queryCategories = $dbPDO -> prepare("SELECT * FROM category");
        $queryCategories -> execute();
        foreach($queryCategories as $rowCategories) {                                           
            echo <<<html
                    <button class="btnSidebar">
                        <img class="sidebarMicroImage" src="../img/$rowCategories[categoryMicroImage]" alt="">
                        <div>$rowCategories[categoryName]</div>
                    </button>
                html;
        }  
    ?>      
</div>