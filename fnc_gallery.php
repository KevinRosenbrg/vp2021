<?php
	$database = "if21_kevin_ros";
	
	function show_latest_public_photo() {
		$photo_html = null;
		$privacy = 3;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("select filename, alttext from vp_photos where id = (select max(id) from vp_photos where privacy = ? and deleted is null)");
		echo $conn->error;
		$stmt->bind_param("i", $privacy);
		$stmt->bind_result($filename_from_db, $alttext_from_db);
		$stmt->execute();
		if($stmt->fetch()) {
			//<img src="kataloog.file" alt="tekst">
			$photo_html = '<img src="' .$GLOBALS["photo_normal_upload_dir"] .$filename_from_db .'" alt="';
			if(empty($alttext_from_db)) {
				$photo_html .= "Üleslaetud foto";
			} else {
				$photo_html .= $alttext_from_db;
			}
			$photo_html .= '">' ."\n";
		}
		if(empty($photo_html)) {
			$photo_html = "<p>Kahjuks avalikke fotosid üles laetud pole!</p> \n";
		}
		
		$stmt->close();
		$conn->close();
		return $photo_html;
	}
	
	function read_public_photo_thumbs($page_limit, $page) {
		$gallery_html = null;
		$privacy = 2;
		$skip = ($page - 1) * $page_limit;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("select filename, alttext from vp_photos where id = (select max(id) from vp_photos where privacy >= ? and deleted is null order by id desc limit ?,?)");
		echo $conn->error;
		$stmt->bind_param("iii", $privacy, $skip, $page_limit);
		$stmt->bind_result($filename_from_db, $alttext_from_db);
		$stmt->execute();
		while($stmt->fetch()) {
			//<div class="thumbgallery">
			//<img src="kataloog.file" alt="tekst">
			//</div>
			$gallery_html .= '<div class="thumbgallery">' . "\n";
			$gallery_html .= '<img src="' .$GLOBALS["photo_thumbnail_upload_dir"] .$filename_from_db .'" alt="';
			if(empty($alttext_from_db)) {
				$gallery_html .= "Üleslaetud foto";
			} else {
				$gallery_html .= $alttext_from_db;
			}
			$gallery_html .= '" class="thumbs">' ."\n";
			$gallery_html .= "</div>";
		}
		if(empty($gallery_html)) {
			$photo_html = "<p>Kahjuks avalikke fotosid üles laetud pole!</p> \n";
		}
		$stmt->close();
		$conn->close();
		return $gallery_html;
	}
	
		// function read_public_photo_thumbs() {
		// $gallery_html = null;
		// $privacy = 2;
		// $conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		// $conn->set_charset("utf8");
		// $stmt = $conn->prepare("select filename, alttext from vp_photos where id = (select max(id) from vp_photos where privacy >= ? and deleted is null order by id desc limit 3,3)");
		// echo $conn->error;
		// $stmt->bind_param("i", $privacy);
		// $stmt->bind_result($filename_from_db, $alttext_from_db);
		// $stmt->execute();
		// while($stmt->fetch()) {
			//<img src="kataloog.file" alt="tekst">
			// $gallery_html .= '<img src="' .$GLOBALS["photo_thumbnail_upload_dir"] .$filename_from_db .'" alt="';
			// if(empty($alttext_from_db)) {
				// $gallery_html .= "Üleslaetud foto";
			// } else {
				// $gallery_html .= $alttext_from_db;
			// }
			// $gallery_html .= '">' ."\n";
		// }
		// if(empty($gallery_html)) {
			// $photo_html = "<p>Kahjuks avalikke fotosid üles laetud pole!</p> \n";
		// }
		// $stmt->close();
		// $conn->close();
		// return $gallery_html;
	// }

	function count_public_photos($privacy) {
		$photo_count = 0;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT count (id) FROM vp_photos WHERE privacy >= ? AND deleted IS null order by id desc limit 3,3");
		echo $conn->error;
		$stmt->bind_param("i", $privacy);
		$stmt->bind_result($count);
		$stmt->execute();
		if($stmt->fetch()) {
			$photo_count = $count;
		}
		$stmt->close();
		$conn->close();
		return $photo_count;
	}
	
		function read_own_photo_thumbs($page_limit, $page) {
		$gallery_html = null;
		$skip = ($page - 1) * $page_limit;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT filename, alttext FROM vp_photos WHERE id = (SELECT MAX(id) FROM vp_photos WHERE userid = ? AND deleted IS null order by id desc limit ?,?)");
		echo $conn->error;
		$stmt->bind_param("iii", $_SESSION["user_id"], $skip, $page_limit);
		$stmt->bind_result($id_from_db, $filename_from_db, $alttext_from_db);
		$stmt->execute();
		while($stmt->fetch()) {
			//<div class="thumbgallery">
			//<img src="kataloog.file" alt="tekst">
			//</div>
			$gallery_html .= '<div class="thumbgallery">' . "\n";
			$gallery_html .= '<a href="edit_gallery_photo.php?photo=' .$id_from_db .'">';
			$gallery_html .= '<img src="' .$GLOBALS["photo_thumbnail_upload_dir"] .$filename_from_db .'" alt="';
			if(empty($alttext_from_db)) {
				$gallery_html .= "Üleslaetud foto";
			} else {
				$gallery_html .= $alttext_from_db;
			}
			$gallery_html .= '" class="thumbs">' ."\n";
			$gallery_html .= "</a> \n";
			$gallery_html .= "</div>";
		}
		if(empty($gallery_html)) {
			$photo_html = "<p>Kahjuks avalikke fotosid üles laetud pole!</p> \n";
		}
		$stmt->close();
		$conn->close();
		return $gallery_html;
	}
	
?>