<html>
  <head>
    <title>JohnnyDell Services Limited </title>
  </head>
  <body>
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
		$mail->Host = 'makinin.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'test@makinin.com';
		$mail->Password = 'wysM243&';
		$mail->SMTPSecure = 'none';
		$mail->Port = 587;

		$mail->setFrom("no-reply@johnnydellservices.com", "{$name}  {$phone}");
		$mail->addReplyTo('services@makinin.com', 'services');
		$mail->addAddress('clean@johnnydellservices.com', 'The Manager');


		$mail->Subject = 'Cleaning Request from ' . $name;
		$mail->isHTML(true);
		$mailContent = 	"NAME:  {$name} <br> 
										 PHONE:  {$phone}  <br> 
										 ADDRESS:  {$address}  <br> 
										 MESSAGE:  {$message} ";

		$mail->Body = $mailContent;
	  
		if($mail->send()){
		  echo 'Thank you for your message, We will get gack to you soon';
			echo '<br>';
			echo 'Redirecting...';
			header('Refresh:5; https://johnnydellservices.com');
			
		}else{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	  
	 ?>
	  
  </body>
</html>