<?php
Auth::logout();
if(!isset($_SESSION['logged']))
{
    header('location: home');
    exit();
}