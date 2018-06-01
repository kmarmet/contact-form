<?php
   session_start();
   // Google reCaptcha
   $response   = $_POST['response'];
   $secret_key = '6Lc4x1wUAAAAAAU-FaJe2c0L6vhFmv0avXBD5hbp';
   $verify     = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$response}"));

   // CSRF Token
   $token = $_POST['token'];

   // Form Inputs
   $first_name    = clean_input($_POST["first_name"]);
   $last_name     = clean_input($_POST["last_name"]);
   $title         = clean_input($_POST["title"]);
   $company       = clean_input($_POST["company"]);
   $address_one   = clean_input($_POST["address_one"]);
   $address_two   = clean_input($_POST["address_two"]);
   $city          = clean_input($_POST["city"]);
   $state         = clean_input($_POST["state"]);
   $zip           = clean_input($_POST["zip"]);
   $country       = clean_input($_POST["country"]);
   $phone         = clean_input($_POST["phone"]);
   $email         = clean_input($_POST["email"]);
   $inquiry_array = json_decode($_POST['inquiry_array']);
   $model_array   = json_decode($_POST['model_array']);
   $error         = '';

   // Helpers
   $required_field_counter = 0;
   $redirect               = '';
   $required_fields        = array(
      'First Name'      => $first_name,
      'Last Name'       => $last_name,
      'Address One'     => $address_one,
      'City'            => $city,
      'State'           => $state,
      'Zip/Postal Code' => $zip,
      'Country'         => $country,
      'Phone'           => $phone,
      'Email'           => $email
   );
   $spammer_ips            = array(
      'Test' => 'test'
   );

   // Form Arrays
   if (is_array($model_array)) {
      $model_array = implode('<br>', $model_array);
   }
   if (is_array($inquiry_array)) {
      $inquiry_array = implode('<br>', $inquiry_array);
   }

   // Clean Data
   function clean_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);

      return $data;
   }

   // CHECK FOR EMPTY REQUIRED INPUTS
   foreach($required_fields as $field => $value) {
      $required_field_counter++;
      if (empty($value)) {
         if ($required_field_counter < 2) {
            $error .= "<h3>Missing:</h3>";
         }
         $error .= "<p>&#8226; {$field}</p>";
      }
   }

   // CSRF Token Check
   if ($_SESSION['token'] !== $token) {
      session_destroy();
      $redirect = 'true';
   }

   // Google reCaptcha Check
   if ($verify->success === false) {
      $error .= '<p>&#8226; Please click the checkbox at the end of the form.</p>';
   }

   // Block known spammers
   if (in_array($_SERVER['REMOTE_ADDR'], $spammer_ips, true)) {
      $redirect = 'true';
   }

   // If form field contains
   if (preg_match('/viagra|cialis|poker|casino/', $email)) {
      $redirect = 'true';
   }

   // Check phone format
   if (!empty($phone)) {
      $phone          = str_replace(" ", "", $phone);
      $stripped_phone = preg_replace("/[^0-9.\(\)+-]/", "", $phone);
      if ($phone !== $stripped_phone) {
         $error .= '<p>&#8226; Phone is an invalid format.</p>';
      }
      else {
         $phone = $stripped_phone;
      }
   }

   // Check email format
   if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
      $error .= "<p>&#8226; Invalid email format</p>";
   }

   // IF NO ERRORS -> SEND EMAIL
   if (strlen($error) <= 0 && strlen($redirect) <=0) {
      $mail_body = "
        <table width='600' border='0' cellspacing='0' cellpadding='5'>
            <tr>
                <td valign='top' width='250'><strong>My inquiry is in reference to:</strong></td>
                <td>$inquiry_array</td>
            </tr>
            <tr style='background-color: #d7d7d7;'>
               <td width='250'><strong> First Name:</strong></td>
               <td>$first_name</td>
            </tr>
            <tr>
               <td width='250'><strong> Last Name:</strong></td>
               <td>$last_name</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong> Title:</strong></td>
               <td>$title</td>
            </tr>
            <tr>
               <td width='250'><strong> Company:</strong></td>
               <td>$company</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td valign='top'><strong> Address:</strong></td>
               <td>$address_one</td>
            </tr>
            <tr>
               <td valign='top'><strong> Address Two:</strong></td>
               <td>$address_two</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong> City / Province:</strong></td>
               <td>$city</td>
            </tr>
            <tr>
               <td width='250'><strong> State / Province:</strong></td>
               <td>$state</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong> Zip / Postal Code:</strong></td>
               <td>$zip</td>
            </tr>
            <tr>
               <td width='250'><strong> Country:</strong></td>
               <td>$country</td>
            </tr>
            <tr style='background-color: #d7d7d7;' >
               <td width='250'><strong> Email:</strong></td>
               <td>$email</td>
            </tr>
            <tr>
               <td width='250'><strong> Phone:</strong></td>
               <td>$phone</td>
            </tr>
            <tr>
               <td valign='top' width='250'><strong> I would like more information on the following models:</strong></td>
               <td>$model_array</td>
            </tr>
        </table> ";

      // SERVER SETTINGS
      require_once '../PHPMailer/PHPMailerAutoload.php';
      $mail = new PHPMailer();
      // $mail->SMTPDebug 					= 2;
      $mail->From     = $email;
      $mail->FromName = "{$first_name} {$last_name}";
      $mail->Host     = 'dedrelay.secureserver.net';
      $mail->Mailer   = "smtp";

      // RECIPIENTS
      $mail->addAddress('kevin@whitemyer.com');
      // $mail->addAddress('mtnorman@gradall.com');
      // $mail->addBCC('lisa@whitemyer.com');
      // $mail->addCC('wgpetrole@gradall.com');
      $mail->addReplyTo($email, $first_name);
      // $mail->AddCc		('erdietrich@gradall . com');
      // $mail->addAddress('kevin@whitemyer.com');

      // CONTENT
      $mail->Subject = 'Vacall Web Inquiry';
      $mail->Body    = $mail_body;
      $mail->AltBody = $mail_body;

      // ATTACHMENTS
      // $mail->addAttachment('/var/tmp/file.tar.gz');
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

      if (!$mail->Send()) {
         echo "<p>&#8226; Error sending mail: {$mail->ErrorInfo} Please try again</p>";
      }
      else {
         $mail->ClearAddresses();
         $mail->ClearAttachments();
      }
   }

   $debug = $verify->success;

   // Pass to front end
   $ajax_array = array(
      'debug'    => $debug,
      'error'    => $error,
      'redirect' => $redirect
   );

   echo json_encode($ajax_array);



