<?php
   session_start();
   $token             = bin2hex(openssl_random_pseudo_bytes(32));
   $_SESSION['token'] = $token;
