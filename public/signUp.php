<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		    //HEADER
		?>	

		<article class="article">						        <!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			<div id="signupContent">								            <!-- CONTENT -->
				<form action="" method="post" id="formSignUp">
                    <input type="text" name="login" id="login" placeholder="Введите логин">
                    <div>
                        <input type="password" name="password" id="password" placeholder="Введите пароль">
                        <div class="eyeBtn"><img src="../img/closed-eye.png" id="img1" alt=""></div>
                    </div>
                    <div>
                        <input type="password" name="password2" id="password2" placeholder="Подтвердите пароль">
                        <div class="eyeBtn"><img src="../img/closed-eye.png" id="img2" alt=""></div>
                    </div>                    
                    <input type="email" name="email" id="email" placeholder="Ведите email">
                    <input type="submit" name="signup" value="Регистрация">
                    <a href="">Или вход</a>
                </form>
			</div>

			<script>
                let eyeOpen = 0;    //src="../img/closed-eye.png"
                formSignUp.onclick = event => {
                    if(event.target.tagName == "IMG") {
                        let img = event.target;
                        if(eyeOpen == 0) {
                            img.setAttribute("src", "../img/open-eye.png");
                            eyeOpen = 1;
                            console.log(img.id.replace('/[a-z]/g',''));
                        } 
                        else {
                            img.setAttribute("src", "../img/closed-eye.png");
                            eyeOpen = 0;
                        }
                        
                    }
                }


			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		        //FOOTER
		?>
	</div>
</body>
</html>
