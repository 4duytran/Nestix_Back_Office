<?php
/**
 * Count total users from sql
 * @return sql request number total of user (int)
 */
function countAllUser()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(utilisateur_Id) as total FROM utilisateur INNER JOIN personne ON personne_Id = utilisateur_Id';
        $st = $db->prepare($reg);
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

function countAllUserSearch($searchUserName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(utilisateur_Id) as total FROM utilisateur INNER JOIN personne ON personne_Id = utilisateur_Id WHERE :searchName LIKE Concat(Concat(\'%\',personne_Nom),\'%\') OR :searchName LIKE Concat(Concat(\'%\',personne_Prenom),\'%\')';
        $st = $db->prepare($reg);
        $st->bindValue(':searchName', $searchUserName, PDO::PARAM_STR);
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
 * Search media with name passe in parametter
 * @param $mediaName (String)
 * @return array
 */
function searchUser($userName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT CONCAT_WS(\' \',personne_Nom , personne_Prenom) as username FROM personne INNER JOIN utilisateur ON utilisateur_Id = personne_Id WHERE personne_Nom LIKE :searchname OR personne_Prenom LIKE :searchname LIMIT 10;';
        $st = $db->prepare($reg);
        $st->bindValue(':searchname', '%'.$userName.'%', PDO::PARAM_STR);
        $st->execute();
        $array = array(); 
        while($donnee = $st->fetch()) // on effectue une boucle pour obtenir les données
        {
            array_push($array, array(
                'label' => $donnee['username']
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