<?php
if(isset($_GET['term'])){
    $search = $_GET['term'];
    $reponse = searchFilm($search);
    exit(json_encode($reponse));
}
$typeMedia = 'Film';
$limit = 10; // give limit per page
$pagination = (isset($_GET['nb'])) ? $_GET['nb']:1;  // check url if not exist give number of page = 1
$start = ($pagination-1) * $limit; // give limit start for sql request
if(isset($_POST['search']) && !empty($_POST['search']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        $search = addslashes($_POST['search']);
        $totalMedia = (int)countAllFilm($search); // count total row of sql request
        $listAllMedias = Media::showMediaByType($start, $limit, $typeMedia, $search);
        unset($_SESSION['token']);
    } else
    {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    }
} else
{
    $totalMedia = (int)countAllFilm(); // count total row of sql request
    $listAllMedias = Media::showMediaByType($start, $limit, $typeMedia);
}

$paginations = ceil($totalMedia / $limit); // take number of pages 
if($pagination > $paginations)
{
    header('location: ?nb=1');
    exit();
  
}

$previous = $pagination - 1; 
$next = $pagination + 1;

if(isset($_POST['delete']))
{
    if(isset($_POST['csrf']) && hash_equals($_SESSION['token'], $_POST['csrf']))
    {
        if(isset($_POST['id']) && filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT))
        {
            $id = str_secure($_POST['id']);
            Media::delMedia($id);
            unset($_SESSION['token']);
        }
    } else
    {
        header('location: ?invalidtoken=1');
        unset($_SESSION['token']);
        exit();
    }
}