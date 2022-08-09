<?php
$user_confirm_code = mt_rand();


    require "Mail/phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'suipservices@gmail.com';
    $mail->Password = 'qxxsxcxtrnjggwvg';

    $mail->setFrom('suipservices@gmail.com', 'Verify Email');
    // get email from input
    $mail->addAddress($u_email);

    // HTML body
    $mail->isHTML(true);
    $mail->Subject = "Email Confirmation Message";
    $mail->Body = "

            <h2>
            Email Confirmation By SUIP
            </h2>
            
            <a href='localhost/suip/user/myaccount.php?$user_confirm_code'>
            
            Click Here To Confirm Email
            
            </a>
            
            ";
            ?>