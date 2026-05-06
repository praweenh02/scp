<?php
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'dssolution.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dssolution.in';
        $mail->Password = 'AdminNew@#$1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('info@dssolution.in', 'Standard Coordination Portal
');
        $mail->addReplyTo('info@dssolution.in', 'Standard Coordination Portal
');
       $mail->isHTML(true);
       $mail->Body = $mailContent;

?>