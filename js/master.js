 window.onload=function(){
  //тут пишем код, который будет ожидать загрузки DOM    
 }
 //здесь в обычном режиме
 
// ###########################################       функция добавления новой кнопки       ###################################################
function addInputTypeButton(name, value) {
    let Button = document.createElement("input");
    Button.setAttribute("type","button");
    Button.setAttribute("name",name);
    Button.setAttribute("value",value);
    Button.classList.add("input");
    return Button;
}
// ###########################################      функция добавления новой кнопки(end)    ###################################################
// ###########################################
// ###########################################
// ###########################################
// ###########################################
// ###########################################       функция для избранного и корзины       ###################################################
function favoritesAndCart(filePhp, patch, text) {
    const cartContent = document.getElementsByClassName('cartContent');
		window.onload = () => {
				fetch(`/system/removeFromFavorAndCart.php`, {
								method: 'post',
								headers: {
									"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
								},
								body: `filePhp=${filePhp}`,
								})                                        
				.then(response => response.json())                                  
				.then(data => {	
					if(data[0]==undefined){
						const favorIsEmpty = document.createElement('div');
						favorIsEmpty.innerText=text;
						// favorIsEmpty.style="justify-self: center;"
						cartContent[0].appendChild(favorIsEmpty);
					}
					else{
						data.forEach(element => {
						const cartParentDiv = document.createElement('div');
							const imgDiv = document.createElement('div');
								const img = document.createElement('img');  //картинка
							
							const infoDiv = document.createElement('div');  //
								const nameDiv = document.createElement('div');//имя
									const delCrockeryDiv = document.createElement('div');//удаление товара
									const summDiv = document.createElement('div');//цена итоговая
									const amountDiv = document.createElement('div');//кол-во
									const delDiv = document.createElement('button');//del
									const numDiv = document.createElement('div');//number
									const addDiv = document.createElement('button');//add

								cartParentDiv.id = element.id;
								cartParentDiv.classList.add('cartProduct');
								imgDiv.classList.add('cartProductImgDiv');
								infoDiv.classList.add('cartInfoDiv');
								delCrockeryDiv.classList.add('cartDelProduct');
								if(filePhp=="cart"){
									amountDiv.classList.add('cartAmountDiv');
								}
								else if(filePhp=="favor"){
									amountDiv.classList.add('favorAmountDiv');
								}
								

								summDiv.classList.add('finalPriceDiv');
								delDiv.classList.add('delProduct');
								numDiv.classList.add('productQuantity');
								addDiv.classList.add('addProduct');

								img.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
								nameDiv.innerText = `${element.name}`;
								
								if(filePhp=='cart'){
									delDiv.innerText = `-`;
									numDiv.innerText = `${element.count}`;
									addDiv.innerText = `+`;
									summDiv.innerText = `Стоимость:${element.price * numDiv.innerText}₽`;
									let sumDelDiv = document.createElement("div");
									sumDelDiv.classList.add("sumDelDiv")
									sumDelDiv.appendChild(delDiv);
									sumDelDiv.appendChild(numDiv);
									sumDelDiv.appendChild(addDiv);
									amountDiv.appendChild(sumDelDiv);
								}
								else if(filePhp=='favor'){
									summDiv.innerText = `${element.price}`;
									amountDiv.innerText = `${element.description}`;
								}								

								imgDiv.appendChild(img);

								infoDiv.appendChild(nameDiv);
								infoDiv.appendChild(delCrockeryDiv);
								infoDiv.appendChild(amountDiv);
								infoDiv.appendChild(summDiv);

								cartParentDiv.appendChild(imgDiv);
								cartParentDiv.appendChild(infoDiv);
								
								cartContent[0].appendChild(cartParentDiv);

								// //_______________функция будет менять колличество товара в корзине (c.237 Д.Флэнаган - JavaScript)________________
								
								function counter() {
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
								if(filePhp == 'cart'){
										// console.log(event.target.className);	
									if(event.target.className == "addProduct") {
										numDiv.innerText = c.add();
									} 
									else if((event.target.className == "delProduct") && (numDiv.innerText>0)) {
										if(numDiv.innerText==1){
											removeItemFromFavorAndCart();
											return;
										}
										numDiv.innerText = c.del();
										
									}
									else if(event.target.className == "cartDelProduct") {
										// numDiv.innerText = c.reset();
										removeItemFromFavorAndCart()
									}
									summDiv.innerText = `Стоимость:${element.price * numDiv.innerText}₽`;	// выводим колличество_товара*цена_товара

									fetch("/system/updateToCart.php", {
													method: 'post',
													headers: {
														"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
													},
													body: `productId=${element.product_id}&productCount=${numDiv.innerText}`,
										})
								}
								if(filePhp == 'favor'){
									if(event.target.className == "cartDelProduct") {
										removeItemFromFavorAndCart()
									}
									summDiv.innerText = `${element.price}`;	// выводим цена_товара
								}
								

									// //____________________функция подтверждения удаления товара из корзины____________________________________________
										function removeItemFromFavorAndCart() {
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
											popupMenuQuestionImage.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);

											popupMenuParent.classList.add('popupMenuParent');
											popupMenu.classList.add('popupMenu');
											popupMenuQuestionImage.classList.add('popupMenuQuestionImage');
											popupMenuQuestionImageParent.classList.add('popupMenuQuestionImageParent');
											ButtonDiv.classList.add('ButtonDiv');

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
															body: `productId=${element.product_id}&filePhp=${filePhp}`,
												})
												popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
												window.location.href = patch;
											}
										}											
									// //________________________________________________________________________________________________________________									
								} 
								imgDiv.onclick = () => {
									let productId = imgDiv.parentNode.id;				
										fetch("/system/sessionFavorAndCart.php", {
											method: 'post',
											headers: {
												"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
											},
											body: `productIdCartAndFavor=${productId}`,
										})
										window.location.href = "/fullProduct";							
								}
							})
						}
					})
				}
}
// // ###########################################      функция для избранного и корзины(end)    ###################################################
// ###########################################
// ###########################################
// ###########################################
// ###########################################
// //_________________________________________________Функция для отправки товара в корзину (базу данных)________________________________________________

