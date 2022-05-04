<?php  
	
		//Get user submitted values

		if (isset ($_POST['UserSubmit']) ) {
			$name = htmlspecialchars($_POST['_name']);
			$phone = htmlspecialchars($_POST['_phone']);
			$address = htmlspecialchars($_POST['_address']);
			$message = htmlspecialchars($_POST['_message']);
		}

		//echo $name;

      	$dir = getcwd ();

	  	require $dir.'/vendor/autoload.php';
    	use PHPMailer\PHPMailer\PHPMailer;

    	$mail = new PHPMailer();

		$mail->isSMTP();
	  	$mail->SMTPOptions = array(
		  'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		  )
		);
		$mail->Host = 'johnnydellservices.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'clean@johnnydellservices.com';
		$mail->Password = 'JohnnyDell@2022';
		$mail->SMTPSecure = 'none';
		$mail->Port = 587;

		$mail->setFrom($address, $name);
		$mail->addAddress('clean@johnnydellservices.com', $name);


		$mail->Subject = 'Message from ' . $name;
		$mail->isHTML(false);
		$mailContent = $message;
		$mail->Body = $mailContent;
	  
		if($mail->send()){
		  echo 'Message has been sent';
		}else{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	  
	 ?>