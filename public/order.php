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
			<div class="crockeryContent">
                заказы
			</div>	
            <script>
                window.onload = () => {
                    fetch(`/system/removeToOrderUser.php`)            
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
                                productImage.classList.add("userShoppingProductImage");
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
                                let productCountText = document.createTextNode(`${element.summ}шт.`);
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
			
            </script>	
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>