function addProductsToTheDatabase(elementId) {
	fetch("/system/addToCartAndFavor.php", {
		method: 'post',
		headers: {
			"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
		},
		body: `productId=${elementId}&cartOrFavor=cart`,
	})
}
// ###########################################
// ###########################################
// ###########################################
// ###########################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// // ###########################################      функция для загрузки категории    ###################################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function loadCategory(cat, productCat){
	fetch(`/system/changeToCategoryPage.php`, {
			method: 'post',
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
			},
			body: `tableName=${cat}`
			})                                        
	.then(response => response.json())                                  
	.then(data => {
		const content = document.getElementById("content");
		data.forEach(element => {
			console.log(element);
			let subcategoryDiv = document.createElement("div");
			let subcategoryImg = document.createElement("img");
			let subcategoryText = document.createElement("div");

			subcategoryDiv.setAttribute("data-id",`${element.id}`);
			subcategoryImg.setAttribute("src",`../img1/${element.image}`);
			subcategoryText.innerText=`${element.name}`;
			
			subcategoryDiv.classList.add("crockeryCard");
			subcategoryImg.classList.add("crockeryImg");
			subcategoryText.classList.add("crockeryText");

			subcategoryDiv.appendChild(subcategoryImg);
			subcategoryDiv.appendChild(subcategoryText);
			content.appendChild(subcategoryDiv);

			subcategoryDiv.onclick = () => {
				let subcategoryId = subcategoryDiv.getAttribute('data-id');		//получили id
					fetch("/system/getSubcategory.php", {
						method: 'post',
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
						},
						body: `subcategoryId=${subcategoryId}&productCat=${productCat}`,
					})
					.then(data=>
						{window.location.href = "/product"}
					)
			}
		})
	})
}
// ###########################################
// ###########################################
// ###########################################
// ###########################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// // #######################################      функция для вывода страницы продуктов     ###############################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function displayProductPage(pagePhp) {								//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товара на экран %%%%%%%%%%%%%%%%%%%%%%%%%%//
	fetch(`/system/${pagePhp}.php`)                                       
	.then(response => response.json())                                  
	.then(data => {						
		// console.log(data);
		if(data==false){
			crockeryContent.innerText = "По вашему запросу ничего не найдено...";
			crockeryContent.classList = "crockeryProductDataFalse";
		}
		data.forEach(element => {
			let productDiv = document.createElement("div");								//parent

			let imgDiv = document.createElement("div");	
				let img = document.createElement('img');							//создали картинку
				let mainImage = element.image.split(", ")[0];
				img.setAttribute("src",`../img1/${mainImage}`)						//for img

			let dataDiv = document.createElement("div");							//div для данных
			let name = element.name.replace(/^[a-zа-ё]/ug, m => m.toUpperCase());

				let nameDiv = document.createElement("div");					//название
					let nameText = document.createTextNode(`${name}`);

				let priceDiv = document.createElement("div");					//цена
					let priceText = document.createTextNode(`Цена: ${element.price} р.`);

				let amountDiv = document.createElement("div");					//колличество
					let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

				let dataDivAddToCartBtn = document.createElement("div");
					let dataDivAddToCartBtnText = document.createTextNode(`Добавить в корзину`);

				let dataDivAddToCartText = document.createElement("div");
					let dataDivAddToCartTextInfo = document.createTextNode(`Товар в корзине`);

		productDiv.classList.add("productDivCrockery");
		dataDiv.classList.add("dataProductDivCrockery");
		imgDiv.classList.add("imgProductCrockery");
		dataDivAddToCartBtn.classList.add("input");
		productDiv.setAttribute("data-id",element.id)

		nameDiv.appendChild(nameText);
		priceDiv.appendChild(priceText);
		amountDiv.appendChild(amountText);
		dataDivAddToCartBtn.appendChild(dataDivAddToCartBtnText);
		dataDivAddToCartText.appendChild(dataDivAddToCartTextInfo);
		
		imgDiv.appendChild(img);
		dataDiv.appendChild(nameDiv);
		dataDiv.appendChild(priceDiv);
		dataDiv.appendChild(amountDiv);
			dataDiv.appendChild(dataDivAddToCartText);
			dataDiv.appendChild(dataDivAddToCartBtn);
			
		productDiv.appendChild(imgDiv);
		productDiv.appendChild(dataDiv);

		crockeryContent.appendChild(productDiv);

//_______________________Функция пишет что товар в корзине(start)______________________________________________
	let userCartArr = [];					
	let userCart = (async function() {
		const response = await fetch(`/system/whatIsInTheCart.php`);
		const post = await response.json();
		return post;
	})					
	userCart().then(res=>{
		res.forEach(element =>userCartArr.push(element.product_id));
		
		function dysplayNoneOrBlock(a, b){
			if(userCartArr.includes(element.id)){
							a.style.display = "block";
							b.style.display = "none";
			}
			else {									
				a.style.display = "none";
				b.style.display = "block";
			}
		}
		dysplayNoneOrBlock(dataDivAddToCartText, dataDivAddToCartBtn);
	})
// //_________________________________________________Функция для отправки товара в корзину (базу данных)________________________________________________

function addProductsToTheDatabase() {
		fetch("/system/addToCartAndFavor.php", {
			method: 'post',
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
			},
			body: `productId=${element.id}&cartOrFavor=cart`,
		})
	}

	//########################			 нажимаем кнопку добавить в корзину  		###########################	
	let switchState = false;		
	productDiv.onclick = event => {									
		if(event.target == dataDivAddToCartBtn) {
			addProductsToTheDatabase();
			switchState = true;
			dataDivAddToCartText.style.display = "block";
			dataDivAddToCartBtn.style.display = "none";
		}
		//########################			 Выводим выбранный продукт  		###########################	
		if(event.target==img){
			let productDivAttribute = productDiv.getAttribute("data-id");
			
		if(element.id==productDivAttribute) {
			fetch("/system/getFullProduct.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `fullProduct=${element.id}`,
						})
						.then(
							window.location.href = '/fullProduct'
						)        
					}
				}
			}
		})   
	})
}

