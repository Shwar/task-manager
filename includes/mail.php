<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; 

function sendTaskEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'simonkiragu04@gmail.com'; // use your email
        $mail->Password   = 'ncgl wtch xoiv lnzx ';    // app password for Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

      
        $mail->setFrom('simonkiragu04@gmail.com', 'Simon - Task Manager');
        $mail->addAddress($to);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
