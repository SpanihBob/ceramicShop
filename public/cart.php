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
				// console.log(cartContent);
				window.onload = () => {
					fetch(`/system/removeFromFavorAndCart.php`, {
										method: 'post',
										headers: {
											"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
										},
										body: `filePhp=cart`,
										})                                         
					.then(response => response.json())                                
					.then(data => {						
						// console.log(data[0]);
						if(data[0]==undefined){
							const shoppingCartIsEmpty = document.createElement('div');
							shoppingCartIsEmpty.innerText="Корзина пустая";
							cartContent[0].appendChild(shoppingCartIsEmpty);
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
										const delDiv = document.createElement('div');//del
										const numDiv = document.createElement('div');//number
										const addDiv = document.createElement('div');//add

								cartParentDiv.id = element.id;
								cartParentDiv.classList.add('cartProduct');
								imgDiv.classList.add('cartProductImgDiv');
								infoDiv.classList.add('cartInfoDiv');
								amountDiv.classList.add('cartAmountDiv');
								delCrockeryDiv.classList.add('cartDelProduct');

								delDiv.classList.add('delProduct');
								numDiv.classList.add('productQuantity');
								addDiv.classList.add('addProduct');

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
						// //_______________функция будет менять колличество товара в корзине (c.237 Д.Флэнаган - JavaScript)________________
								
								function counter(productCount) {
									if(element.count){
										let count = element.count;
										return {
											add: function() {
													count++
													return count;
												},
											del: function() {
													count--;
													return count;
												},
											reset: function() {
													return count=0;
												}
										};
									}
									else {console.log('корзина пуста');}						
								}			
						// //________________________________________________________________________________________________________________

								let c = counter();		
								cartParentDiv.onclick = (event) => {					//счетчик колличества товара в корзине
									// console.log(event.target.className);	
									if(event.target.className == "addProduct") {
										numDiv.innerText = c.add();
									} 
									else if((event.target.className == "delProduct") && (numDiv.innerText>0)) {
										if(numDiv.innerText==1){
											removeItemFromCart();
											return;
										}
										numDiv.innerText = c.del();
										
									}
									else if(event.target.className == "cartDelProduct") {
										// numDiv.innerText = c.reset();
										removeItemFromCart()
									}
									summDiv.innerText = `${element.price * numDiv.innerText}`;	// выводим колличество_товара*цена_товара

									fetch("/system/updateToCart.php", {
										method: 'post',
										headers: {
											"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
										},
										body: `productId=${element.product_id}&productCount=${numDiv.innerText}`,
										})
									// //____________________функция подтверждения удаления товара из корзины____________________________________________
										function removeItemFromCart() {
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
												fetch("/system/delToFavorAndCart.php", {
												method: 'post',
												headers: {
													"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
												},
												body: `productId=${element.product_id}&filePhp=favor`,
												})
												popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
												window.location.href = '/cart';
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
