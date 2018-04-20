<?php

require 'PHPMailerAutoload.php';
	

//$con = mysql_connect("localhost","root","");
$con = mysql_connect("localhost","root","password");

mysql_select_db("user", $con);

$query = "select email from client_detail";

$result = mysql_query($query, $con);
$email = array();

while($row=mysql_fetch_assoc($result)){
	$email[]=$row['email']; 
	}



foreach($email as $to)
	{
$mail = new PHPMailer;
//echo 'Message has been sent '.$to;
	
	//$mail->setFrom('from@example.com', 'Your Name');
	$mail->setFrom('from@example.com');
	$mail->addAddress($to);
	$mail->Subject  = 'sample subject';
	$mail->isHTML(true);
	$mail->Body    = '<html>
						  	<head>
								<title>BestWeb.lk 2018</title>
						  	</head>
			        	  	<body>
						 		<table style="width: 760px;" >
			  						<tr>
			  				      		<td>
			  				    			<img src="cid:banner" alt="bestweb.lk 2018" width="760px" height="167px" /> 
			  							</td>
			  						</tr>
			 						<tr >
			  							<td bgcolor="#fff4bf" height="315px">
			  								<div align="justify" style="padding: 20px;">
					  	  					<b>Dear Sir/Madam,</b> 
						  					

						  					<p>We are happy to inform you that we have introduced a new awarding category called <b><i>Most Popular Website</i></b> against each category this year.</p>

						 					<br>

						  					<a href="https://www.facebook.com/"><img src="cid:fb" width="26"></a>
						 					<p>Get connected with us on our <a href="https://www.facebook.com/">Facebook page</a>  for more updates.</p>
											 </div>
				    					</td>
									</tr>
			  					</table>

							</body>
						</html>
			  

						';

	$mail->AddEmbeddedImage('images/bannergold.gif', 'banner');
	$mail->AddEmbeddedImage('images/noname3.jpeg', 'bestweb'); 
	$mail->AddEmbeddedImage('images/noname2.gif', 'fb');  

	if(!$mail->send()) {
	  echo 'Message was not sent '.$to;
	  echo "<br>";
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	  $file = fopen("notmailsentlist.txt","a+"); // add email to notmailsentlist.txt here which have sending email error
						fwrite($file, $to.",\r\n");
						fclose($file);
	} 
	else {
	  echo 'Message has been sent '.$to;
	  echo "<br>";
	  $file = fopen("mailsentlist.txt","a+"); // add email id to mailsentlist.txt to track the email sent
						fwrite($file, $to.",\r\n");
						fclose($file);

	}


sleep(20);

}

?>