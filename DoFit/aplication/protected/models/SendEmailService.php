<?php

class SendEmailService
{
	public function Send($email_destino){
         $email_destino_enc =  md5($email_destino);
		 $message = '<html>
                    <body>
					<h1>¡Hola!</h1>
					<br>
					Confirmá tu registración, pegando la siguiente URL en el navegador que quieras:
					<br> 
					http://localhost/DOFIT_FINAL/DoFit/aplication/usuario/ActivarUsuario/?email='.$email_destino_enc.';
					<br>
					¡Gracias por registrarte! Que disfrutes de la web
					<br>
					El equipo de <b>DoFit!</b>.
					</body>
					</html>';
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPDebug  = 1;
        $mailer->Host = 'ssl://smtp.gmail.com';
        $mailer->SMTPAuth   = true;
        $mailer -> IsHTML (true);
        $mailer->IsSMTP();
        $mailer->Port='465';
        $mailer->From = 'programacionweb3@gmail.com';
        $mailer->Username = 'programacionweb3@gmail.com';
        $mailer->Password = 'Montoto123';
        $mailer->AddAddress($email_destino);
        $mailer->FromName = 'Dofit!';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = 'Confirmá tu registración a DoFit!';
        $mailer->Body = $message;
        $mailer->Send();
    }

	public function Reestablecerpassword($email){
        $message = '<html>
                    <body >
					<h1>¡Hola!</h1>
					<br>
					Para reestablecer su contraseña, clickea o pega la siguiente URL en el navegador que quieras:
					<br>
					"http://localhost/DOFIT_FINAL/DoFit/aplication/usuario/Recuperarpassword2/?email='.$email.';
					<br>
					¡Muchas Gracias! Que disfrutes de la web.
					<br>
					El equipo de <b>DoFit!</b>.
					</body>
					</html>';
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPDebug  = 1;
        $mailer->Host = 'ssl://smtp.gmail.com';
        $mailer->SMTPAuth   = true;
        $mailer -> IsHTML (true);
        $mailer->IsSMTP();
        $mailer->Port='465';
        $mailer->From = 'info@dofitproyect.esy.es';
        $mailer->Username = 'info@dofitproyect.esy.es';
        $mailer->Password = 'sL7BbUhaAx';
        $mailer->AddAddress($email);
        $mailer->FromName = 'Dofit!';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = 'Reestabler contraseña de DoFit!';
        $mailer->Body = $message;
        $mailer->Send();
    }
}
