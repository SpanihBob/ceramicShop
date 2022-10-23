<?
	include_once "$path/private/head.php";
    // print_r($_SESSION['login']) ;
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
			<div class="personalAccountContent">								<!-- CONTENT -->
				<?
					$queryCrockery = $dbPDO -> prepare("SELECT * FROM users WHERE login = '$_SESSION[login]'");
					$queryCrockery -> execute(); 
					$arr = $queryCrockery->fetch(PDO::FETCH_ASSOC);            
				?>
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
				<div>
					<div>Аватар:</div>
					<div id="avatarDiv"></div>
				</div>				
				<button id="redactButton">Редактировать</button>
			</div>
			<form action="" method="post" id="personalAccountForm">
				<div class="personalAccountContent">
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
					<div>
						<div>Аватар:</div>
						<input type="image" src="" alt="" name="avatarInput" id="avatarInput">
					</div>
				</div>	
				<input type="submit" value="Изменить">			
				<button id="backButton">Назад</button>
			</form>			
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


							avatarImg.src=`../img/${data[0].avatar}`;
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
							backButton.onclick = () => {
								personalAccountContent.style.display = 'block';
								personalAccountForm.style.display = 'none';
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