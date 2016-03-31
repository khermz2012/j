<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/31/2016
 * Time: 1:15 PM
 */
require_once './PHPMailer-master/PHPMailerAutoload.php';

class Mail
{
    public function sendAlertMail($firstname, $lastname, $email)
    {
        $cust = $firstname . ' ' . $lastname;

        $mail = new PHPMailer;

//        $mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'samuel.agyeman@ashesi.edu.gh';
        $mail->Password = 'blender10';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('samuel.agyeman@ashesi.edu.gh', 'Trendy Gear');
        $mail->addAddress($email, $cust);

        $mail->isHTML(true);

        $mail->Subject = 'Your Order is Being Processed';
        $mail->Body = '<p>Hi ' . $cust . '</p> <p>Your order is being processed. We will get back to you within the next 24hrs.</p>
        <p>Thank you for shopping with Trendy-Gear.</p><br> <p style="text-align: left">The Trendy-Gear Team</p>';

//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function sendConfirmMail($firstname, $lastname, $email, $date)
    {
        $cust = $firstname . ' ' . $lastname;

        $mail = new PHPMailer;

//        $mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'samuel.agyeman@ashesi.edu.gh';
        $mail->Password = 'blender10';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('samuel.agyeman@ashesi.edu.gh', 'Trendy Gear');
        $mail->addAddress($email, $cust);

        $mail->isHTML(true);

        $mail->Subject = 'Your Order Has Being Processed';
        $mail->Body = '<p>Hi ' . $cust . ',</p>'.
         '<p>Your order made on '.$date.' has been processed and has been shipped.</p>
         <p>Your should recieve your order within the next 48 hrs.</p>
         <p>Thank you for shopping with Trendy-Gear.</p>
         <br>
         <p style="text-align: left; color: #f3b715;">The Trendy-Gear Team</p>';

//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}