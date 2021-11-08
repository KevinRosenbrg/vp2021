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
	
	//testime klassi
	//require_once("classes/test.class.php");
	//$my_test_object = new Test(33);
	//echo $my_test_object->non_secret_value;
	//echo $my_test_object->secret_value;
	//$my_test_object->multiply();
	//$my_test_object->reveal();
	//unset($my_test_object);
	
	require_once("page_header.php");
?>
		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<a href="user_profile.php">Kasutajaprofiil</a><br>
		<a href="add_films.php">Lisa filme</a><br>
		<a href="add_movie_info.php">Lisa muud infot</a><br>
		<a href="list_films.php">Uuri filme</a><br>
		<a href="movie_relations.php">Filmi relatsioonid</a><br>
		<a href="show_relations.php">Uuri relatsioone</a><br>
		<a href="list_people.php">Uuri inimesi</a><br>
		<a href="gallery_photo_upload.php">Fotode üleslaadimine</a><br>
		<a href="gallery_public.php">Fotode galerii</a><br>
		<a href="gallery_own.php">Oma fotode galerii</a><br>
		
		<hr>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
	</body>
</html>