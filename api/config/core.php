<?php

session_start();

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Africa/Lagos');

// variables used for jwt
$key = "un";
$iss = "www";
$aud = "key";
$iat = 1;
$nbf = 1;