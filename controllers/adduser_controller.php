<?php
$rankList = getRankList();

$erroFirstname = $erroLastname = $erroEmail = $erroPassword = $dateErr = '';

if(isset($_POST['submit']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
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
        } else if(countUserEmail($_POST['email']))
        {
            $erroEmail = 'Email is already used by other user';
        }
        if(empty($_POST['password']) || empty($_POST['password2']))
        {
            $erroPassword = 'Password is required';
        } 
        else if ($_POST['password'] !== $_POST['password2'])
        {
            $erroPassword = 'Password and confirm password does not match';
        }
        if (empty($_POST["uDate"])) {
            $dateErr = "Date of birthday is required";
        }
        else if (validateDate($_POST["uDate"]) != true){
            $dateErr = "Date of birthday is wrong format";
        }
        

        if($erroFirstname == '' && $erroLastname == '' && $erroEmail == '' && $erroPassword == '' && $dateErr == '')
        {
            $user = new User();
            $user->u_firstname = $_POST['firstname'];
            $user->u_lastname = $_POST['lastname'];
            $user->u_email = $_POST['email'];
            $user->u_dob = $_POST['uDate'];
            $user->u_password = password_hash(str_secure($_POST['password']), PASSWORD_BCRYPT , ['cost' => 12]);
            $user->u_rank_id = (int)$_POST['rank'];
            $result = $user->creatUser();
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
