<?php

$sagaList = getSagaList();
$genreList = getGenreList();
$typeList = getTypeList();
$images = File::showAllFilesGalery();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if(isset($id))
{
    $id = str_secure($id);
    $media = new Media();
    $media = $media->getMediaById($id);
    $media->m_genre = explode(",", $media->m_genre);
}

$error = $erroTitle = $erroYear = $erroBook = $erroType = $errorImage= '';

if(isset($_POST['submit']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        if(empty($_POST['title']))
        {
            $erroTitle = 'Media title is required';
        }
        else if (!validNameMediaInput($_POST['title']))
        {
            $erroTitle = 'Media title is wrong format';
        }
        if(empty($_POST['year']))
        {
            $erroYear = 'Media year is required';
        } 
        else if (!validYearInput($_POST['year']))
        {
            $erroYear = 'Media year is wrong format';
        }
        if (!empty($_POST['image'])) {
            $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
            $file = new File();
            $file->setNull($media->m_id);
            $file->update($image, $media->m_id);
        }
        if (empty($_POST['type']))
        {
            $erroType = 'Media type is required';
        } else
        {
            if($_POST['type'] == 2)
            {
                if(!empty($_POST['isbn']))
                {
                    if (!validIsbnInput($_POST['isbn']))
                    {
                        $erroBook = 'Number ISBN is wrong format (Only number accepted)';
                    }
                }              
            } 
            else
            {
                if(!empty($_POST['isbn']))
                {
                    $erroBook = 'Number ISBN is only for book';
                }
            }
        }

        if($erroTitle == '' && $erroYear == '' && $erroBook == '' && $erroType == '')
        {
            
            filter_var($str, FILTER_SANITIZE_STRING);
            $media->m_name = $_POST['title'];
            $media->m_year = $_POST['year'];
            $media->m_type = $_POST['type'];
            $media->m_valid = filter_input(INPUT_POST, 'valid', FILTER_VALIDATE_INT);
            $media->m_genre = array_filter($_POST['genre']);
            $media->m_isbn = (!empty($_POST['isbn'])) ? $_POST['isbn'] : NULL;
            $media->m_saga = (!empty($_POST['saga'])) ? $_POST['saga'] : NULL;
            if (checkMediaDouble($media->m_id,$media->m_name, $media->m_year,$media->m_type))
            {
     
                $error = 'This media is already existed';
            }
            else
            {
                $media->updateMedia();
                unset($_SESSION['token']);
            }
        }
    } 
    else
    {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    }
}