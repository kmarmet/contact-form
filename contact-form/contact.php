<?php require_once 'inc/contact-form/spamBlocker/setToken.php';?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="UTF-8">
      <meta name="description" content="Contact">
      <title>Contact</title>
      <!-- Google reCaptcha -->
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   </head>
   <body>
      <main role="main">
               <div class="contact-error dw-60 tw-100"></div>
               <form action="inc/contact-form/spamBlocker/validate.php" method="POST" class="contact-form" enctype="application/x-www-form-urlencoded">
                  <div class="textbox-cont dw-70 tw-100">
                     <div class='flexbox-spread-wrap'>
                        <input class='textbox dw-45' type="text" name="first_name" placeholder="FIRST NAME *">
                        <input class='textbox dw-45' type="text" name="last_name" placeholder="LAST NAME *">
                     </div>
                     <div class='flexbox-spread-wrap'>
                        <input class='textbox dw-45' type="text" name="title" placeholder="TITLE">
                        <input class='textbox dw-45' type="text" name="company" placeholder="COMPANY/MUNICIPALITY">
                     </div>
                     <div class='flexbox-spread-wrap'>
                        <input class='textbox dw-45' type="text" name="address_one" placeholder="ADDRESS ONE *">
                        <input class='textbox dw-45' type="text" name="address_two" placeholder="ADDRESS TWO">
                     </div>
                     <div class='flexbox-spread-wrap'>
                        <input class='textbox dw-30' type="text" name="city" placeholder="CITY *">
                        <input class='textbox dw-30' type="text" name="state" placeholder="STATE OR PROVINCE *">
                        <input class='textbox dw-30' type="text" name="zip" placeholder="POSTAL CODE *">
                     </div>
                     <input class='textbox dw-45' type="text" name="country" placeholder="COUNTRY *">
                     <div class='flexbox-spread-wrap'>
                        <input class='textbox dw-45' type="tel" name="phone" placeholder="PHONE *">
                        <input class='textbox dw-45' type="email" name="email" placeholder="EMAIL *">
                     </div>
                  </div>
                  <!-- FORM SECURITY -->
                  <!-- Honeypot -->
                  <input style="display: none;" name="hp" type="text"/>
                  <!-- CSRF Token -->
                  <input type="hidden" name="token" value="<?php echo $token; ?>" class="token">
                  <div class="g-recaptcha" data-sitekey="GOOGLE RECAPTHCA SITEKEY"></div>
                  <div class='skewed-red-bg'>
                     <input name='submit' type="submit" value="SUBMIT" class="contact-submit button">
                  </div>
               </form>
      </main>
      <!-- Scripts -->
      <script src='inc/contact-form/spamBlocker/main.js'></script>
   </body>

</html>
