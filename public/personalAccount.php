<?
	include_once "$path/private/head.php";
    // echo "<pre>";
	// print_r($_SESSION['login']) ;
    // print_r($_SESSION) ;
	

    // echo "_POST:";
    // print_r($_POST);
    // echo "_FILES:";
    // print_r($_FILES);
    // echo "</pre>";
   

    if(isset($_POST['sendModifiedImage'])) {
            // создаем регулярное выражение для поиска нужного формата
        // "/(\.png$)|(\.jpeg$)/" - регулярка
        // $_FILES['file1']['name'] - имя искомого файла
        // $arrImage - в какую переменную сохранить
        preg_match_all("/(\.png$)|(\.jpeg$)|(\.jfif$)|(\.jpg$)/", $_FILES['file1']['name'], $arrImage);

        // echo "расш загр файла:";
        // print_r($arrImage);

        $randomSalt=mt_rand(10000, 99999);//создаем случайное число от 10000 до 99999
        $nameFile = $_SESSION['login'].$randomSalt.$arrImage[0][0];        

        if(preg_match("/\w+((\.png$)|(\.jpeg$)|(\.jfif$)|(\.jpg$))/",$nameFile)) {
			//
			unlink($_SESSION['avatar']);
            //переместить загруженный файл из $_FILES['tmp_name'] в "download/имя файла.txt
            move_uploaded_file($_FILES['file1']['tmp_name'], "download/$nameFile");
            $dbPDO->query("UPDATE `users` SET `avatar`='$nameFile' WHERE `login`='$_SESSION[login]'");
			$_SESSION['avatar'] = "download/$nameFile";
        }
    }
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		//HEADER
		?>	

		<article class="article">						<!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			<div>
			<div class="personalAccountContent" id="personalAccountContent">								<!-- CONTENT -->
				<?
					// $queryCrockery = $dbPDO -> prepare("SELECT * FROM users WHERE login = '$_SESSION[login]'");
					// $queryCrockery -> execute(); 
					// $arr = $queryCrockery->fetch(PDO::FETCH_ASSOC);            
				?>
				<div>
					<div>Аватар:</div>
					<div id="avatarDiv"></div>
					<button id="changeAva">Сменить аватарку</button>
				</div>	
				<div>
					<div>Логин:</div>
					<div id="loginDiv"></div>
				</div>
				<div>
					<div>Почта:</div>
					<div id="emailDiv"></div>
				</div>
				<div>
					<div>Имя:</div>
					<div id="nameDiv"></div>
				</div>
				<div>
					<div>Фамилия:</div>
					<div id="lastnameDiv"></div>
				</div>
				<div>
					<div>Страна:</div>
					<div id="countryDiv"></div>
				</div>
				<div>
					<div>Город:</div>
					<div id="cityDiv"></div>
				</div>
				<div>
					<div>Улица:</div>
					<div id="streetDiv"></div>
				</div>
				<div>
					<div>Дом:</div>
					<div id="houseDiv"></div>
				</div>
				<div>
					<div>Квартира:</div>
					<div id="apartmentDiv"></div>
				</div>
				<div>
					<div>Почтовый индекс:</div>
					<div id="postcodeDiv"></div>
				</div>
				<div>
					<div>На сайте уже:</div>
					<div id="timeDiv"></div>
				</div>							
				<button id="redactButton">Редактировать</button>
			</div>

			<div id="avaForm">				
				<form action="" method="post" enctype="multipart/form-data" id="changeAvatarForm">
					<!-- enctype="multipart/form-data" за отправку файлов теперь отвечает $_FILES -->					
					<label>
						<input type="file" name="file1" id="file1"><br>
						<div id="sendFile">Выберете файл</div>
					</label>
					<input type="submit" value="Отправить" name="sendModifiedImage" id="sendModifiedImage">
				</form>
				<button id="avaBackButton">Назад</button>
			</div>
			
			<div id="personalAccountForm">
				<form action="" method="post" class="personalAccountContent">
					<div>
						<div>Почта:</div>
						<input type="text" name="emailInput" id="emailInput">
					</div>
					<div>
						<div>Имя:</div>
						<input type="text" name="nameInput" id="nameInput">
					</div>
					<div>
						<div>Фамилия:</div>
						<input type="text" name="lastnameInput" id="lastnameInput">
					</div>
					<div>
						<div>Страна:</div>
						<input type="text" name="countryInput" id="countryInput">
					</div>
					<div>
						<div>Город:</div>
						<input type="text" name="cityInput" id="cityInput">
					</div>
					<div>
						<div>Улица:</div>
						<input type="text" name="streetInput" id="streetInput">
					</div>
					<div>
						<div>Дом:</div>
						<input type="text" name="houseInput" id="houseInput">
					</div>
					<div>
						<div>Квартира:</div>
						<input type="text" name="apartmentInput" id="apartmentInput">
					</div>
					<div>
						<div>Почтовый индекс:</div>
						<input type="text" name="postcodeInput" id="postcodeInput">
					</div>
					<input type="submit" value="Сохранить изменения" id="personalAccountFormSubmit" name="personalAccountFormSubmit">
					<button id="backButton">Назад</button>
				</form>	
				
			</div>
		</div>

			<script>
				const personalAccountContent = document.querySelector(".personalAccountContent");
				const personalAccountForm = document.querySelector("#personalAccountForm"); 
				const changeAvatarForm = document.querySelector("#changeAvatarForm"); 
				fetch("/system/getUserAccount.php")
				.then(response =>response.json())
				.then(data => {
					data.forEach(element => {
						// console.log(element);
						const parentDiv = document.createElement("div");

							const loginDiv = document.getElementById("loginDiv");
							const emailDiv = document.getElementById("emailDiv");
							const nameDiv = document.getElementById("nameDiv");
							const lastnameDiv = document.getElementById("lastnameDiv");
							const countryDiv = document.getElementById("countryDiv");
							const cityDiv = document.getElementById("cityDiv");
							const streetDiv = document.getElementById("streetDiv");
							const houseDiv = document.getElementById("houseDiv");
							const apartmentDiv = document.getElementById("apartmentDiv");
							const postcodeDiv = document.getElementById("postcodeDiv");
							const avatarDiv = document.getElementById("avatarDiv");
								const avatarImg = document.createElement("img");
							const timeDiv = document.getElementById("timeDiv");

							let email_value;
							let us_name_value;
							let lastname_value;
							let country_value;
							let city_value;
							let street_value;
							let house_value;
							let apartment_value;
							let postcode_value;

							if(!data[0].email){
								email_value="";
							} else email_value=`${data[0].email}`;

							if(!data[0].user_name){
								us_name_value="";
							} else us_name_value=`${data[0].user_name}`;

							if(!data[0].lastname){
								lastname_value="";
							} else lastname_value=`${data[0].lastname}`;

							if(!data[0].country){
								country_value="";
							} else country_value=`${data[0].country}`;

							if(!data[0].city){
								city_value="";
							} else city_value=`${data[0].city}`;

							if(!data[0].street){
								street_value="";
							} else street_value=`${data[0].street}`;

							if(!data[0].house){
								house_value="";
							} else house_value=`${data[0].house}`;

							if(!data[0].apartment){
								apartment_value="";
							} else apartment_value=`${data[0].apartment}`;

							if(!data[0].postcode){
								postcode_value="";
							} else postcode_value=`${data[0].postcode}`;

							loginDiv.textContent=`${data[0].login}`;
							emailDiv.textContent=`${email_value}`;
							nameDiv.textContent=`${us_name_value}`;
							lastnameDiv.textContent=`${lastname_value}`;
							countryDiv.textContent=`${country_value}`;
							cityDiv.textContent=`${city_value}`;
							streetDiv.textContent=`${street_value}`;
							houseDiv.textContent=`${house_value}`;
							apartmentDiv.textContent=`${apartment_value}`;
							postcodeDiv.textContent=`${postcode_value}`;
							timeDiv.textContent=`${data[0].time_signup * 1000}`;

							emailInput.setAttribute("value", `${email_value}`);
							nameInput.setAttribute("value", `${us_name_value}`);
							lastnameInput.setAttribute("value", `${lastname_value}`);
							countryInput.setAttribute("value", `${country_value}`);
							cityInput.setAttribute("value", `${city_value}`);
							streetInput.setAttribute("value", `${street_value}`);
							houseInput.setAttribute("value", `${house_value}`);
							apartmentInput.setAttribute("value", `${apartment_value}`);
							postcodeInput.setAttribute("value", `${postcode_value}`);


							avatarImg.src=`../download/${data[0].avatar}`;
							emailDiv.classList.add("emailDivPersonalAccount");
							nameDiv.classList.add("nameDivPersonalAccount");
							lastnameDiv.classList.add("lastnameDivPersonalAccount");
							countryDiv.classList.add("countryDivPersonalAccount");
							streetDiv.classList.add("streetDivPersonalAccount");
							houseDiv.classList.add("houseDivPersonalAccount");
							apartmentDiv.classList.add("apartmentDivPersonalAccount");
							postcodeDiv.classList.add("postcodeDivPersonalAccount");
							timeDiv.classList.add("timeDivPersonalAccount");
							avatarImg.classList.add("avatarImgPersonalAccount");

							avatarDiv.appendChild(avatarImg);

							redactButton.onclick = () => {
								personalAccountContent.style.display = 'none';
								personalAccountForm.style.display = 'grid';
							}
							changeAva.onclick = () => {
								personalAccountContent.style.display = 'none';
								avaForm.style.display = 'grid';
							}
							backButton.onclick = () => {
								personalAccountContent.style.display = 'block';
								personalAccountForm.style.display = 'none';
							}
							avaBackButton.onclick = (event) => {
								event.preventDefault;
								personalAccountContent.style.display = 'block';
								avaForm.style.display = 'none';
							}
							personalAccountForm.onsubmit = (event) => {						//изменение данных пользователя в БД
								event.preventDefault();
								fetch("/system/changeAccountInformation.php", {
									method: 'post',
									headers: {
										"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
									},
									body: `changeEmail=${emailInput.value}&changeName=${nameInput.value}&changeLastname=${lastnameInput.value}&changeCountry=${countryInput.value}&changeCity=${cityInput.value}&changeStreet=${streetInput.value}&changeHouse=${houseInput.value}&changeApartment=${apartmentInput.value}&changePostcode=${postcodeInput.value}&personalAccountFormSubmit=${personalAccountFormSubmit.value}`,
									})
								.then(response =>response.text())
								.then(//data=>{console.log(data)}
									window.location.href = '/account'
									)
                    		}
					})
				})

				
			</script>
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>