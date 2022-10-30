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
			<div class="cartContent">								<!-- CONTENT -->
				<h1>Корзина</h1>
			</div>	
            <script>
				const cartContent = document.getElementsByClassName('cartContent');
				console.log(cartContent);
				window.onload = () => {
					fetch(`/system/addToCart.php`)                          //подключаемся к файлу /system/postbooks.php                
					.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
					.then(data => {
                        data.forEach(element => {
						console.log(element);
						const cartParentDiv = document.createElement('div');
                            const imgDiv = document.createElement('div');
                                const img = document.createElement('img');  //картинка
                            
                            const infoDiv = document.createElement('div');  //
                                const nameDiv = document.createElement('div');//имя
                                const delCrockeryDiv = document.createElement('div');//удаление товара
                                const summDiv = document.createElement('div');//цена итоговая
                                const amountDiv = document.createElement('div');//кол-во
                                    const delDiv = document.createElement('div');//del
                                    const numDiv = document.createElement('div');//number
                                    const addDiv = document.createElement('div');//add

							cartParentDiv.id = element.id;
							cartParentDiv.classList.add('cartProduct');
							imgDiv.classList.add('cartProductImgDiv');
							infoDiv.classList.add('cartInfoDiv');
							amountDiv.classList.add('cartAmountDiv');
							delCrockeryDiv.classList.add('cartDelProduct');

							img.setAttribute("src",`../img1/${element.poster}`);
							nameDiv.innerText = `${element.name}`;
							delDiv.innerText = `-`;
							numDiv.innerText = `${element.count}`;
							addDiv.innerText = `+`;
							summDiv.innerText = `${element.price * numDiv.innerText}`;

							imgDiv.appendChild(img);

							amountDiv.appendChild(delDiv);
							amountDiv.appendChild(numDiv);
							amountDiv.appendChild(addDiv);

							infoDiv.appendChild(nameDiv);
							infoDiv.appendChild(delCrockeryDiv);
							infoDiv.appendChild(amountDiv);
							infoDiv.appendChild(summDiv);

							cartParentDiv.appendChild(imgDiv);
							cartParentDiv.appendChild(infoDiv);
							
							cartContent[0].appendChild(cartParentDiv);











//          создаем корзину для выбранных товаров и надо добавить возможность добавления в карзину






						// 	const mainImg_0 = document.createElement('img');			//создали главную картинку
						// 		mainImg_0.setAttribute("src",`../img1/${data[0].img}`)	//добавили в нее изображение
						// 	const mainTextDiv_0 = document.createElement('div');		//создали div для главного текста
						// 	const mainText_0 = document.createTextNode(`${data[0].text}`);//создали главный текст

						// 	mainImgParentDiv.classList.add("mainImgParentDiv");
						// 	mainTextDiv_0.classList.add("mainTextDiv_0");
						// 	mainImg_0.classList.add("imgOpacity");

						// const mainCardParentDiv = document.createElement('div');		//создали родительский div для карточек
						// mainCardParentDiv.classList.add("mainCardParentDiv");

						// for(let i = 1; i < data.length; i++) {
						// 	const mainCardDiv = document.createElement('div');			//создали div для карточки
						// 	const mainImg = document.createElement('img');				//создали картинку
						// 		mainImg.setAttribute("src",`../img1/${data[i].img}`)		//добавили в нее изображение
						// 	const mainTextDiv = document.createElement('div');		//создали div для главного текста
						// 	const mainText = document.createTextNode(`${data[i].text}`);//создали главный текст

						// 	mainCardDiv.id = (`mainCard${data[i].id}`);
						// 	mainImg.classList.add("mainImg");
						// 	mainImg.classList.add("imgOpacity");
						// 	mainTextDiv.classList.add("mainTextDiv");

						// 	mainTextDiv.appendChild(mainText);
						// 	if(i%2!=0){
						// 		mainCardDiv.appendChild(mainImg);
						// 		mainCardDiv.appendChild(mainTextDiv);
						// 		mainCardParentDiv.appendChild(mainCardDiv);
						// 	}
						// 	else {
						// 		mainCardDiv.appendChild(mainTextDiv);
						// 		mainCardDiv.appendChild(mainImg);							
						// 		mainCardParentDiv.appendChild(mainCardDiv);
						// 	}
						// }					
						// mainTextDiv_0.appendChild(mainText_0);
						// mainImgParentDiv.appendChild(mainImg_0);
						// mainContent.appendChild(mainImgParentDiv);
						// mainContent.appendChild(mainTextDiv_0);
						// mainContent.appendChild(mainCardParentDiv);

						// let image = document.querySelectorAll(".imgOpacity");
						// image.forEach(element => {
						// 	if(window.getComputedStyle(element, null).opacity==0){
						// 		element.style.opacity = 1;
						// }
						// });
						
						
                        })
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
