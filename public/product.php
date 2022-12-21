<?
	include_once "$path/private/head.php";
	$_GET['subcategoryId'] = trim($_GET['subcategoryId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_GET['subcategoryId'] = htmlspecialchars($_GET['subcategoryId']);                    //Преобразует специальные символы в HTML-сущности
	$_SESSION['subcategoryId'] = $_GET['subcategoryId'];

	$_GET['productCat'] = trim($_GET['productCat']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_GET['productCat'] = htmlspecialchars($_GET['productCat']);                    //Преобразует специальные символы в HTML-сущности
	$_SESSION['productCat'] = $_GET['productCat'];
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";			//HEADER
		?>	

		<article class="article">								<!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			
            <div>
				<div class="crockeryProduct" id="content">		<!-- CONTENT -->				
				</div>
			</div>	
		</article>
		<?
			include_once "$path/private/footer.php"				//FOOTER
		?>
	</div>


    <script>
		const crockeryContent = document.querySelector(".crockeryProduct");
        window.onload=()=>{				
			displayProductPage("displayProductPage");
        }
    </script>
</body>
</html>
