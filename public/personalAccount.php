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
						echo <<<html
								<div>$arr[login] </div>
								<div>$arr[email] </div>
								<div>$arr[name] </div>
								<div>$arr[lastname] </div>
								<div>$arr[country] </div>
								<div>$arr[city] </div>
								<div>$arr[street] </div>
								<div>$arr[house] </div>
								<div>$arr[apartment] </div>
								<div>$arr[postcode] </div>
								<img src="../img/$arr[avatar]" alt="">
								<div>$arr[time_signup] </div>
							html;
				?>




			</div>
			<div class="personalAccountForm"></div>
		</div>

			<script>
				const personalAccountContent = document.querySelector(".personalAccountContent");
				const personalAccountForm = document.querySelector(".personalAccountForm");
				fetch("/system/getUserAccount.php")
				.then(response =>response.json())
				.then(data => {
					// console.log(data);
					data.forEach(element => {
						// console.log(element);
						const parentDiv = document.createElement("div");

							const loginDiv = document.createElement("div");
							const emailDiv = document.createElement("div");
							const nameDiv = document.createElement("div");
							const lastnameDiv = document.createElement("div");
							const countryDiv = document.createElement("div");
							const cityDiv = document.createElement("div");
							const streetDiv = document.createElement("div");
							const houseDiv = document.createElement("div");
							const apartmentDiv = document.createElement("div");
							const postcodeDiv = document.createElement("div");
							const avatarDiv = document.createElement("div");
								const avatarImg = document.createElement("img");
							const timeDiv = document.createElement("div");


							personalAccountContent.appendChild(loginDiv);
							personalAccountContent.appendChild(emailDiv);
							personalAccountContent.appendChild(nameDiv);
							personalAccountContent.appendChild(lastnameDiv);
							personalAccountContent.appendChild(countryDiv);
							personalAccountContent.appendChild(cityDiv);
							personalAccountContent.appendChild(streetDiv);
							personalAccountContent.appendChild(houseDiv);
							personalAccountContent.appendChild(apartmentDiv);
							personalAccountContent.appendChild(postcodeDiv);
							personalAccountContent.appendChild(avatarDiv);
							personalAccountContent.appendChild(timeDiv);
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