<?php
include_once "phpmailer/class.phpmailer.php"; //inclusion du fichier si le dossier "phpmailer" se trouve dans le même dossier que notre page web

function envoiMail($adresseMail, $sujet, $message) {        
        $mail = new PHPmailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug=true;    //permet de voir les erreurs si ça ne fonctionne pas    
        
        $mail->Host='localhost'; // Connexion au serveur SMTP
        $mail->Port = 25;
        

        $mail->SMTPAuth = true; // Cette partie est optionnelle si le serveur SMTP n'a pas besoin d'authentification
        $mail->Username = 'postmaster[at]monsite.e4y.fr'; // mettre l'adresse email que founit l'hébergeur
        $mail->Password = 'monMotDePasse'; // le mot de passe pour se connecter à votre boite mail sur l'hébergeur



        $mail->IsHTML(true); // Permet d'écrire un mail en HTML (=> conversion des balises
        $mail->CharSet = 'UTF-8'; // évite d'avoir des caractères chinois :)
        $mail->From ='postmaster[at]monsite.e4y.fr'; // adresse mail du compte qui envoi
        $mail->FromName = "Data Engine Dasihaulien"; // remplace le nom du destinateur lors de la lecture d'un email
        $mail->AddAddress($adresseMail); // adresse du destinataire, plusieurs adresses possibles en même temps !
        $mail->AddReplyTo('postmaster[at]monsite.e4y.fr'); // renvoi une copie de l'email au destinateur, fonctionnalité pas toujours opérationnelle
        $mail->Subject=$sujet; // l'entête = nom du sujet
        $mail->Body=$message; // le corps = le message en lui-même, codé en HTML si vous voulez
        //$mail->AltBody="This is text only alternative body."; // corps du message à afficher si le HTML n'est pas accepter par celui qui lit le message
        if(!$mail->Send()) {
            $_REQUEST['error'] = $mail->ErrorInfo; // affiche une erreur => pas toujours explicite
        }
        $mail->SmtpClose();
        unset($mail); // ferme la connexion smtp et désalloue la mémoire...
}
?>