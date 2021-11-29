<?php
	require_once("../../../config.php");
	require_once("fnc_party.php");
	
	$registration_notice = null;
	$inserted_firstname = null;
	$inserted_lastname = null;
	$inserted_studentcode = null;
	$registration_completed = null;
	$payment_secured = null;
	$login_notice = null;
	$login_notice = null;

	$registration_completed = count_people();
	$payment_secured = count_payments();
	
	if (isset($_POST["registration_submit"])) {
		if (($_POST["firstname_input"] == "admin") and (($_POST["lastname_input"]) == "admin")) {
			header("Location: administrator.php");
		}
		if ((isset($_POST["firstname_input"]) and (!empty($_POST["firstname_input"]))) and (isset($_POST["lastname_input"]) and (!empty($_POST["lastname_input"]))) and (isset($_POST["studentcode_input"]) and (!empty($_POST["studentcode_input"])))) {
			
			$registration_notice = save_registration($_POST["firstname_input"], $_POST["lastname_input"], $_POST["studentcode_input"]);
			
			if ($registration_notice == "Salvestamine õnnestus") {
				//header("Location: edit_registration.php");
			}
		} else {
			$registration_notice = "Osa andmeid on puudu!";
		}
		if (!empty($_POST["firstname_input"])) {
			$inserted_firstname = $_POST["firstname_input"];
		}
		if (!empty($_POST["lastname_input"])) {
			$inserted_lastname = $_POST["lastname_input"];
		}
		if (!empty($_POST["studentcode_input"])) {
			$inserted_studentcode = $_POST["studentcode_input"];
		}
	}
	
	if (isset($_POST["login_submit"])) {
		if ((isset($_POST["studentcode_input2"])) and (!empty($_POST["$studentcode_input2"]))) {
			$login_notice = check_code($_POST["studentcode_input2"]);
		}
		if ($login_notice == "1") { //Üldse ei tööta, annab ainult väljundi, et pole registreeritud
			header("Location: edit_registration.php"); 
		} else {				
			$login_notice = "Õpilane ei ole registreeritud.";
		}
	}
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title>Party registration</title>
		<style>
			body {
				background-color: grey;
			}
		
		</style>
	</head>
	<body>
		<h1>THE PARTY</h1>
		<hr>
		<h2>Registratsioon</h2>
		<p>Peole registreerimiseks täida ära kõik väljad.</p>
		
		<form method="POST">
			<label for="firstname_input">Sisesta eesnimi:</label>
			<input type="text" id="firstname_input" name ="firstname_input" placeholder="Eesnimi" value="<?php echo $inserted_firstname; ?>"></input>
			<br>
			<label for="lastname_input">Sisesta perenimi:</label>
			<input type="text" id="lastname_input" name ="lastname_input" placeholder="Perenimi" value="<?php echo $inserted_lastname; ?>"></input>
			<br>
			<label for="studentcode_input">Sisesta õpilaskood:</label>
			<input type="text" id="studentcode_input" name ="studentcode_input" placeholder="Õpilaskood" value="<?php echo $inserted_studentcode; ?>"></input>
			<br>
			<input type="submit" name="registration_submit" value="Registreeri">
		</form>
		<p><?php echo $registration_notice; ?></p>
		<hr>
		<h2>Sisselogimine</h2>
		<p>Juhul, kui oled juba registreerinud, siis siit saab õpilaskoodiga sisse logida ja andmeid muuta.</p>
		<form method="POST">
			<label for="studentcode_input2">Sisesta õpilaskood:</label>
			<input type="text" name="studentcode_inpur2" id="studentcode_input2" placeholder="Õpilaskood">
			<input type="submit" name="login_submit" value="Logi sisse">
		</form>
		<p><?php echo $login_notice; ?></p>
		<hr>
		<p>Registreeritud inimesi: <span><?php echo $registration_completed; ?></span></p>
		<p>Osalejaid, kellel makstud: <span><?php echo $payment_secured; ?></span></p>
	</body>
</html>