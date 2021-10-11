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
	
	require_once("../../config.php");
	//require_once("fnc_film.php");
	require_once("fnc_movie.php");
	
	$notice = null;
	$role = null;
	$selected_person = null;
	$selected_movie = null;
	$selected_position = null;
	$movie_info_store_notice = null;
	
	$selected_person_for_photo = null;
	$photo_upload_notice = null;
	$photo_dir = "movie_photos/";
	
	if(isset($_POST["person_in_movie_submit"])) {
		if((!empty($_POST["movie_input"])) and (!empty($_POST["person_input"])) and (!empty($_POST["position_input"])) and (!empty($_POST["role_input"]))) {
			$movie_info_store_notice = store_movie_info($_POST["movie_input"], $_POST["person_input"], $_POST["position_input"], $_POST["role_input"]);
		}
		else {
			$movie_info_store_notice = "Osa andmeid on puudu!";
		}
	}
	
	if(isset($_POST["person_photo_submit"])) {
		//var_dump($_FILES);
		$image_check = getimagesize($_FILES["photo_input"] ["tmp_name"]);
		if ($image_check !== false) {
			if($image_check["mime"] == "image/jpeg") {
				$file_type = "jpg";
			}
			if ($image_check["mime"] == "image/png") {
				$file_type = "png";
			}
			if ($image_check["mime"] == "image/gif") {
				$file_type = "gif";
			}
			
			$time_stamp = microtime(1) * 10000;
			
			//kasutaksin ees- ja perekonna nimi, aga prgu on meil ainult inimese id
			$file_name = $_POST["person_for_photo_input"] ."_" .$time_stamp ."." .$file_type;
			move_uploaded_file($_FILES["photo_input"] ["tmp_name"], $photo_dir .$file_name);
			//Tuleb lisada veel fotode lisamine andmebaasi
			//$photo_upload_notice = store_photo()
		}
	}	
		
	require_once("page_header.php");
?>

		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
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
		<h2>Filmi info seostamine</h2>
		<h3>Film, inimene ja tema roll</h3>
		<form method ="POST">
			<label for="person_input">Isik</label>
			<select name="person_input" id="person_input">
				<option value="" selected disabled>Vali isik</option>
				<?php echo read_all_person($selected_person); ?>
			</select>
			<label for="movie_input">Film: </label>
			<select name="movie_input" id="movie_input">
				<option value="" selected disabled>Vali film</option>
				<?php echo read_all_movie($selected_movie); ?>
			</select>
			<label for="position_input">Amet: </label>
			<select name="position_input" id="position_input">
				<option value="" selected disabled>Vali amet</option>
				<?php echo read_all_position($selected_position); ?>
			</select>
			<label for="role_input">Roll: </label>
			<input type="text" name="role_input" id="role_input" placeholder="Tegelase nimi" value="<?php echo $role; ?>">
			<input type="submit" name="person_in_movie_submit" value="Salvesta">
		</form>
		<span><?php echo $movie_info_store_notice; ?></span>
		<hr>
		<h3>Filmitegelase foto</h3>
		<form method ="POST" enctype="multipart/form-data">
			<label for="person_for_photo_input">Isik</label>
			<select name="person_for_photo_input" id="person_for_photo_input">
				<option value="" selected disabled>Vali isik</option>
				<?php echo read_all_person($selected_person_for_photo); ?>
			</select>
			<label for="photo_input">Vali pildi fail</label>
			<input type="file" name="photo_input" id="photo_input">
			<input type="submit" name="person_photo_submit" value="Lae pilt üles">
		</form>
		<span><?php echo $photo_upload_notice; ?></span>
	</body>
</html>