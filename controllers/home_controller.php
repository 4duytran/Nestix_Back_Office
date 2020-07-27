<?php
$error = '';
if (isset($_POST['submit']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
        {
            $email = str_secure($_POST['email'], trim);
            $password = str_secure($_POST['password'], trim);
            $getPasswordByEmail = Auth::getPassByEmail($email);
            $isLogged = password_verify($password, $getPasswordByEmail);
            if($isLogged)
            {
                if(!isset($_SESSION['logged']) || empty($_SESSION['logged']))
                {
                    $_SESSION['logged'] = true;
                }
                if(!isset($_SESSION['log_email']) || empty($_SESSION['log_email']))
                {
                    $_SESSION['log_email']  = $email;
                }

                $_SESSION['log_timestamp'] = time();

                // Cookies security

                if(!isset($_SESSION['ticket']) || !isset($_COOKIE['nest']))
                {
                    $cookie_name = "nest";
                    $ticket = bin2hex(random_bytes(32));
                    $ticket = hash('sha512', $ticket);
                    setcookie($cookie_name, $ticket, time() + (60 * 20), null, null, false, true); 
                    $_SESSION['ticket'] = $ticket;
                }
                   

                // Insertion sql log
                $admin_id = Auth::getIdByEmail($email);
                if(Auth::dblog($admin_id)->rowCount() != 0)
                {
                    $_SESSION['last_logged_time'] = dateConvert(Auth::getLogTime($admin_id)['log_time']);
                }
            } 
            else
            {
                $error = 'Email or Password is wrong';
            }
        } else 
        {
            $error = 'Email or Password is required';
        }
    } else
    {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    } 
} 

if(isset($_SESSION['logged']) && $_SESSION['logged'] === true)
{
    header('location: dashboard');
     unset($_SESSION['token']);
    exit();

}
