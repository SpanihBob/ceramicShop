<?
	include_once "$path/private/head.php";
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
