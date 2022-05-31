<html>
  <head>
    <title>JohnnyDell Services Limited </title>
  </head>
  <body>
	<?php  
		  $dir = getcwd ();

		  require $dir.'/vendor/autoload.php';
		  use PHPMailer\PHPMailer\PHPMailer;
		//Get user submitted values

		if (isset ($_POST['UserSubmit']) ) {
			$name = htmlspecialchars($_POST['_name']);
			$phone = htmlspecialchars($_POST['_phone']);
			$address = htmlspecialchars($_POST['_address']);
			$message = htmlspecialchars($_POST['_message']);
			
			$secretKey = "6Le5vTIgAAAAAKsyanOaQykeYD1lhm_JvotJoICj";
			$remoteIP = $_SERVER['REMOTE_ADDR'];
			$token = $_POST['tgon'];
			
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$token."&remoteip=".$remoteIP;
			$request = file_get_contents($url);
			$response = json_decode($request);
			
			if ($response->score > 0.3 ) {
				
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
				$mail->addReplyTo('corporate@johnnydellservices.com', 'services');
				$mail->addAddress('corporate@johnnydellservices.com', 'The Manager');


				$mail->Subject = 'Cleaning Request from ' . $name;
				$mail->isHTML(true);
				$mailContent = 	"NAME:  {$name} <br> 
												 PHONE:  {$phone}  <br> 
												 ADDRESS:  {$address}  <br> 
												 MESSAGE:  {$message} ";

				$mail->Body = $mailContent;

				if($mail->send()){
				  echo '<h2>Thank you for your message, We will get gack to you soon</h2>';
					echo '<br>';
					echo '<h2>Redirecting...</h2>';
					header('Refresh:4; https://johnnydellservices.com');

				}else{
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
			else {
				//echo "Name: ".$name. " Phone: " .$phone." Address: " .$address. " Message: ".$message. "\n";
				$handle = fopen('contact.txt', 'a');
				$date = date('Y, M, d @ H:i:s', time());
				fwrite($handle, "Name: ".$name. " Phone: " .$phone." Address: " .$address. " Message: ".$message. "Date: ".$date. "\n");
				fclose($handle);
				
				echo '<h2>Thank you for your message, We will get gack to you soon</h2>';
					echo '<br>';
					echo '<h2>Redirecting...</h2>';
					header('Refresh:4; https://johnnydellservices.com');
				
			}
	  	}
	 ?>
	  
  </body>
</html>