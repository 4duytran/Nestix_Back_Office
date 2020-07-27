<?php
/**
 * Get the last 5 registered users
 * @return PDO Statement
 */
function getLastUser()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT personne_Nom as firstname, personne_Prenom as lastname, u.utilisateur_EMail as email , u.utilisateur_DateCreation as creation FROM personne p INNER JOIN utilisateur u ON u.utilisateur_Id = p.personne_Id 
        order by p.personne_Id DESC LIMIT 5 ';
        $st = $db->prepare($reg);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}

/**
 * Get the last 5 medias 
 * @return PDO Statement
 */
function getLastMedia()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT m.media_Id, media_Titre as media_title, media_AnneeSortie as media_year, concat_ws(\',\',GROUP_CONCAT(genre.genre_Nom)) as media_genre ,t.typeMedia_Nom as media_type 
        FROM media m 
        INNER JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        INNER JOIN media_genre ON media_genre.media_Id = m.media_Id
        INNER JOIN genre ON genre.genre_Id = media_genre.genre_Id
        GROUP BY m.media_Id
        ORDER BY m.media_Id
        DESC LIMIT 5';
        $st = $db->prepare($reg);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
}

/**
 * Get top 5 of media with rate
 */
function getTopMedia() {
    try {
        $db = DB::getConnect();
        $reg = 'SELECT  m.media_Titre as media_title, m.media_AnneeSortie as media_year, concat_ws(\', \',GROUP_CONCAT(genre.genre_Nom)) as media_genre ,t.typeMedia_Nom as media_type, AVG(r.rate) as review from media m 
        LEFT JOIN rating r ON r.media_id = m.media_Id
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        INNER JOIN media_genre ON media_genre.media_Id = m.media_Id
        LEFT JOIN genre ON genre.genre_Id = media_genre.genre_Id
        GROUP BY m.media_Titre, m.media_AnneeSortie, t.typeMedia_Nom
        ORDER BY AVG(r.rate) DESC LIMIT 5 ';
        $st = $db->prepare($reg);
        $st->execute();
        return $st->fetchAll();

    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage(); 
    }
}

/**
 * Get top 5 of active user with number of comment
 */
function getActiveUser() {
    try {
        $db = DB::getConnect();
        $reg = 'SELECT CONCAT(p.personne_Nom, \' \',p.personne_Prenom) as name, u.utilisateur_EMail as email, COUNT(r.comment) as comment FROM rating r
        INNER JOIN utilisateur u ON u.utilisateur_Id = r.user_id
        INNER JOIN personne p ON p.personne_Id = u.utilisateur_Id
        GROUP BY name, email
        ORDER BY comment DESC LIMIT 8 ';
        $st = $db->prepare($reg);
        $st->execute();
        return $st->fetchAll();

    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage(); 
    }
}

