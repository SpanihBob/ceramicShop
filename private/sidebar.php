<div class="sidebar" id="sidebar">
    <?
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once "$path/system/db.php"; //подкл. к БД
        session_start();                    //вкл. сессию

        $queryCategories = $dbPDO -> prepare("SELECT * FROM category");
        $queryCategories -> execute();
        foreach($queryCategories as $rowCategories) {                                           
            echo <<<html
                    <button class="btnSidebar" data-id="$rowCategories[categoryTableName]">
                        <img class="sidebarMicroImage" src="../img/$rowCategories[categoryMicroImage]" alt="">
                        <div>$rowCategories[categoryName]</div>
                    </button>
                html;
        }  
    ?>      
</div>
<script>
    let sidebar = document.getElementById("sidebar");
    sidebar.onclick = event => {
        if(event.target.tagName=="BUTTON") {
            categorySelection(event.target);
        }
        if(event.target.parentNode.tagName=="BUTTON") {
            categorySelection(event.target.parentNode);
        }        
    }

    function categorySelection(btn) {
        let attribute = btn.getAttribute("data-id");
        window.location.href = `/${attribute}`;
    }
    
</script>