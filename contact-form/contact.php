<?php require_once 'inc/contact-form/spamBlocker/setToken.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="description" content="Contact Vacall to learn more about sewer cleaners, hydro excavators, street sweepers, catch basin cleaners or industrial vacuum loaders, or to request a demo.">
        <title>Contact Vacall for Information about our Products</title>
        <link rel='stylesheet' href='/css/styles.min.css'>
        <link rel="stylesheet" href="https://use.typekit.net/lgb4psl.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Google reCaptcha -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body class='page-wrapper contact'>
       <?php require_once 'inc/_inc-navigation.php';
          require_once 'inc/_inc-onscroll-navigation.php';
          ?>
        <main role="main">
            <section class="grid-cont">
                <div class="hero-header-copy">
                    <div class='img-cont dw-40 hide-on-tablet'>
                        <a href='/index.php'>
                            <img src='/img/vacall-logo-red.png' alt='Vacall Logo'>
                        </a>
                    </div>
                    <div class='breadcrumbs hide-on-tablet'>
                       <?php breadcrumbs(); ?>
                    </div>
                    <h1 class="large-header">CONTACT</h1>
                    <h2 class="slanted-subheader">TELL ME HOW VACALL CAN IMPROVE MY PRODUCTIVITY</h2>
                </div>
                <section class="contact-content">
                    <h3 class="contact-red-intro dw-50 tw-100">To learn more about Vacall machines or to request a demo of our latest models, please fill out this form.
                        Or contact us at
                        <a href="tel:8004454752">800-445-4752.</a>
                    </h3>
                    <div class="contact-error dw-60 tw-100"></div>
                    <form action="inc/contact-form/spamBlocker/validate.php" method="POST" class="contact-form" enctype="application/x-www-form-urlencoded">
                        <p>My inquiry is in reference to:</p>
                        <div class='flexbox-wrap'>
                            <div class="contact-red-checkbox inquiry-type" data-contact-type='inquiry'>
                                <input type="checkbox" name="inquiry_type[]" value="Sales">
                            </div>
                            <label class='dw-30 tw-30 mw-80'>Sales</label>
                            <div class="contact-red-checkbox inquiry-type" data-contact-type='inquiry'>
                                <input type="checkbox" name="inquiry_type[]" value="Service">
                            </div>
                            <label class='dw-30 tw-30 mw-80'>Service</label>
                        </div>
                        <div class='flexbox-wrap'>
                            <div class="contact-red-checkbox inquiry-type" data-contact-type='inquiry'>
                                <input type="checkbox" name="inquiry_type[]" value="I'd like a demo">
                            </div>
                            <label class='dw-30 tw-30 mw-80'>I'd like a demo</label>
                            <div class='contact-red-checkbox inquiry-type' data-contact-type='inquiry'>
                                <input type="checkbox" name="inquiry_type[]" value="Who is my distributor?">
                            </div>
                            <label class='dw-30 tw-30 mw-80'>Who is my distributor?</label>
                        </div>
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
                        <p class="disclaimer">* DENOTES REQUIRED INFORMATION</p>
                        <p>I would like more information on the following models:</p>
                        <hr>
                        <div class='flexbox-wrap'>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="AJV Combination Sewer Cleaners">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>AJV Combination Sewer Cleaners</label>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="AllCatch Catch Basin Cleaners">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>AllCatch Catch Basin Cleaners</label>
                        </div>
                        <div class='flexbox-wrap'>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="AllExcavate Hydro Excavators">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>AllExcavate Hydro Excavators</label>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="All Sweep Street Sweepers">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>All Sweep Street Sweepers</label>
                        </div>
                        <div class='flexbox-wrap'>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="AllVac Industrial Vacuum Loaders">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>AllVac Industrial Vacuum Loaders</label>
                            <div class="contact-red-checkbox" data-contact-type='model'>
                                <input type="checkbox" name="model_inquiry" value="Recycler">
                            </div>
                            <label class='dw-45 tw-40 mw-80'>Recycler</label>
                        </div>
                        <!-- FORM SECURITY -->
                        <!-- Honeypot -->
                        <input style="display: none;" name="hp" type="text"/>
                        <!-- CSRF Token -->
                        <input type="hidden" name="token" value="<?php echo $token; ?>" class="token">
                        <div class="g-recaptcha" data-sitekey="6Lc4x1wUAAAAADKv2mp0UIvqh7Mkdl2MI-l0HMz9"></div>
                        <div class='skewed-red-bg'>
                            <input name='submit' type="submit" value="SUBMIT" class="contact-submit button">
                        </div>
                    </form>
                </section>
            </section>
        </main>
       <?php require_once 'inc/_inc-footer.php'; ?>
        <!-- Scripts -->
        <script src="js/common.min.js"></script>
<!--        <script src="js/_page-contact-min.js"></script>-->
        <script src='inc/contact-form/spamBlocker/main.js'></script>
    </body>

</html>