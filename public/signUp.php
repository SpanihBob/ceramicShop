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
				<form action="" method="post" id="formSignup">
                    <input type="text" name="login" id="login" placeholder="Введите логин">
                    <div class="passwordDiv">
                        <input type="password" name="password" id="password" placeholder="Введите пароль">
                        <div class="eyeBtn"><img src="../img/closed-eye.png" id="img1" alt=""></div>
                    </div>
                    <div class="passwordDiv">
                        <input type="password" name="password2" id="password2" placeholder="Подтвердите пароль">
                        <div class="eyeBtn"><img src="../img/closed-eye.png" id="img2" alt=""></div>
                    </div>                    
                    <input type="email" name="email" id="email" placeholder="Ведите email">
                    <input type="submit" name="signupSend" value="Регистрация">
                    <a href="/login">Или вход</a>
                    <div class="capsLock" id="example"></div>
                </form>
			</div>

			<script>               
                let eyeOpen = 0;    //src="../img/closed-eye.png"
                formSignup.onclick = event => {                                 //при клике на глаз мы видем введенный пароль
                    if(event.target.tagName == "IMG") {
                        let img = event.target;
                        let eyeInput = img.parentNode.parentNode.childNodes[1];
                        if(eyeOpen == 0) {
                            img.setAttribute("src", "../img/open-eye.png");
                            eyeOpen = 1;
                            eyeInput.setAttribute("type",`text`);
                        }
                        else {
                            img.setAttribute("src", "../img/closed-eye.png");
                            eyeOpen = 0;
                            eyeInput.setAttribute("type",`password`);
                        }                        
                    }
                }

                // ......................проверка на регулярку............................
            let regesEmail = /\b[A-Za-zА-ЯЁа-яё]+@[A-Za-zА-ЯЁа-яё]+\.[A-Za-zА-ЯЁа-яё]+\b/gi
            let regesLogin = /[-#<>*+=;&%(){}]/gi;
            let email = document.getElementById("email");

            
            email.onblur=()=>{ 
                email.value = email.value.match(regesEmail);            //событие потеря фокуса
            }

            login.onkeyup=()=>{
                login.value = login.value.replace(regesLogin,'');
            }
                        
            login.oninput=()=>{                                         //при вводе в input создаем асинхронный запрос для проверки свободен или занят login
                if( login.value.length>2 ) {
                    fetch("/system/searchLogin.php", {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                        },
                        body: `searchLogin=${login.value}`,
                        })
                .then(response => response.text())
                .then(data => example.innerHTML=data)
                }
                else {
                    example.innerHTML=null;
                }
                valid();
            }
        
            formSignup.onsubmit=()=>{  
                event.preventDefault();
                if(email.value=="") {
                    example.innerHTML="Введите email";
                    return false;
                }
                if(login.value=="") {
                    example.innerHTML="Введите логин";
                    return false;
                }
                if(password.value=="") {
                    example.innerHTML="Введите пароль 1";
                    return false;
                }
                if(password2.value=="") {
                    example.innerHTML="Введите пароль 2";
                    return false;
                }
                if(password.value!==password2.value) {
                    example.innerHTML="Пароли не совпадают";
                    return false;
                } 
                else {
                    if( login.value.length>2 ) {
                        fetch("/system/searchData.php", {
                            method: 'post',
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                            },
                            body: `searchLogin=${login.value}&searchEmail=${email.value}&searchPassword=${password.value}&searchPassword2=${password2.value}`,
                            })
                        .then(response =>response.text())
                        .then(window.location.href = '/login')
                    }
                    else {
                        example.innerHTML=null;
                    } 
                }  
             
    }
    function valid() {
            if(login.value.length<3) {
                login.style.border="1px solid red";
                example.innerHTML="login < 3 символов";
            }
            else {
                login.style.border="1px solid green";
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
