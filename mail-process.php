<?php

$first_name = $_POST['first_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$total_person = $_POST['total_person'];
$comment = $_POST['comment'];

$message=
'Name:		        '.$first_name. '<br/>
Email:	            '.$email.'<br/>
Phone:              '.$phone.'<br/>
date:               '.$date. '<br/>
time:               '.$time. '<br/>
total_person:       '.$total_person. '<br/>
comment:            '.$comment. '<br/>
';


require_once 'mailer/class.phpmailer.php';
// creates object
$mail = new PHPMailer(true);
$reply_mail = new PHPMailer(true);
$reply_mail_id = $email; //Client email
$subject = "New Mail From Mail System"; //Admin get subject

$reply_message = "Dear Customer, 
Thank you to contact with us.
We will contact with you soon"; //client message

$mail->MsgHTML($message);
$reply_mail->MsgHTML($reply_message);

try
{
$mail->IsSMTP();
$mail->isHTML(true);
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = '465';
$mail->Username ="veechimailengine@gmail.com";
$mail->Password ="Epsilon@786";
$mail->SetFrom($_POST['email']);
$mail->AddReplyTo($_POST['email']);
$mail->Subject = $subject;
$mail->MsgHTML($message);
$mail->Body = $message;
$mail->AltBody = $message;


//Reply to client
$reply_mail->IsSMTP();
$reply_mail->isHTML(true);
$reply_mail->SMTPDebug = 0;
$reply_mail->SMTPAuth = true;
$reply_mail->SMTPSecure = "ssl";
$reply_mail->Host = "smtp.gmail.com";
$reply_mail->Port = '465';
$reply_mail->AddAddress($reply_mail_id); // Client get success email
$reply_mail->Username ="veechimailengine@gmail.com";
$reply_mail->Password ="Epsilon@786";
$reply_mail->SetFrom("roy.sourav8888@gmail.com", "Sourav Roy");
$reply_mail->AddReplyTo($_POST['email']);
$reply_mail->Subject = "Success Mai";
$reply_mail->MsgHTML($reply_message);
$reply_mail->Body = $reply_message;
$reply_mail->AltBody = $reply_message;

// Send To
$mail->AddAddress("roy.sourav8888@gmail.com", "Sourav Roy"); // Where to send it - Recipient
$result = $mail->Send();

if($reply_mail->Send())
{
	$previous = "javascript:history.go(-1)";
	echo "<script>
	alert('Thank you to contact with us. We Will Contact you soon.');
	window.location.href= '$previous';
	</script>";
}

}
catch(phpmailerException $ex)
{
$msg = "
".$ex->errorMessage()."
";
}
?>