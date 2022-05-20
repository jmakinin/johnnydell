
	<?php  
	
		//Get user submitted values

		if (isset ($_POST['UserSubmit']) ) {

			$fname = htmlspecialchars($_POST['f_name']);
			$lname = htmlspecialchars($_POST['l_name']);
			$email = htmlspecialchars($_POST['email']);
			$phone = htmlspecialchars($_POST['phone']);
			$address = htmlspecialchars($_POST['address']);
			$reference = htmlspecialchars($_POST['reference']);
			$referencecontact = htmlspecialchars($_POST['referencecontact']);

			$fullname = $fname .' '. $lname;

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

		$mail->setFrom("no-reply@johnnydellservices.com", "{$fullname}  {$phone}");
		$mail->addReplyTo('services@makinin.com', 'services');
		$mail->addAddress('clean@johnnydellservices.com', 'The Manager');


		$mail->Subject = 'Message from ' . $fullname;
		$mail->isHTML(true);
		$mailContent = "NAME:  {$fullname} <br> 
						PHONE:  {$phone} <br> 
						EMAIL:  {$email}  <br> 
						ADDRESS:  {$address}  <br> 
						REFERENCE:  {$reference} <br> 
						REFERENCE CONTACT:  {$referencecontact}";
		$mail->Body = $mailContent;
	  
		if($mail->send()){
		  echo 'Thank you, We will get gack to you soon';
			echo '<br>';
			echo 'Redirecting...';
			header('Refresh:5; https://johnnydellservices.com');
			
		}else{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	  
	 ?>
	 