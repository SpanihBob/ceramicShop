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
// #####################################       функция подтверждения удаления категории/товара      ###########################################
// #####################################                                                            ###########################################
// ############################################################################################################################################

function delOrNot(question, parentDiv, tableSql, elementId, patch) {
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
				fetch(`/system/adminDelCategory.php`, {
						method: 'post',
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
						},
						body: `id=${elementId}&tableName=${tableSql}`,
				})
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
		console.log(cokieArr);
		let cook;
		cokieArr.forEach(el=>{
			if(el[0].includes(cookies)){
				cook = el[1]
			}
			return cook;
		});
		return cook;
	}
	console.log(getCookies('user'));
	