<?php
	require_once("use_session.php");
	
	require_once("../../config.php");
	require_once("fnc_photo_upload.php");
	require_once("fnc_news.php");
	require_once("fnc_general.php");
	require_once("classes/Photoupload.class.php"); //fotode üleslaadimise klass
	
	$photo_upload_notice = null;
	$news_notice = null;
	$news_error = null;
	$title_text = null;
	$news_text = null;
	$photo_error = null;
	
	//uudise aegumine
	$expire = new DateTime("now");
	$expire->add(new DateInterval("P7D"));
	$expire_date = date_format($expire, "Y-m-d");
	
	$normal_photo_max_width = 600;
	$normal_photo_max_height = 400;	
	$thumbnail_width = $thumbnail_height = 100;
	
	$photo_filename_prefix = "vpnews_";
	$photo_upload_size_limit = 1024 * 1024;
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$photo_normal_upload_dir = "news_photos/";
	
		//uudise tekst sisaldab nüüd html märgendeid
		//kindlasti tuleks kasutada meie funktsiooni test_input()
		//selles on ka htmlspecialchars() funktsioon, mis kodeerib html erimärgid ringi, ohutuks ("<" -> &lt)
		//pärast, uudise näitamisel, et html taastuks, on vaja: htmlspecialchars_decode(uudis_andmebaasist)
		//kui on ka foto valitud, salvestage see esimesena, ka andmetabelisse. Siis saate kohe ka tema id kätte: $photo_id = $conn->insert_id;
		//uudise näitamisel tuleb arvestada ka aegumist.
		//today = date("Y-m-d");
		//SQL lauses	WHERE added >= ?	
		
    if(isset($_POST["news_submit"])){
		if ((isset($_POST["title_input"]) and !empty($_POST["title_input"])) and (isset($_POST["news_input"]) and !empty($_POST["news_input"])) and (isset($_POST["expire_input"]) and !empty($_POST["expire_input"]))) {
			$title_text = test_input(filter_var($_POST["title_input"], FILTER_SANITIZE_STRING));
			$news_text = test_input(filter_var($_POST["news_input"], FILTER_SANITIZE_STRING));
			if ((empty($title_text) and (empty($news_text)))) {
				$news_error = "Midagi läks viltu!";
			}
		}
		
		//kas pealkiri ja uudise tekst on sisestatud
		//kui on sisestatud, siis jätab meelde ja kui ei ole, siis annab teate
		if (empty($_POST["title_input"])) {
			$news_error = "Pealkiri puudu!";
		}
		else {
			$title_text = $_POST["title_input"];
		}
		if (empty($_POST["news_input"])) {
			$news_error .= "Uudise tekst puudu!";
		}
		else {
			$news_text = $_POST["news_input"];
		}
		
		//kas fail on valitud
        if(isset($_FILES["photo_input"]["tmp_name"]) and !empty($_FILES["photo_input"]["tmp_name"])){
			//fail on, klass kontrollib kohe, kas on foto
			$photo_upload = new Photoupload($_FILES["photo_input"]); // kas see ei tööta?
			if(empty($photo_upload->error)){
				//kas on lubatud tüüpi
				$photo_error .= $photo_upload->check_allowed_type($allowed_photo_types);
				
				if(empty($photo_upload->error)){
					//kas on lubatud suurusega
					$photo_error .= $photo_upload->check_size($photo_upload_size_limit);
				}
			} else {
				$photo_error .= " " .$photo_upload->error;
			}
			unset($photo_upload);
			$alt_text = null;
			$privacy = 1;
		} else {
            $photo_error = "Pildifaili pole valitud!";
        }
		
		if ((empty($photo_error)) and (empty($news_error))) {
			if(empty($photo_error)){
				//failinime
				$photo_upload->create_filename($photo_filename_prefix); //error ütleb, et photo_upload on undefined variable
				//normaalmõõdus foto
				$photo_upload->resize_photo($normal_photo_max_width, $normal_photo_max_height);
				$photo_upload_notice = "Vähendatud pildi " .$photo_upload->save_image($photo_normal_upload_dir .$photo_upload->file_name);
				//kopeerime pildi originaalkujul, originaalnimega vajalikku kataloogi
				$photo_upload_notice .= $photo_upload->move_original_photo($photo_orig_upload_dir .$photo_upload->file_name);
				//kirjutame andmetabelisse
				$photo_upload_notice .= " " .store_news_photo($photo_upload->file_name);
				
				//mis on foto id
				$photo_id = $conn->insert_id;
			} else {
				$photo_error .= " " .$photo_upload->error;
			}
			if(empty($news_error)) {
				$news_notice = save_news($_POST["title_input"], $_POST["news_input"], $_POST["expire_input"], $photo_id);
			}
			
		}
		
		//kui kõik osad läbi vaadatud, siis tuleb tagastada kõik errorid
		if (empty($news_notice)){
			$news_notice = $news_error;
		}
		if (empty($photo_upload_notice)){
			$photo_upload_notice = $photo_error;
		}
    }
	
	$to_head = '<script src="javascript/checkFileSize.js" defer></script>' ."\n";
    $to_head .= '<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>';
    
    require("page_header.php");
?>

	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <ul>
		<li><a href="home.php">Avaleht</a></li>
        <li><a href="?logout=1">Logi välja</a></li>
    </ul>
	<hr>
    <h2>Uudise lisamine</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <label for="title_input">Uudise pealkiri</label>
        <input type="text" id="title_input" name="title_input" placeholder="Uudise pealkiri" value="<?php echo $title_text; ?>">
        <br>
        <label for="news_input">Uudis</label>
        <textarea id="news_input" name="news_input"><?php echo $news_text; ?></textarea>
        <script>CKEDITOR.replace( 'news_input' );</script>
        <br>
        <label for="expire_input">Viimane kuvamine kuupäev</label>
        <input id="expire_input" name="expire_input" type="date" value="<?php echo $expire_date; ?>">
        <br>
        <label for="photo_input"> Vali pildifail! </label>
        <input type="file" name="photo_input" id="photo_input">
        <br>
        <input type="submit" name="news_submit" id="news_submit" value="Salvesta uudis"><span id="notice"></span>
    </form>
    <span><?php echo $news_notice; echo $photo_upload_notice; ?></span>
		<hr>
	</body>
</html>