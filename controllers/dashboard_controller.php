<?php
$email = $_SESSION['log_email'];
$log_time = $_SESSION['last_logged_time'];
$listLastUser = getLastUser();
$listLastMedias = getLastMedia();
$listTopMedias = getTopMedia();
$listActiveUser = getActiveUser();