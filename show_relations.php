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
	require_once("fnc_film.php");
	
	$relation_table_html = null;
	$realtion_table_html = join_movie_info();
	
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
		<h2>Mingi tabel</h2>
		<?php
		echo $realtion_table_html;
		?>
	</body>
</html>