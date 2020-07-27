<?php

$errorfile = '';

if(isset($_POST['submit']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        if (isset($_FILES['image'])) {
            $errorfile = '1';
            if ($_FILES['image']['size'] <= 2000000 || $_FILES['image']['error'] == 1) {
                $infoImage = pathinfo($_FILES['image']['name']);
                $extImage = $infoImage['extension'];
                $extAccept = array('png', 'gif', 'jpg', 'jpeg');
                if ( in_array( $extImage, $extAccept ) ) {
                    $destination = '/home/c1260692c/public_html/laravel/public/img/'.time().time().'_'.basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $errorfile = '';
                        $file = new File();
                        $file->file_chemin = substr($destination, strrpos($destination, '/') + 1);
                        $file->file_show = 0;
                        $file->store();
                        unset($_SESSION['token']);
                    } else {
                        $errorfile = 'Your file can not upload with error: '.$_FILES['image']['error'];
                    }
                } else {
                    $errorfile = 'Only image accepted (png, gif, jpg, jpeg)';
                }

            } else {
                
                $errorfile = 'Your file is to big , limit is 2 Mo';
            }
        } else {
            $errorfile = 'File is empty';
        }
    } else {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    }
}