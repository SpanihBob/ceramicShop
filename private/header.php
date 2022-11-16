
<?
// echo $_SESSION['login'];
if(isset($_POST['modalContextMenuExit'])) {
    // $_SESSION['auth']=NULL;
    // $_SESSION['login']=NULL;
    // $_SESSION['id']=NULL;
    session_destroy();
    header("Location: ../index.php"); 
}
?>
<header>
    <div>
        <div class="logo" id="logo">
            <img src="../img/pottery.png" alt="">
            <img src="../img/Безымянный.jpg" alt="">
        </div>
        <form action="/search" method="get" name="searchForm">
            <input type="text" name="searchProduct" id="searchProduct" placeholder="Найти...">
        </form>   
        <div class="headerBtn">
            <div id="guest"></div>
            <div id="favorites"></div>
            <div id="shopping_cart"></div>
        </div>
    </div>
</header>
<div id="modalWindow">
    <div id="modalContextMenu">
        <? if(!isset($_SESSION['login'])) { ?>
            <div id="modalContextMenuSignUp">Регистрация</div>
            <div id="modalContextMenuLogIn">Вход</div>
        <?}?>
        <? if(isset($_SESSION['login'])) { ?>
            <div id="modalContextMenuProfile">Профиль</div>
            <?if(isset($_SESSION['admin'])){ ?>
                <div id="goToAdminPage">Админ</div>
            <?}?>
            <form action="" method="post" id="modalContextMenuExitForm">
                <input type="submit" value="Выход" name="modalContextMenuExit">
            </form>
        <?}?>
    </div>
</div>
<script>
    // const modalContextMenu = document.getElementById('modalContextMenu')
    // const modalWindow = document.getElementById('modalWindow')
    logo.onclick = () => {
        window.location.href = "/";
    }
    window.onclick = (event) => {
        if(event.target.id == 'guest'){
            modalContextMenu.style.left = `${event.clientX - 170}px`;
            modalWindow.style.display = 'block';
        }
        else if((event.target.id == 'modalContextMenu') || (event.target.parentNode.id == 'modalContextMenu')){
            if(event.target.id == 'modalContextMenuProfile'){
                window.location.href = "/account";
            }
            if(event.target.id == 'goToAdminPage'){
                window.location.href = "/admin";
            }
            if(event.target.id == 'modalContextMenuSignUp'){
                window.location.href = "/signup";
            }
            if(event.target.id == 'modalContextMenuLogIn'){
                window.location.href = "/login";
            }
        }
        else if(event.target.id == 'favorites'){
            window.location.href = "/favorites";
        }
        else if(event.target.id == 'shopping_cart'){
            window.location.href = "/cart";
        }
        else {
            modalWindow.style.display = 'none';
        }
        


    }
    
    
</script>
