<?php

function searchMedia($mediaName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT media_Titre as title FROM media WHERE media_Titre LIKE :searchname LIMIT 10;';
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

function searchUser($userName)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT CONCAT(personne_Nom , personne_Prenom)  FROM personne WHERE personne_Nom LIKE :searchname OR personne_Prenom LIKE :searchname LIMIT 10;';
        $st = $db->prepare($reg);
        $st->bindValue(':searchname', '%'.$userName.'%', PDO::PARAM_STR);
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