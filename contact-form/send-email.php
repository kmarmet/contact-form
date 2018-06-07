<?php
   $mail_body = "
        <table width='600' border='0' cellspacing='0' cellpadding='5'>
            <tr style='background-color: #d7d7d7;'>
               <td width='250'><strong>First Name:</strong></td>
               <td>$first_name</td>
            </tr>
            <tr>
               <td width='250'><strong>Last Name:</strong></td>
               <td>$last_name</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong>Title:</strong></td>
               <td>$title</td>
            </tr>
            <tr>
               <td width='250'><strong>Company:</strong></td>
               <td>$company</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td valign='top'><strong>Address:</strong></td>
               <td>$address_one</td>
            </tr>
            <tr>
               <td valign='top'><strong>Address Two:</strong></td>
               <td>$address_two</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong>City / Province:</strong></td>
               <td>$city</td>
            </tr>
            <tr>
               <td width='250'><strong>State / Province:</strong></td>
               <td>$state</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong>Zip / Postal Code:</strong></td>
               <td>$zip</td>
            </tr>
            <tr>
               <td width='250'><strong>Country:</strong></td>
               <td>$country</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong>Email:</strong></td>
               <td>$email</td>
            </tr>
            <tr>
               <td width='250'><strong>Phone:</strong></td>
               <td>$phone</td>
            </tr>
            <tr>
               <td width='250'><strong>Project Description:</strong></td>
               <td>$description</td>
            </tr>
        </table> ";

   // SERVER SETTINGS
   require_once 'PHPMailer/PHPMailerAutoload.php';
   $mail           = new PHPMailer();
   // $debug          = $mail->SMTPDebug = 2;
   $mail->From     = $email;
   $mail->FromName = "{$first_name} {$last_name}";
   $mail->Host     = 'dedrelay.secureserver.net';
   $mail->Mailer   = "smtp";

   // RECIPIENTS
   $mail->addAddress('kmarmet1@gmail.com', 'Kevin');
   $mail->addAddress('kevin@whitemyer.com', 'Kevin');
   // $mail->addBCC('email@email.com');
   // $mail->addCC('email@email.com');
   // $mail->addReplyTo($email, $first_name);

   // CONTENT
   $mail->Subject = 'Web Inquiry';
   $mail->Body    = $mail_body;
   $mail->AltBody = $mail_body;

   // ATTACHMENTS
   // $mail->addAttachment('/var/tmp/file.tar.gz');
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

   if (!$mail->Send()) {
      echo "<p>&#8226; Error sending mail: {$mail->ErrorInfo} Please try again</p>";
   }
   else {
      $mail->clearAddresses();
      $mail->clearAttachments();
   }