<?php require_once 'inc/contact-form/spamBlocker/setToken.php'; ?>
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
            <div class="contact-error"></div>
            <form action="inc/contact-form/spamBlocker/validate.php" method="POST" class="contact-form" enctype="application/x-www-form-urlencoded">
                <input type="text" name="first_name" placeholder="FIRST NAME *" required='required'>
                <input type="text" name="last_name" placeholder="LAST NAME *" required='required'>
                <input type="text" name="title" placeholder="TITLE">
                <input type="text" name="company" placeholder="COMPANY/MUNICIPALITY">
                <input type="text" name="address_one" placeholder="ADDRESS ONE *" required='required'>
                <input type="text" name="address_two" placeholder="ADDRESS TWO">
                <input type="text" name="city" placeholder="CITY *" required='required'>
                <input type="text" name="state" placeholder="STATE OR PROVINCE *" required='required'>
                <input type="text" name="zip" placeholder="POSTAL CODE *" required='required'>
                <input type="text" name="country" placeholder="COUNTRY *" required='required'>
                <input type="tel" name="phone" placeholder="PHONE *" required='required'>
                <input type="email" name="email" placeholder="EMAIL *" required='required'>
                <!-- FORM SECURITY -->
                <!-- Honeypot -->
                <input style="display: none;" name="hp" type="text"/>
                <!-- CSRF Token -->
                <input type="hidden" name="token" value="<?php echo $token; ?>" class="token">
                <div class="g-recaptcha" data-sitekey="GOOGLE RECAPTHCA SITEKEY"></div>
                <input name='submit' type="submit" value="SUBMIT" class="contact-submit button">
            </form>
        </main>
        <!-- Scripts -->
        <script src='inc/contact-form/spamBlocker/main.js'></script>
    </body>

</html>
