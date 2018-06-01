# spamBlocker
<i>Set of helper files to block form spam</i>

<h1>Don't forget to... </h1>
<ul>
  <li>Add honeypot to HTML form</li>
  <li>Add token to HTML form</li>
  <li>Require setToken script at top of contact page</li>
  <li>Change secret reCaptcha key in validate.php</li>
  <li>Change errors/submit/token classes in main.js</li>
  <li>Add a div to the HTML to catch errors if one does not exist</li>
</ul>

<hr>

<b>HONEY POT</b> <br>
``` <input style="display: none;" name="hp" type="text"/>```

<b>TOKEN</b> <br>
``` <input type="hidden" name="token" value="<?php echo $token; ?>" class="token">  ```

<b>REQUIRE SET TOKEN SCRIPT</b><br>
```require_once 'inc/secureForm/setToken.php'; ```
