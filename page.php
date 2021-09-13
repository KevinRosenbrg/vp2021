<?php
	$author_name = "Kevin Rosenberg";
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$full_time_now = date("d.m.Y H:i:s");
	$hour_now = date("H");
	//echo hour_now;
	$weekday_now = date("N");
	//echo weekday_now;
	$day_category = "ebamäärane";
	if($weekday_now <= 5) {
		$day_category = "koolipäev";
	}  // <  >  <=  >=  ==  !=
	else {
		$day_category = "puhkepäev";
	}
	//kuupäev, kellaaeg, on koolipäev
	$photo_dir = "photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	//$all_files = scandir($photo_dir,);
	$all_files = array_slice(scandir($photo_dir), 2);
	//echo $all_files;
	//var_dump($all_files);
	//$only_files = array_slice($all_files, 2);
	//var_dump($only_files);
	
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
	
	//if($muutuja > 8 and $muutuja <= 18)
	
	$limit = count($photo_files);
	//echo $limit;
	$pic_num = mt_rand(0, $limit - 1);
	$pic_file = $photo_files[$pic_num];
	// <img src="pilt.jpg" alt="Tallinna Ülikool">
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" alt="Tallinna Ülikool">';
	
	//mis aeg on?
	//$uneaeg = date("H") >= 23;
	//$tundide_aeg = date("H") >=8 and date("H") <= 18;
	//$vaba_aeg = date("H") <=18 and date("H") > 23;
	
	$time = "aeg";
	if ($hour_now < 8 and $hour_now >= 23 .$day_category = "koolipäev") {
		$time = "uneaeg";
	}
	if ($hour_now < 11 and $hour_now >= 2 .$day_category = "puhkepäev") {
		$time = "uneaeg";
	}
	if ($hour_now >= 8 and $hour_now <= 18 .$day_category = "koolipäev") {
		$time = "tundide aeg";
	}
	if ($hour_now >= 18 and $hour_now < 23 .$day_category = "puhkepäev") {
		$time = "vaba aeg";
	}
	if ($hour_now > 11 and $hour_now < 2 .$day_category = "puhkepäev") {
		$time = "vaba aeg";
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
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<img src="ylikool.jpg" alt="Tallinna Ülikool Terra õppehoone" width="600">
		<p>Lehe avamise hetk: <span><?php echo $weekday_names_et[$weekday_now - 1].", " .$full_time_now .", on " .$day_category .", " .$time; ?></span>.</p>
		<h2>Kursusel õpime</h2>
		<ul>
			<li>HTML keelt</li>
			<li>PHP programmeerimiskeelt</li>
			<li>SQL päringukeelt</li>
			<li>jne</li>
		</ul>
		<?php echo $pic_html; ?>
	</body>
</html>