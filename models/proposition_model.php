<?php

/**
 * Count total Medias in waitting valid from sql
 * @return sql request number total of Medias (int)
 */
function countAllMediaProposition($searchMediaName = null)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(m.media_Id) as total FROM media m  LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        LEFT JOIN media_genre ON media_genre.media_Id = m.media_Id
        INNER JOIN proposition p ON p.media_Id = m.media_Id
        LEFT JOIN utilisateur u ON u.utilisateur_Id = p.user_Id
        LEFT JOIN personne per ON per.personne_Id = u.utilisateur_Id
        WHERE valid = 0 AND media_Titre LIKE :searchname';
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

function searchMediaProposition($mediaName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT DISTINCT m.media_Titre as title FROM media m 
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        INNER JOIN proposition p ON p.media_Id = m.media_Id
        LEFT JOIN utilisateur u ON u.utilisateur_Id = p.user_Id
        LEFT JOIN personne per ON per.personne_Id = u.utilisateur_Id
        WHERE valid = 0 AND media_Titre LIKE :searchname LIMIT 10';
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

/**
 * Show all user of the table Utilisateur get from sql database with LIMIT
 * @param $start (nb of row when start in sql) (INT)
 * @param $limit (nb of row limit from sql) (INT)
 * @param $searchMediaName (STR) - Optional using for search
 * @return PDO statement (array)
 */
function showAllMediaProposition($start , $limit, $searchMediaName = null)
{
    try 
    {
        $db = DB::getConnect();
        $reg = 'SELECT m.media_Id as m_id, m.media_Titre as m_name, m.media_AnneeSortie as m_year , m.valid, t.typeMedia_Nom as m_type, CONCAT(per.personne_Nom, \'  \', per.personne_Prenom ) as user_name ,per.personne_Id as user_id
        FROM media m 
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        INNER JOIN proposition p ON p.media_Id = m.media_Id
        LEFT JOIN utilisateur u ON u.utilisateur_Id = p.user_Id
        LEFT JOIN personne per ON per.personne_Id = u.utilisateur_Id
        WHERE m.valid = 0 AND m.media_Titre LIKE :searchname
        ORDER BY m.media_Id LIMIT :start, :limit' ;
        $st = $db->prepare($reg);
        $st->bindValue(':start', $start, PDO::PARAM_INT);
        $st->bindValue(':limit', $limit, PDO::PARAM_INT);
        $st->bindValue(':searchname', '%'.$searchMediaName.'%', PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetchAll();
        return $result;

    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
    
}