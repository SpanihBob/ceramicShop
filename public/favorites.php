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
				<h1>Избранное</h1>
			</div>	
            <script>
				const cartContent = document.getElementsByClassName('cartContent');
				// console.log(cartContent);
				window.onload = () => {
					fetch(`/system/removeFromFavor.php`)                          //подключаемся к файлу /system/postbooks.php                
					.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
					.then(data => {						
						// console.log(data[0]);
						if(data[0]==undefined){
							const favorIsEmpty = document.createElement('div');
							favorIsEmpty.innerText="В избранном пока ничего нет";
							cartContent[0].appendChild(favorIsEmpty);
						}
						else{
							data.forEach(element => {
							// console.log(element);
							const cartParentDiv = document.createElement('div');
								const imgDiv = document.createElement('div');
									const img = document.createElement('img');  //картинка
								
								const infoDiv = document.createElement('div');  //
									const nameDiv = document.createElement('div');//имя
									const delCrockeryDiv = document.createElement('div');//удаление товара
									const summDiv = document.createElement('div');//цена итоговая
									const amountDiv = document.createElement('div');//кол-во
								cartParentDiv.id = element.id;
								cartParentDiv.classList.add('cartProduct');
								imgDiv.classList.add('cartProductImgDiv');
								infoDiv.classList.add('cartInfoDiv');
								// amountDiv.classList.add('cartAmountDiv');
								delCrockeryDiv.classList.add('cartDelProduct');

								img.setAttribute("src",`../img1/${element.poster}`);
								nameDiv.innerText = `${element.name}`;
								summDiv.innerText = `${element.price}`;
								amountDiv.innerText = `${element.description}`;

								imgDiv.appendChild(img);

								infoDiv.appendChild(nameDiv);
								infoDiv.appendChild(delCrockeryDiv);
								infoDiv.appendChild(amountDiv);
								infoDiv.appendChild(summDiv);

								cartParentDiv.appendChild(imgDiv);
								cartParentDiv.appendChild(infoDiv);
								
								cartContent[0].appendChild(cartParentDiv);

								cartParentDiv.onclick = (event) => {					//счетчик колличества товара в корзине
									// console.log(event.target.className);	
									if(event.target.className == "cartDelProduct") {
										removeItemFromFavor()
									}
									summDiv.innerText = `${element.price}`;	// выводим колличество_товара*цена_товара

									fetch("/system/updateToCart.php", {
										method: 'post',
										headers: {
											"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
										},
										body: `productId=${element.product_id}&productCount=${numDiv.innerText}`,
										})
									// //____________________функция подтверждения удаления товара из корзины____________________________________________
										function removeItemFromFavor() {
											const popupMenu = document.createElement('div');				//сама менюшка
											const popupMenuParent = document.createElement('div');			//родитель

											const popupMenuQuestion = document.createElement('div');				//вопрос
											
											const popupMenuQuestionImageParent = document.createElement('div');				//картинка родитель
												const popupMenuQuestionImage = document.createElement('img');				//картинка
												const popupMenuQuestionName = document.createElement('div');				

											const ButtonDiv = document.createElement('div');				
												const popupMenuButtonNo = document.createElement('button');				//кнопка 'нет'
												const popupMenuButtonYes = document.createElement('button');				//кнопка 'да'

											popupMenuQuestion.innerText = "Вы уверены, что хотите удалить данный товар?";
											popupMenuQuestionName.innerText = `${element.name}`;
											popupMenuButtonNo.innerText = "Нет";
											popupMenuButtonYes.innerText = "Да";
											popupMenuQuestionImage.setAttribute("src",`../img1/${element.poster}`);

											popupMenuParent.classList.add('popupMenuParent');
											popupMenu.classList.add('popupMenu');
											popupMenuQuestionImage.classList.add('popupMenuQuestionImage');
											popupMenuQuestionImageParent.classList.add('popupMenuQuestionImageParent');
											ButtonDiv.classList.add('ButtonDiv');

											// popupMenuButtonNo.id = "popupMenuButtonNo";
											// popupMenuButtonYes.id = "popupMenuButtonYes";

											popupMenuQuestionImageParent.appendChild(popupMenuQuestionImage);

											popupMenu.appendChild(popupMenuQuestion);
											popupMenuQuestionImageParent.appendChild(popupMenuQuestionImage);
											popupMenuQuestionImageParent.appendChild(popupMenuQuestionName);
											popupMenu.appendChild(popupMenuQuestionImageParent);
											ButtonDiv.appendChild(popupMenuButtonNo);
											ButtonDiv.appendChild(popupMenuButtonYes);
											popupMenu.appendChild(ButtonDiv);

											popupMenuParent.appendChild(popupMenu);
											cartContent[0].appendChild(popupMenuParent);

											popupMenuButtonNo.onclick = () => {			//если нажали нет
												popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
											}
											popupMenuButtonYes.onclick = () => {			//если нажали да
												fetch("/system/delToFavor.php", {
												method: 'post',
												headers: {
													"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
												},
												body: `productId=${element.product_id}`,
												})
												popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
												window.location.href = '/favorites'
											}
										}
											
									// //________________________________________________________________________________________________________________
									
								} 
							})
						}
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
