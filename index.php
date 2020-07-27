<?php
include_once '_config/config.php';
include_once '_functions/function.php';
include_once '_classes/Autoloader.php'; 
Autoloader::loadClass();


// Init page access for the site
if (isset($_GET['page']) AND !empty($_GET['page']))
{
    $page = trim(htmlspecialchars(strtolower($_GET['page']))); // check if page name is not empty
   
} else 
{
    $page = 'home'; // if empty will give value by default
}

// Check all pages of the site

$allPage = scandir('controllers/');

// Check if find name of page
if(in_array($page."_controller.php", $allPage))
{
    // include all pages
    /**
     * Check if user is admin or not , if yes we will give access 
     * if not include only page home
     */
    if(isset($_SESSION['logged']) && $_SESSION['logged'] === true)
    {
        // and here we check the cookie in every pages, if true will give another value for the session
        if (hash_equals($_COOKIE['nest'] ,$_SESSION['ticket'])) 
        {
            $cookie_name = "nest"; // set cookie name
            $ticket = bin2hex(random_bytes(32)); // set ticket value
            $ticket = hash('sha512', $ticket); // hash ticket value with sha512
            setcookie($cookie_name, $ticket, time() + (60 * 20), null, null, false, true);  // set cookie parametter
            $_SESSION['ticket'] = $ticket; // give value of ticket to session
        } 
        else // if the cookie is not find or wrong , redirect to home page 404
        {
            /**
             * Here we will remove all trace (session, cookies) 
             * this action will make disconnect user
             */
            $cookie_name = "nest";
            setcookie($cookie_name, null, time() - 3600, null, null, false, true);
            session_unset();
            session_destroy();
            header('location: 404');
            exit();
        }
        include_once 'models/'.$page.'_model.php';
        include_once 'controllers/'.$page.'_controller.php';
        include_once 'views/'.$page.'_view.php'; 
             
    }
    else
    {
        include_once 'models/home_model.php';
        include_once 'controllers/home_controller.php';
        include_once 'views/home_view.php';
        
    }
    
} 
else
{
    // return error if can not find the page
    include_once 'views/404_view.php';
}

?>