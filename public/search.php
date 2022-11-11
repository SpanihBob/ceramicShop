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
			<div class="crockeryProduct">
                <!-- <div class="nameContent">								
                    название
                </div> -->
			</div>
            <script>
                const crockeryContent = document.querySelector(".crockeryProduct");
				window.onload=()=>{				
					displayProductPage("system/sysSearch");     
				}                  
            </script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>

        
       
		
