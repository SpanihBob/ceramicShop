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
			<div class="crockeryContent" id="content">									<!-- CONTENT -->				
			</div>
			<!-- <div class="crockeryProduct"></div>
			<div class="crockeryProductFull"></div>
			<div id="contextMenu">
				<div id="closeBtn">x</div>
			</div> -->	
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
    <script>
        window.onload=()=>{					
            fetch(`/system/displayProductPage.php`)                                        
            .then(response => response.json())                                  
            .then(data => {
                const content = document.getElementById("content");
				data.forEach(element => {
                    
                })
            })
        }
    </script>
</body>
</html>
