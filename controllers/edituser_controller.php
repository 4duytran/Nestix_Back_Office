<?php
$rankList = getRankList();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if(isset($id))
{
    $id = str_secure($id);
    $user = new User();
    $user = $user->getUserById($id);
}
$erroFirstname = $erroLastname = $erroEmail = $erroPassword = '';

if(isset($_POST['submit']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        if(isset($_POST['password']) && !empty($_POST['password']))
        {
            if(empty($_POST['firstname']))
            {
                $erroFirstname = 'First name is required';
            }
            else if(!validNameInput($_POST['firstname']))
            {
                $erroFirstname = 'First name is wrong format';
            }
            if(empty($_POST['lastname']))
            {
                $erroLastname = 'Last name is required';
            }
            else if(!validNameInput($_POST['lastname']))
            {
                $erroLastname = 'Last name is wrong format';
            }
            if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
            {
                $erroEmail = 'Email is wrong format';
            } else if(countUserEmail($user->u_id, $_POST['email']))
            {
                $erroEmail = 'Email is already used by other user';
            }
            if($_POST['password'] !== $_POST['password2'])
            {
                $erroPassword = 'Password and confirm password does not match';
            } else
            {
                $user->u_password = password_hash(str_secure($_POST['password']), PASSWORD_BCRYPT, ['cost' => 12] );
            }

        } 
        else if (empty($_POST['password']))
        {
            if(empty($_POST['firstname']))
            {
                $erroFirstname = 'First name is required';
            }
            else if(!validNameInput($_POST['firstname']))
            {
                $erroFirstname = 'First name is wrong format';
            }
            if(empty($_POST['lastname']))
            {
                $erroLastname = 'Last name is required';
            }
            else if(!validNameInput($_POST['lastname']))
            {
                $erroLastname = 'Last name is wrong format';
            }
            if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
            {
                $erroEmail = 'Email is wrong format';
            } else if(countUserEmail($user->u_id, $_POST['email']))
            {
                $erroEmail = 'Email is already used by other user';
            }
        }

        if($erroFirstname == '' && $erroLastname == '' && $erroEmail == '' && $erroPassword == '')
        {
            
            $user->u_firstname = $_POST['firstname'];
            $user->u_lastname = $_POST['lastname'];
            $user->u_email = $_POST['email'];
            $user->u_rank_id = (int)$_POST['rank'];
            $user->u_banned = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
            $result = $user->updateUser();
            unset($_SESSION['token']);
        }
    }
    else
    {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    }
}