<?php
/**
 * Count total Medias from sql
 * @return sql request number total of Medias (int)
 */
function countAllMedia($searchMediaName = null)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(media_Id) as total FROM media WHERE valid = 1 AND media_Titre LIKE :searchname';
        $st = $db->prepare($reg);
        $st->bindValue(':searchname', '%'.$searchMediaName.'%', PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetch();
        return $result['total'];
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}


/**
 * Count total Medias from sql when using Search
 * @return sql request number total of Medias (int)
 */
// function countSearchMedia($mediaName)
// {
//     try
//     {
//         $db = DB::getConnect();
//         $reg = 'SELECT COUNT(media_Id) as total FROM media WHERE media_Titre LIKE :searchname';
//         $st = $db->prepare($reg);
//         $st->bindValue(':searchname', '%'.$mediaName.'%', PDO::PARAM_STR);
//         $st->execute();
//         $result = $st->fetch();
//         return $result['total'];
//     }
//     catch (PDOException $e) 
//         {
//             // header('location: ?error=1');
//             // exit();
//             echo 'Error: '.$e->getMessage(); 
//         }
// }

/**
 * Search media with name passe in parametter
 * @param $mediaName (String)
 * @return array
 */
function searchMedia($mediaName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT DISTINCT media_Titre as title FROM media WHERE valid = 1 AND media_Titre LIKE :searchname LIMIT 10;';
        $st = $db->prepare($reg);
        $st->bindValue(':searchname', '%'.$mediaName.'%', PDO::PARAM_STR);
        $st->execute();
        $array = array(); 
        while($donnee = $st->fetch()) // on effectue une boucle pour obtenir les données
        {
            array_push($array, array(
                'label' => $donnee['title']
            )); 
        }
        return $array;
       
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }

}