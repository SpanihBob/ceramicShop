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
			<div class="crockeryContent">								<!-- CONTENT -->
				<?
					$queryCrockery = $dbPDO -> prepare("SELECT * FROM crockery");
					$queryCrockery -> execute();
					foreach($queryCrockery as $rowCrockery) {                                           
						echo <<<html
								<div data-id="$rowCrockery[id]" class="crockeryCard">
									<img class="crockeryImg" src="../img1/$rowCrockery[crockeryImage]" alt="">
									<div class="crockeryText">$rowCrockery[crockeryName]</div>
								</div>
							html;
					}  
				?>
			</div>
			<div class="crockeryProduct"></div>
		</div>

			<script>
				const crockeryContent = document.querySelector(".crockeryContent");
				const crockeryProduct = document.querySelector(".crockeryProduct");
				crockeryContent.onclick = event => {
					crockeryProduct.innerHTML = '';
					// console.log(event.target.className);
					if(event.target.className == "crockeryCard") {
						getProduct(event.target, 1);						//эта функция находится в master.js
					}
					if(event.target.parentNode.className == "crockeryCard") {
						getProduct(event.target.parentNode, 1);
					}
				
				}

				function getProduct(event, catId) {
					let attribute = event.getAttribute("data-id");
					fetch("/system/getProduct.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${attribute}&catId=${catId}`,
							})
						.then(response =>response.json())
						.then(data => {
							crockeryContent.style.display = "none";
							crockeryProduct.style.display = "grid";

							data.forEach(element => {
								let productDiv = document.createElement("div");								//parent

									let imgDiv = document.createElement("div");	
										let img = document.createElement('img');						//создали картинку
										img.setAttribute("src",`../img1/${element.poster}`)				//for img

									let dataDiv = document.createElement("div");						//for all
									
										let nameDiv = document.createElement("div");					//name
											let nameText = document.createTextNode(`${element.name}`);

										let priceDiv = document.createElement("div");					//price
											let priceText = document.createTextNode(`Цена: ${element.price} р.`);

										// let descriptionDiv = document.createElement("div");				//description
										// 	let descriptionText = document.createTextNode(`${element.description}`);

										let amountDiv = document.createElement("div");					//amount
											let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

								productDiv.classList.add("productDivCrockery");
								dataDiv.classList.add("dataProductDivCrockery");
								imgDiv.classList.add("imgProductCrockery");

								nameDiv.appendChild(nameText);
								priceDiv.appendChild(priceText);
								// descriptionDiv.appendChild(descriptionText);
								amountDiv.appendChild(amountText);
								
								imgDiv.appendChild(img);
								dataDiv.appendChild(nameDiv);
								dataDiv.appendChild(priceDiv);
								// dataDiv.appendChild(descriptionDiv);
								dataDiv.appendChild(amountDiv);

								productDiv.appendChild(imgDiv);
								productDiv.appendChild(dataDiv);

								crockeryProduct.appendChild(productDiv);


								// crockeryProduct.innerHTML += `
								// <div data-id="${element['id']}" class="crockeryCard">
								// 	<img class="crockeryImg" src="../img1/${element['poster']}" alt="">
								// 	<div class="crockeryText">${element['description']}</div>
								// </div>`

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