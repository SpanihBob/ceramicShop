<?
	include_once "$path/private/head.php";
    print_r($_SESSION['login']) ;

    echo "<pre>";
    echo "_POST:";
    print_r($_POST);
    echo "_FILES:";
    print_r($_FILES);
    echo "</pre>";
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
			//переместить загруженный файл из $_FILES['tmp_name'] в "download/имя файла.txt
			move_uploaded_file($_FILES['file1']['tmp_name'], "download/$nameFile");
			$dbPDO->query("UPDATE `users` SET `avatar`='$nameFile' WHERE `login`='$_SESSION[login]'");
		}
	}
    if(isset($_POST['personalAccountFormSubmit'])) {
		echo "ffdgfdgfdg";
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
					$queryCrockery = $dbPDO -> prepare("SELECT * FROM users WHERE login = '$_SESSION[login]'");
					$queryCrockery -> execute(); 
					$arr = $queryCrockery->fetch(PDO::FETCH_ASSOC);            
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
				<div>
					<div>Аватар:</div>
					<div id="changeAvatarDiv"></div>
				</div>
				<form action="" method="post" enctype="multipart/form-data">
					<!-- enctype="multipart/form-data" за отправку файлов теперь отвечает $_FILES -->
					<input type="file" name="file1" id="file1"><br>
					<input type="submit" value="Отправить" name="sendModifiedImage">
				</form>
				<button id="avaBackButton">Назад</button>
			</div>
			
			<div id="personalAccountForm">
				<form action="" method="post" class="personalAccountContent">
					<div>
						<div>Логин:</div>
						<input type="text" name="loginInput" id="loginInput">
					</div>
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
				</form>	
				<button id="backButton">Назад</button>
			</div>
		</div>

			<script>
				const personalAccountContent = document.querySelector(".personalAccountContent");
				const personalAccountForm = document.querySelector("#personalAccountForm");
				fetch("/system/getUserAccount.php")
				.then(response =>response.json())
				.then(data => {
					data.forEach(element => {
						console.log(element);
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


							loginDiv.textContent=`${data[0].login}`;
							emailDiv.textContent=`${data[0].email}`;
							nameDiv.textContent=`${data[0].name}`;
							lastnameDiv.textContent=`${data[0].lastname}`;
							countryDiv.textContent=`${data[0].country}`;
							cityDiv.textContent=`${data[0].city}`;
							streetDiv.textContent=`${data[0].street}`;
							houseDiv.textContent=`${data[0].house}`;
							apartmentDiv.textContent=`${data[0].apartment}`;
							postcodeDiv.textContent=`${data[0].postcode}`;
							timeDiv.textContent=`${data[0].time_signup * 1000}`;

							loginInput.setAttribute("value", `${data[0].login}`);
							emailInput.setAttribute("value", `${data[0].email}`);
							nameInput.setAttribute("value", `${data[0].name}`);
							lastnameInput.setAttribute("value", `${data[0].lastname}`);
							countryInput.setAttribute("value", `${data[0].country}`);
							cityInput.setAttribute("value", `${data[0].city}`);
							streetInput.setAttribute("value", `${data[0].street}`);
							houseInput.setAttribute("value", `${data[0].house}`);
							apartmentInput.setAttribute("value", `${data[0].apartment}`);
							postcodeInput.setAttribute("value", `${data[0].postcode}`);


							avatarImg.src=`../download/${data[0].avatar}`;
							loginDiv.classList.add("loginDivPersonalAccount");
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
							avaBackButton.onclick = () => {
								personalAccountContent.style.display = 'block';
								avaForm.style.display = 'none';
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