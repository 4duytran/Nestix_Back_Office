<?php

/**
 * Get the name and id of media genre from database
 * @return List of the table media genre from Database
 */
function getGenreList()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT genre_Id as genreId, genre_Nom as genreName FROM genre';
        $st = $db->prepare($reg);
        $st->execute();
        $result = $st->fetchAll();
        return $result;
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}


/**
 * Get the name and id of media Saga from database
 * @return List of the table media Saga from Database
 */
function getSagaList()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT saga_Id as sagaId, saga_Nom as sagaName FROM saga';
        $st = $db->prepare($reg);
        $st->execute();
        $result = $st->fetchAll();
        return $result;
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}


/**
 * Get the name and id of media Type from database
 * @return List of the table media Type from Database
 */
function getTypeList()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT typeMedia_Id as typeId, typeMedia_Nom as typeName FROM type_media';
        $st = $db->prepare($reg);
        $st->execute();
        $result = $st->fetchAll();
        return $result;
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}


/**
 * The function will check if one media is already existed in our database
 * @param $name (STR)
 * @param $year (INT)
 * @param $type (INT)
 * @return Boolean
 */
function checkMediaDouble($id, $name, $year, $type) :bool
{
    $reponse = false;
    $db = DB::getConnect();
    $reg= 'SELECT COUNT(media_Id) as total FROM media WHERE media_Titre = :mediaName AND typeMedia_Id = :mediaType AND media_AnneeSortie = :mediaYear AND media_Id <> :mediaId';
    $st= $db->prepare($reg);
    $st->bindValue('mediaName', $name, PDO::PARAM_STR);
    $st->bindValue(':mediaYear',$year, PDO::PARAM_INT);
    $st->bindValue(':mediaType',$type, PDO::PARAM_INT);
    $st->bindValue(':mediaId',$id, PDO::PARAM_INT);
    $st->execute();
    $result = $st->fetch();
    $reponse = ($result['total'] >= 1 ) ? true : false;
    return $reponse;
}

/**
 * The function get all media genreID from database with ID
 * @param $id (INT)
 * @return PDO statement (STR)
 */
// function getMediaGenreIdById($id)
// {
//     $db = DB::getConnect();
//     $reg = 'SELECT concat_ws(\',\',GROUP_CONCAT(genre.genre_Id)) as genre FROM media_genre INNER JOIN genre ON media_genre.genre_Id = genre.genre_Id WHERE media_genre.media_Id = :mediaId';
//     $st= $db->prepare($reg);
//     $st->bindValue(':mediaId', $id, PDO::PARAM_INT);
//     $st->execute();
//     $result = $st->fetch();
//     return $result['genre'];
// }

/**
 * Check number of email by email passed
 * @param $email (String)
 * @param $id (int)
 * @return number total 0 or 1 (bool)
 */
function countFile($chemin, $id)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(image_id) as nb FROM images WHERE chemin = :chemin AND media_id <> :id';
        $st = $db->prepare($reg);
        $st->bindValue(':chemin', $chemin, PDO::PARAM_STR);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetch();
        return $result['nb'];
    }
    catch (PDOException $e) 
        {
            header('location: ?error=1');
            exit();
            // echo 'Rolbacked , Error: '.$e->getMessage(); 
        }
}