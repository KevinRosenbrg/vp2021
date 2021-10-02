<?php
	//alustame sessiooni
	session_start();
	require_once("../../config.php");
	require_once("fnc_user.php");
	$author_name = "Kevin Rosenberg";
	$todays_evaluation = null;
	
	$inserted_adjective = null;
	$adjective_error = null;
	
	$where_email = null;
	$inserted_email = null;
	$password_error = null;
	$email_error = null;
	
	//kontrolli kas on klikitud submit nuppu
	if(isset($_POST["todays_adjective_input"])) {
		//echo "Klikiti nuppu";
		//kas midagi kirjutati ka
		if(!empty($_POST["adjective_input"])) {
			$todays_evaluation = "<p>Tänane päev on <strong>" .$_POST["adjective_input"] ."</strong>.</p><hr>";
			$inserted_adjective = $_POST["adjective_input"];
		} 
		else {
			$adjective_error = "Palun kirjuta tänase päeva kohta sobiv omadussõna!";
		}
	}

	$pic_num = null;
	//$photo_dir = "../photos/";
	$photo_dir = "photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	//$all_files = scandir($photo_dir,);
	$all_files = array_slice(scandir($photo_dir), 2);
	//$only_files = array_slice($all_files, 2);
	
	//sõelun välja ainult lubatud pildid
	$photo_files = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $file);
			}
		}
	}
	$limit = count($photo_files);
	$pic_num = mt_rand(0, $limit - 1);
	
	
	if(isset($_POST["photo_select_submit"])){
		$pic_num = $_POST["photo_select"];
	}
	
	$pic_file_html = null;
	$pic_file = $photo_files[$pic_num];
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" alt="Tallinna Ülikool">';
	
	$pic_file_html = "\n <p>".$pic_file ."</p> \n";
	
	$list_html = "<ul> \n";
	for($i = 0; $i < $limit; $i ++){
		$list_html .= "<li>" .$photo_files[$i] ."</li> \n";
	}
	$list_html .= "</ul>";
	
	$photo_select_html = '<select name="photo_select">' ."\n";
	for($i = 0; $i < $limit; $i ++){
		//<option value="0">fail.jpg</option>
		$photo_select_html .= "\t \t \t" .'<option value="' .$i .'"';
		if($i == $pic_num){
			$photo_select_html .= " selected";
		}
		$photo_select_html .= ">" .$photo_files[$i] ."</option> \n";
	}
	$photo_select_html .= "\t \t </select> \n";
	
	if(isset($_POST["login_submit"])) {
		if (empty($_POST["email_input"])) {
			$where_email = "Email on puudu!";
		}
		else {
			$inserted_email = $_POST["email_input"];
		}
		if(!empty($_POST["email_input"])) {
            $email = filter_var($_POST["email_input"], FILTER_VALIDATE_EMAIL);
                if(strlen($email) < 5){
                    $email_error = "Palun sisesta oma e-posti aadress kasutajatunnusesse!";
                }
        } 	
		else {
            $email_error = "Palun sisesta oma e-posti aadress kasutajatunnusesse!";
        }
		sign_in($_POST["email_input"], $_POST["password_input"]);
		if(!empty($_POST["password_input"])){
            if(strlen($_POST["password_input"]) < 8){
                $password_error = "Salasõna on liiga lühike!";
            }
        } 
		else {
            $password_error = "Palun sisesta salasõna!";
        }
	}
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
		<style>
			div {
				background-color: yellow;
				width: 250px;
				outline: 3px dotted;
			}
			h1 {
				text-align: center;
			}
		</style>
		<meta charset="utf-8">
	</head>
	<body>
		<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
		
		<hr>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="email" name="email_input" placeholder="Email" value="<?php echo $inserted_email ?>">
			<input type="password" name="password_input" placeholder="salasana">
			<input type="submit" name="login_submit" value="YES">
			<span><?php echo $where_email; ?></span>
			<span><?php echo $email_error; ?></span>
			<span><?php echo $password_error; ?></span>
		</form>
		
		<p>Loo endale <a href="add_user.php">kasutajakonto</a></p>
		
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<hr>
		<form method="POST">
			<input type="text" name="adjective_input" placeholder="omadussõna tänase kohta" value="<?php echo $inserted_adjective ?>">
			<input type="submit" name="todays_adjective_input" value="Saada ära">
			<span><?php echo $adjective_error ?></span>
		</form>
		<hr>
		<?php
			echo $todays_evaluation;	
		?>
		<form method="POST">
			<?php echo $photo_select_html; ?>
			<input type="submit" name="photo_select_submit" value="Vali foto">
		</form>
		<?php
			echo $pic_html; 
			echo $pic_file_html;
			echo "<hr> \n";
			echo $list_html;
		?>
	</body>
</html>