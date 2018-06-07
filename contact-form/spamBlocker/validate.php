<?php
   session_start();
   // Google reCaptcha
   $response   = $_POST['response'];
   $secret_key = 'GOOGLE RECAPTCHA SECRET KEY';
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
   $input_array = json_decode($_POST['input_array']);
   $error         = '';

   // Helpers
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
   if (is_array($input_array)) {
      $input_array = implode('<br>', $input_array);
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
   if (strlen($error) <= 0 && strlen($redirect) <= 0) {
      require_once '../send-email.php';
   }

   // Pass to front end
   $ajax_array = array(
      'debug'    => $debug,
      'error'    => $error,
      'redirect' => $redirect
   );

   echo json_encode($ajax_array);



