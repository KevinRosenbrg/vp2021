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
	
	$page = 1;
	$page_limit = 3;
	$photo_count = count_public_photos(2);
	if(!isset($_GET["page"]) or $_GET["page"] < 1) {
		$page = 1;
	} elseif(round($_GET["page"] - 1) * $page_limit >= $photo_count) {
		$page = ceil($photo_count / $page_limit);
	} else {
		$page = $_GET["page"];
	}
	
	$to_head = '<link rel="stylesheet" type="text/css" href="style/gallery.css">' ."\n";
	
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
		<h2>Oma fotode galerii</h2>
		<p>
			<?php 
				if($page > 1) {
					echo '<span><a href=?page=' .($page - 1) .'">Eelmine leht</a></span> |' ."\n";
				} else {
					echo "<span>Eelmine leht</span> | \n";
				}
				if($page * $page_limit < $photo_count) {
					echo '<span><a href=?page=' .($page + 1) .'">Järgmine leht</a></span>' ."\n";
				} else {
					echo "<span>Järgmine leht</span> \n";
				}
			?>
		</p>
		<?php echo read_own_photo_thumbs($page_limit, $page); ?>
	</body>
</html>