// ###########################################
// ###########################################
// ###########################################
// ###########################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// // #######################################      функция для страницы администратора     ###############################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getUsersToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод пользователей %%%%%%%%%%%%%%%%%%%%%%%%%%//	
	usersContainer.style.display = "grid";	
	categoryContainer.style.display = "none";	
	productContainer.style.display = "none";	
	adminContent.innerText = "";
	usersContainer.innerText = "";
	let admin_user_header = document.createElement("div");
	admin_user_header.innerHTML = `	<div>Login</div>
									<div>Имя</div>
									<div>Фамилия</div>
									<div>Подробнее</div>`;
	admin_user_header.classList.add("admin_user_header");								
	usersContainer.appendChild(admin_user_header);

	fetch(`/system/removeUserToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		// console.log(data);
		let user_id_array = [];
		data.forEach(element =>{
			if(!user_id_array.includes(element.user_id)) {
				user_id_array.push(element.user_id);

				let userCont = document.createElement("div");
				userCont.setAttribute("data-id",`${element.user_id}`);
				userCont.classList.add("admin_user");

				let userShopping = document.createElement("div");
				userShopping.classList.add("userShopping");

				let loginUser = document.createElement("div");							//login
					let loginUserText = document.createTextNode(`${element.login}`); 
				let nameUser = document.createElement("div");							//name
					let nameUserText = document.createTextNode(`${element.user_name}`); 
				let lastNameUser = document.createElement("div");						//last name
					let lastNameUserText = document.createTextNode(`${element.lastname}`); 
				let userButton = document.createElement("button");
					let userButtonText = document.createTextNode("Подробнее");
					userButton.classList.add("input");

				loginUser.appendChild(loginUserText);
				nameUser.appendChild(nameUserText);
				lastNameUser.appendChild(lastNameUserText);
				userButton.appendChild(userButtonText);		

				userCont.appendChild(loginUser);
				userCont.appendChild(nameUser);
				userCont.appendChild(lastNameUser);
				userCont.appendChild(userButton);
				
				usersContainer.appendChild(userCont);
				adminContent.appendChild(usersContainer);

				userButton.onclick = () => {
					let user_id = userButton.parentNode.getAttribute("data-id");
					if(element.user_id == user_id) {
						fetch(`/system/removeUserAndProductToAdmin.php`, {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `userId=${element.user_id}`,
						})            
						.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
						.then(data => {
							console.log(data);
							adminUserShopping.innerText="";
							adminTableHeader.innerHTML = `	<div>img</div>
													<div>Название</div>
													<div>id</div>
													<div>Остаток</div>
													<div>Заказ</div>`;
							adminTableHeader.classList.add("adminTableHeader");								
							adminUserShopping.appendChild(adminTableHeader);	
							data.forEach(element =>{
								
								let productInfoContainer = document.createElement("div");
									productInfoContainer.classList.add("userShoppingProduct");
								let productImage = document.createElement("img");
									productImage.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
								let productName = document.createElement("div");
									let productNameText = document.createTextNode(`${element.name}`);
									productName.appendChild(productNameText);
								let productId = document.createElement("div");
									let productIdText = document.createTextNode(`${element.product_id}`);
									productId.appendChild(productIdText);
								let productAmount = document.createElement("div");
									let productAmountText = document.createTextNode(`${element.amount}шт.`);
									productAmount.appendChild(productAmountText);
								let productCount = document.createElement("div");
									let productCountText = document.createTextNode(`${element.count}шт.`);
									productCount.appendChild(productCountText);

								productInfoContainer.appendChild(productImage);
								productInfoContainer.appendChild(productName);	
								productInfoContainer.appendChild(productId);	
								productInfoContainer.appendChild(productAmount);	
								productInfoContainer.appendChild(productCount);	
																	
								adminUserShopping.appendChild(productInfoContainer);	
								adminContent.appendChild(adminUserShopping);	
								usersContainer.style.display = "none";
								adminUserShopping.style.display = "grid";
							})
							let backButton = document.createElement("button");
							backButton.innerText = "Назад к списку пользователей"
							backButton.classList.add("input");
							backButton.id = "backButton";
							adminUserShopping.appendChild(backButton);

							backButton.onclick = () => {
								usersContainer.style.display = "grid";
								adminUserShopping.style.display = "none";
							}
						})
					}					
				}
			}	
		});
	})
}
// ###########################################
// ###########################################
// ###########################################
// ###########################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// // #######################################      функция для страницы администратора     ###############################################
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function getCategoryToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод категорий %%%%%%%%%%%%%%%%%%%%%%%%%%//
	usersContainer.style.display = "none";
	categoryContainer.style.display = "grid";	
	productContainer.style.display = "none";
	adminContent.innerText = "";
	categoryContainer.innerText = "";
	let categoryHeader = document.createElement("div");
	categoryHeader.classList.add("categoryHeader");
		categoryHeader.innerHTML = `<div>id</div>
									<div>Картинка</div>
									<div>Название</div>
									<div>Таблица SQL</div>
									<div>Изменить</div>
									<div>Удалить</div>
									`;
		categoryContainer.appendChild(categoryHeader);
	fetch(`/system/removeCategoryToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		data.forEach(element =>{
			// console.log(element);
			let catCont = document.createElement("div");
			catCont.classList.add("catCont");
			catCont.id = element.id;
			let idCont = document.createElement("div");
				idCont.innerText = `${element.id}`;
			let categoryNameCont = document.createElement("div");
				categoryNameCont.innerText = `${element.categoryName}`;
			let categoryMicroImageCont = document.createElement("div");
				let categoryMicroImg = document.createElement("img");
				categoryMicroImg.setAttribute("src", `../img/${element.categoryMicroImage}`)
			let categoryTableNameCont = document.createElement("div");
				categoryTableNameCont.innerText = `${element.categoryTableName}`;
			let changeCategory = document.createElement("button");
				changeCategory.innerText = "Изменить";
				changeCategory.classList.add("input");
			let delCategory = document.createElement("button");
				delCategory.innerText = "Удалить";
				delCategory.classList.add("input");
			
			categoryMicroImageCont.appendChild(categoryMicroImg);
			catCont.appendChild(idCont);
			catCont.appendChild(categoryMicroImageCont);
			catCont.appendChild(categoryNameCont);
			catCont.appendChild(categoryTableNameCont);
			catCont.appendChild(changeCategory);
			catCont.appendChild(delCategory);

			categoryContainer.appendChild(catCont);
			catCont.onclick = (e) => {
				if(e.target == changeCategory){
					console.log(catCont.id);
				}
				if(e.target == delCategory){
					console.log(catCont.id);
				}
			}
		})
		let addCategory = document.createElement("button");
			addCategory.classList.add("input");
			addCategory.innerText = "Добавить категорию";
			categoryContainer.appendChild(addCategory);
			adminContent.appendChild(categoryContainer);

			addCategory.onclick = () => {
				console.log("add");
			}
	})
}








function getProductToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товаров %%%%%%%%%%%%%%%%%%%%%%%%%%//
	usersContainer.style.display = "none";	
	categoryContainer.style.display = "none";	
	productContainer.style.display = "grid";
	productContainer.innerText = "";
	fetch(`/system/removeProductToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		console.log(data);
	})
}