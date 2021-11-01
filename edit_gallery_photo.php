<?php
	//alustame sessiooni
	session_start();
	
	if(!isset($_SESSION["user_id"])) {
		header("Location: page.php");
	}
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: page.php");
	}
	
	$author_name = "Kevin Rosenberg";
	require_once("../../config.php");
	require_once("fnc_gallery.php");
	
	if(isset($_GET["photo"] and !empty $_GET["photo"])) {
		
	} else {
		header("Location: home.php");
	}
	
	require_once("page_header.php");
?>
		<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<hr>
		<ul>
			<li><a href="home.php">Avaleht</a></li>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
		<hr>
		<h2>Foto andmete muutmine</h2>
		<?php echo read_own_photo_thumbs($page_limit, $page); ?>
	</body>
</html>