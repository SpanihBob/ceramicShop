<?
	include_once "$path/private/head.php";
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
				<div id="mainContent">								<!-- CONTENT -->				
					
				</div>
			</div>
			<script>
				window.onload = () => {
					fetch(`/system/addToMain.php`)                          //подключаемся к файлу /system/postbooks.php                
					.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
					.then(data => {

						const mainImgParentDiv = document.createElement('div');			//создали родительский div для главной картинки
							const mainImg_0 = document.createElement('img');			//создали главную картинку
								mainImg_0.setAttribute("src",`../img1/${data[0].img}`)	//добавили в нее изображение
							const mainTextDiv_0 = document.createElement('div');		//создали div для главного текста
							const mainText_0 = document.createTextNode(`${data[0].text}`);//создали главный текст

							mainImgParentDiv.classList.add("mainImgParentDiv");
							mainTextDiv_0.classList.add("mainTextDiv_0");
							mainImg_0.classList.add("imgOpacity");

						const mainCardParentDiv = document.createElement('div');		//создали родительский div для карточек
						mainCardParentDiv.classList.add("mainCardParentDiv");

						for(let i = 1; i < data.length; i++) {
							const mainCardDiv = document.createElement('div');			//создали div для карточки
							const mainImg = document.createElement('img');				//создали картинку
								mainImg.setAttribute("src",`../img1/${data[i].img}`)		//добавили в нее изображение
							const mainTextDiv = document.createElement('div');		//создали div для главного текста
							const mainText = document.createTextNode(`${data[i].text}`);//создали главный текст

							mainCardDiv.id = (`mainCard${data[i].id}`);
							mainImg.classList.add("mainImg");
							mainImg.classList.add("imgOpacity");
							mainTextDiv.classList.add("mainTextDiv");

							mainTextDiv.appendChild(mainText);
							if(i%2!=0){
								mainCardDiv.appendChild(mainImg);
								mainCardDiv.appendChild(mainTextDiv);
								mainCardParentDiv.appendChild(mainCardDiv);
							}
							else {
								mainCardDiv.appendChild(mainTextDiv);
								mainCardDiv.appendChild(mainImg);							
								mainCardParentDiv.appendChild(mainCardDiv);
							}
						}					
						mainTextDiv_0.appendChild(mainText_0);
						mainImgParentDiv.appendChild(mainImg_0);
						mainContent.appendChild(mainImgParentDiv);
						mainContent.appendChild(mainTextDiv_0);
						mainContent.appendChild(mainCardParentDiv);

						let image = document.querySelectorAll(".imgOpacity");
						image.forEach(element => {
							if(window.getComputedStyle(element, null).opacity==0){
								element.style.opacity = 1;
						}
						});
						
						
						
					})					
				}
						
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>
