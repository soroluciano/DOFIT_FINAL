<?php

class SendEmailService
{
	public function Send($email_destino){
        $message = '<html>
                    <body >
					<h1>¡Hola!</h1>
					<br>
					Confirmá tu registración, pegando la siguiente URL en el navegador que quieras:
					<br>
					http://www.google.com.ar
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
        $mailer->From = 'dofit@noreply.com';
        $mailer->Username = 'programacionweb3@gmail.com';
        $mailer->Password = 'montoto123';
        $mailer->AddAddress('programacionweb3@gmail.com');
        $mailer->FromName = 'Dofit!';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = 'Confirmá tu registración a DoFit!';
        $mailer->Body = $message;
        $mailer->Send();
    }
}