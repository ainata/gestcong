<?php
require_once "PHPMailer/PHPMailerAutoload.php"; //inclusion du fichier si le dossier "phpmailer" se trouve dans le même dossier que notre page web

		include("PHPMailer/class.phpmailer.php");
		include("PHPMailer/class.smtp.php");

 		$mail = new PHPmailer();
        $mail->IsSMTP();
		$mail->SMTPAuth = true;
        $mail->SMTPDebug=2;   
        
        $mail->Host='smtp.gmail.com';
        $mail->Username = 'stagiaireigexao2014@gmail.com';
        $mail->Password = 'igexao2014';
		$mail->SMTPSecure='ssl';
		$mail->Port = 465;
		$mail->From='stagiaireigexao2014@gmail.com';
		$mail->FromName='izaho';
		
		$mail->addReplyTo('mbolasitrakaa@gmail.com','Reply address');
		$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
		$mail->addAddress('mbolasitrakaa@gmail.com','Reply address');
		$mail->Subject='mail ito an'; // l'entête = nom du sujet
        $mail->Body='body ny email ty';
		$mail->AltBody="This is text only alternative body.";
		var_dump($mail->Send());
		/*if($mail->Send()){
			echo "lasa";
		}
		else
		{
			echo $mail->ErrorInfo;
		}*/
?>