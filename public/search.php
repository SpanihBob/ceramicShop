<?
	include_once "$path/private/head.php";
	$_GET['searchProduct'] = trim($_GET['searchProduct']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
	$_GET['searchProduct'] = htmlspecialchars($_GET['searchProduct']);                    //Преобразует специальные символы в HTML-сущности
	$_SESSION['searchProduct'] = $_GET['searchProduct'];
	
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
			<div class="crockeryProduct">
                <!-- <div class="nameContent">								
                    название
                </div> -->
			</div>
			<?  
                // require_once "$path/system/sysSearch.php";
            ?> 
            <script>
                const crockeryContent = document.querySelector(".crockeryProduct");
				window.onload=()=>{				
					displayProductPage("sysSearch");     
				}                  
            </script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>

        
       
		
