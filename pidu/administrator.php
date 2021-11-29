<?php
	require_once("fnc_party.php");
	
	$people_html = null;
	
	if (isset($_POST["list_submit"])) {
		$people_html = read_all_people();
	}
	if (isset($_POST["edit_submit"])) {
		
	}
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title>Administration</title>
		<style>
			body {
				background-color: grey;
			}
		
		</style>
	</head>
	<body>
		<h1>ADMINISTRAATOR</h1>
		<hr>
		<h2>Muuda ja kontrolli andmeid</h2>
		<hr>
		<form method="POST">
			<input type="submit" name="list_submit" value="Ava nimekiri">
			<input type="submit" name="edit_submit" value="Salvesta muudatused"> <!-- salvestamine ei tee midagi veel -->
		</form>
		<?php echo $people_html; ?>
		
	</body>
</html>