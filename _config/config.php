<?php

// --------------------------- //
//       ERRORS DISPLAY        //
// --------------------------- //

//!\\ Warning : only active for developping
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);
ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
//error_reporting(-1);  make error show modal


// --------------------------- //
//          SESSIONS           //
// --------------------------- //

ini_set('session.cookie_lifetime', false);
session_start();
session_regenerate_id();

if(isset($_SESSION['logged']) && isset($_SESSION['log_timestamp']))
{
    if(time() - $_SESSION['log_timestamp'] > 600) { //subtract new timestamp from the old one
        $_SESSION['logged'] = false;
        session_unset();
        session_destroy();
        header('Location: home'); 
        exit();
    } else {
        $_SESSION['log_timestamp'] = time(); //set new timestamp
    }
}

// --------------------------- //
//          CSRF          //
// --------------------------- //
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

// --------------------------- //
//         CONSTANTS           //
// --------------------------- //


// Paths
define("PATH_REQUIRE", substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // For include fonction or method, class
define("PATH", substr($_SERVER['PHP_SELF'], 0, -9)); // For include image or others files

// Website informations
define("WEBSITE_TITLE", "Nestix Administrator");
define("WEBSITE_NAME", "Nestix Administrator");
define("WEBSITE_URL", "https://monsite.com");
define("WEBSITE_DESCRIPTION", "Description du site");
define("WEBSITE_KEYWORDS", "");
define("WEBSITE_LANGUAGE", "");
define("WEBSITE_AUTHOR", "");
define("WEBSITE_AUTHOR_MAIL", "");