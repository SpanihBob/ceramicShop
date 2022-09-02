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
			<div class="content">								<!-- CONTENT -->
				<?
					$queryCrockery = $dbPDO -> prepare("SELECT * FROM crockery");
					$queryCrockery -> execute();
					foreach($queryCrockery as $rowCrockery) {                                           
						echo <<<html
								<div id="crockery">
									<img class="crockeryImg" src="../img1/$rowCrockery[crockeryImage]" alt="">
									<div>$rowCrockery[crockeryName]</div>
								</div>
							html;
					}  
				?>
			</div>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>
