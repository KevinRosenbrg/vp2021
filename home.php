<?php 
	//alustame sessiooni
	require_once("use_session.php");

	//testime klassi
	//require_once("classes/test.class.php");
	//$my_test_object = new Test(33);
	//echo $my_test_object->non_secret_value;
	//echo $my_test_object->secret_value;
	//$my_test_object->multiply();
	//$my_test_object->reveal();
	//unset($my_test_object);
	
	setcookie("vpvisitor", $_SESSION["first_name"] ." " .$_SESSION["last_name"], time() + (86400 * 9), "/~rinde/vp2021/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
    $last_visitor = null;
    if(isset($_COOKIE["vpvisitor"])){
        $last_visitor = "<p>Viimati külastas lehte: " .$_COOKIE["vpvisitor"] .".</p> \n";
    } else {
        $last_visitor = "<p>Küpsiseid ei leitud, viimane külastaja pole teada.</p> \n";
    }
	
	//küpsise kustutamiseks määratakse talle varasem (enne praegust hetke aegumine)
	
	
	
	require_once("page_header.php");
?>
		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<hr>
		<?php echo $last_visitor; ?>
		<hr>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<p>
			<a href="user_profile.php">Kasutajaprofiil</a> //
			<a href="add_films.php">Lisa filme</a> //
			<a href="add_movie_info.php">Lisa muud infot</a> //
			<a href="list_films.php">Uuri filme</a> //
			<a href="movie_relations.php">Filmi relatsioonid</a> //
			<a href="show_relations.php">Uuri relatsioone</a> //
			<a href="list_people.php">Uuri inimesi</a> //
			<a href="gallery_photo_upload.php">Fotode üleslaadimine</a> //
			<a href="gallery_public.php">Fotode galerii</a> //
			<a href="gallery_own.php">Oma fotode galerii</a> //
			<a href="add_news.php">Uudise lisamine</a> //
		</p>
		<hr>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
		<hr>
		<p>Siia tulevad uudised..</p>
	</body>
</html>