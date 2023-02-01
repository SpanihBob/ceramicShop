// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################       функция добавления новой кнопки        ###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################

function addInputTypeButton(name, value) {
    let Button = document.createElement("input");
    Button.setAttribute("type","button");
    Button.setAttribute("name",name);
    Button.setAttribute("value",value);
    Button.classList.add("input");
    return Button;
}



// ############################################################################################################################################
// #####################################                                                            ###########################################
// #####################################     Функция для отправки товара в корзину (базу данных)    ###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

function addProductsToTheDatabase(elementId) {
    fetch("/system/addToCartAndFavor.php", {
        method: 'post',
		headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
		},
		body: `productId=${elementId}&cartOrFavor=cart`,
	})
}



// ############################################################################################################################################
// #####################################                                                            ###########################################
// #####################################   функция подтверждения удаления категории/товара(админ)   ###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

function delOrNot(question, parentDiv, tableSql, elementId, patch, systemFilePhp) {
	const popupMenu = document.createElement('div');				//сама менюшка
		const popupMenuParent = document.createElement('div');			//родитель

		const popupMenuQuestion = document.createElement('div');				//вопрос
		const ButtonDiv = document.createElement('div');				
			const popupMenuButtonNo = document.createElement('button');				//кнопка 'нет'
			const popupMenuButtonYes = document.createElement('button');			//кнопка 'да'

		popupMenuQuestion.innerText = question;
		popupMenuButtonNo.innerText = "Нет";
		popupMenuButtonYes.innerText = "Да";

		popupMenuParent.classList.add('popupMenuParent');
		popupMenu.classList.add('popupMenu');
		ButtonDiv.classList.add('ButtonDiv');

		popupMenu.appendChild(popupMenuQuestion);
		ButtonDiv.appendChild(popupMenuButtonNo);
		ButtonDiv.appendChild(popupMenuButtonYes);
		popupMenu.appendChild(ButtonDiv);

		popupMenuParent.appendChild(popupMenu);
		parentDiv.appendChild(popupMenuParent);

		popupMenuButtonNo.onclick = () => {			//если нажали нет
			popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
		}
		popupMenuButtonYes.onclick = () => {			//если нажали да
			let conf = confirm("Подтвердите действие");
			if(conf){
				fetch(`${systemFilePhp}`, {
						method: 'post',
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
						},
						body: `id=${elementId}&tableName=${tableSql}`,
				})
				// .then(response => response.text())                      
				// .then(data => {console.log(data)})
				popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
				window.location.href = patch;
			}			
		}
	}	

// ############################################################################################################################################
// #####################################                                                            ###########################################
// #####################################       		функция для извлечения данных из куки 		    ###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

	function getCookies(cookies) {
		let cokieArr = [];
		let cokies = document.cookie.split(";");
		cokies.forEach(cokel=>{
			let el = cokel.split("=");
			cokieArr.push(el)
		})
		let cook;
		cokieArr.forEach(el=>{
			if(el[0].includes(cookies)){
				const regex = new RegExp('\\b' + cookies + '\\b', 'gm');
				if(el[0].match(regex)) {cook = el[1]};
			}
			return cook;
		});
		return cook;
	}
	console.log(getCookies('user'));

// ############################################################################################################################################
// #####################################                                                            ###########################################
// #####################################     функция для скрытия кнопки 'в корзину'/'в избранное' 	###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

	function dysplayNoneOrBlock(arr, el, a, b){
		if(arr.includes(el)){
						a.style.display = "block";
						b.style.display = "none";
		}
		else {									
			a.style.display = "none";
			b.style.display = "block";
		}
	}

// ############################################################################################################################################
// #####################################                                                            ###########################################
// #####################################        функция для незарегистрированого пользователя       ###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

function loginOrSignup(parent) {
		const popupMenu = document.createElement('div');				//сама менюшка
		const popupMenuParent = document.createElement('div');			//родитель

		const popupMenuQuestion = document.createElement('div');				//вопрос

		const ButtonDiv = document.createElement('div');	
			const popupMenuButtonYes = document.createElement('button');				//кнопка 'да'

		popupMenuQuestion.innerText = "Зарегистрируйтесь или войдите в учетную запись чтобы купить товар";
		popupMenuButtonYes.innerText = "Ок";

		popupMenuParent.classList.add('popupMenuParent');
		popupMenu.classList.add('popupMenu');
		ButtonDiv.classList.add('ButtonDivUnregisteredUser');

		popupMenu.appendChild(popupMenuQuestion);
		ButtonDiv.appendChild(popupMenuButtonYes);
		popupMenu.appendChild(ButtonDiv);

		popupMenuParent.appendChild(popupMenu);
		parent.appendChild(popupMenuParent);

		popupMenuButtonYes.onclick = () => {								//если нажали да
			popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
		}
	}

// ############################################################################################################################################
// #####################################                                                            ###########################################
// ##################################### 			функция подтверждения удаления товара			###########################################
// ##################################### 					из корзины/избранного					###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

	function removeItemFromFavorAndCart(parent, name, image, product_id, filePhp, patch) {
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
		popupMenuQuestionName.innerText = `${name}`;
		popupMenuButtonNo.innerText = "Нет";
		popupMenuButtonYes.innerText = "Да";
		popupMenuQuestionImage.setAttribute("src",`../img1/${image.split(", ")[0]}`);

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
		parent.appendChild(popupMenuParent);

		popupMenuButtonNo.onclick = () => {			//если нажали нет
			popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
		}
		popupMenuButtonYes.onclick = () => {			//если нажали да
			fetch("/system/delToFavorAndCart.php", {
						method: 'post',
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
						},
						body: `productId=${product_id}&filePhp=${filePhp}`,
			})
			popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
			window.location.href = patch;
		}
	}

// ############################################################################################################################################
// #####################################                                                            ###########################################
// ##################################### 	функция будет менять колличество товара в корзине 		###########################################
// ##################################### 			(c.237 Д.Флэнаган - JavaScript)					###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################
						
	function counter(element_count) {
		if(element_count){
			let count = element_count;
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
	}