<? php

	$firstname = $name = $email = $phone = $message = "";
	$messageError = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$firstname = verifyInput($_POST["firstname"]);
		$name = verifyInput($_POST["name"]);
		$email = verifyInput($_POST["email"]);
		$phone = verifyInput($_POST["phone"]);
		$message = verifyInput($_POST["message"]);

		if (empty($firstname) || empty($name) || empty($message))
		{
			$messageError = "Please fill this field";
		}
		if (!isEmail($email))
		{
			$messageError = "Please fill mail address";	
		}
		if (!isPhone($phone)) 
		{
			$messageError = "Please fill phone number";
		}

	}

	function isPhone($var)
	{
		return preg_match("/^[0-9]*$", $var)
	}

	function isEmail($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL);
	}


	function verifyInput($var)
	{
		$var = trim($var);
		$var = stripcslashes($var);
		$var = htmlspecialchars($var);
		return $var;
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Contactez-moi</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
	<div class="container">
		<div class="divider"></div>
		<div class="heading">
			<h2>Contactez-moi</h2>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<form id="contact-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form">
					<div class="row">
						
						<div class="col-md-6">
							<label for="firstname">Prenom <span class="blue">*</span></label>
							<input type="text" name="firstname" id="firstname" class="form-control" required placeholder="Votre prenom" value="<?php echo $firstname; ?>"></input>
							<p class="comments"><? php echo $messageError; ?></p>
						</div>

						<div class="col-md-6">
							<label for="name">Nom <span class="blue">*</span></label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>"></input>
							<p class="comments"><? php echo $messageError; ?></p>
						</div>
						
						<div class="col-md-6">
							<label for="email">Email <span class="blue">*</span></label>
							<input type="email" name="email" id="email" class="form-control" required placeholder="Votre email" value="<?php echo $email; ?>"></input>
							<p class="comments"><? php echo $messageError; ?></p>
						</div>
						
						<div class="col-md-6">
							<label for="phone">Telephone</label>
							<input type="tel" name="phone" id="phone" class="form-control" placeholder="Votre telephone" value="<?php echo $phone; ?>"></input>
							<p class="comments"><? php echo $messageError; ?></p>
						</div>
						
						<div class="col-md-12">
							<label for="message">Message <span class="blue">*</span></label>
							<textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?></textarea>
							<p class="comments"><? php echo $messageError; ?></p>
						</div>
						
						<div class="col-md-12">
							<p class="blue" id="blue-info"> * Ces informations sont requises</p>
						</div>
						
						<div class="col-md-12">
							<input type="submit" class="button1" value="Envoyer"></input>
						</div>

					</div>

					<p class="thank-you">Votre message a bien ete envoyer. merci de m'avoir contacte :)</p>


				</form>
			</div>
		</div>
		
	</div>
</body>
</html>