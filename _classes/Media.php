<?php

class Media{
    private $m_id;
    private $m_name;
    private $m_year;
    private $m_genre;
    private $m_type;
    private $m_isbn;
    private $m_saga;
    private $m_valid;
    private $m_poster;
    

    public function __set($attribute, $value)
    {
        switch($attribute)
        {
            case 'm_id' : return $this->m_id = $value; break;
            case 'm_name' : return $this->m_name = $value; break;
            case 'm_year' : return $this->m_year = $value; break;
            case 'm_genre' : return $this->m_genre = $value; break;
            case 'm_type' : return $this->m_type = $value; break;
            case 'm_isbn' : return $this->m_isbn = $value; break;
            case 'm_saga' : return $this->m_saga = $value; break;
            case 'm_valid' : return $this->m_valid = $value; break;
            case 'm_poster' : return $this->m_poster = $value; break;
            
        }
    }
    public function __get($attribute)
    {
        switch($attribute)
        {
            case 'm_id' : return $this->m_id; break;
            case 'm_name' : return $this->m_name; break;
            case 'm_year' : return $this->m_year; break;
            case 'm_genre' : return $this->m_genre; break;
            case 'm_type' : return $this->m_type; break;
            case 'm_isbn' : return $this->m_isbn; break;
            case 'm_saga' : return $this->m_saga; break;
            case 'm_valid' : return $this->m_valid; break;
            case 'm_poster' : return $this->m_poster; break;
           
        }
    }

    /**
     * Show all user of the table Utilisateur get from sql database with LIMIT
     * @param $start (nb of row when start in sql) (INT)
     * @param $limit (nb of row limit from sql) (INT)
     * @param $searchMediaName (STR) - Optional using for search
     * @return PDO statement (array)
     */
    static function showAllMedia($start , $limit, $searchMediaName = null)
    {
        $db = DB::getConnect(); // get connect to mysql
        $reg = 'SELECT m.media_Id as m_id, media_Titre as m_name, media_AnneeSortie as m_year, concat_ws(\',\',GROUP_CONCAT(genre.genre_Nom)) as m_genre ,t.typeMedia_Nom as m_type, m.livre_ISBN as m_isbn, saga.saga_Nom as m_saga, i.chemin as m_poster
        FROM media m 
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        LEFT JOIN media_genre ON media_genre.media_Id = m.media_Id
        LEFT JOIN genre ON genre.genre_Id = media_genre.genre_Id
        LEFT JOIN saga ON saga.saga_Id = m.saga_Id
        LEFT JOIN images i ON i.media_Id = m.media_Id
        WHERE valid = 1 AND media_Titre LIKE :searchName
        GROUP BY m.media_Id, i.chemin
        ORDER BY m.media_Id LIMIT :start, :limit';  // Requete SQL with limit
        $st = $db->prepare($reg); // Prepare parametter
        $st->bindValue(':start', $start, PDO::PARAM_INT);
        $st->bindValue(':limit', $limit, PDO::PARAM_INT);
        $st->bindValue(':searchName', '%'.$searchMediaName.'%', PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_CLASS, 'Media'); // Result with PDO Fetch Class
        return $result;
    }


    
    /**
     * The function show media by type of media in param with limit in sql select
     * @param $start (INT)
     * @param $limit (INT)
     * @param $type (STR)
     * @param $searchMediaName (STR) - Optional using for search
     * @return PDO statement , show all medias by type or using search
     */
    static function showMediaByType($start , $limit, $type, $searchMediaName = null)
    {
        $db = DB::getConnect();
        $reg = 'SELECT m.media_Id as m_id, media_Titre as m_name, media_AnneeSortie as m_year, concat_ws(\',\',GROUP_CONCAT(genre.genre_Nom)) as m_genre ,t.typeMedia_Nom as m_type , i.chemin as m_poster
        FROM media m 
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        LEFT JOIN media_genre ON media_genre.media_Id = m.media_Id
        LEFT JOIN genre ON genre.genre_Id = media_genre.genre_Id
        LEFT JOIN images i ON i.media_Id = m.media_Id
        WHERE valid = 1 AND media_Titre LIKE :searchName AND t.typeMedia_Nom = :typeMedia
        GROUP BY m.media_Id, i.chemin
        ORDER BY m.media_Id LIMIT :start, :limit';
        $st = $db->prepare($reg);
        $st->bindValue(':start', $start, PDO::PARAM_INT);
        $st->bindValue(':limit', $limit, PDO::PARAM_INT);
        $st->bindValue(':typeMedia', $type, PDO::PARAM_STR);
        $st->bindValue(':searchName', '%'.$searchMediaName.'%', PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_CLASS, 'Media');
        return $result;
    }

    /**
     * The function call when delete one media by id
     * @param $id (INT)
     * @return PDO statement
     */
    static function delMedia($id)
    {
        try
        {
            $db = DB::getConnect();
            $reg = 'DELETE FROM media WHERE media_Id = :id';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->execute();
            header('location: ?success=1');
            exit();
        }
        catch (PDOException $e) 
        {
            header('location: ?error=1');
            exit();
            // echo 'Rolbacked , Error: '.$e->getMessage(); 
        }  
    }

    /**
     * The function get media by ID
     * @param $id (INT)
     * @return PDO statement (Show media)
     */
    function getMediaById($id)
    {
        $db = DB::getConnect();
        $reg = 'SELECT m.media_Id as m_id, m.media_Titre as m_name, m.media_AnneeSortie as m_year, m.valid as m_valid, concat_ws(\',\',GROUP_CONCAT(genre.genre_Nom)) as m_genre ,t.typeMedia_Nom as m_type, m.livre_ISBN as m_isbn, saga.saga_Nom as m_saga
        FROM media m 
        LEFT JOIN type_media t ON t.typeMedia_Id = m.typeMedia_Id
        LEFT JOIN media_genre ON media_genre.media_Id = m.media_Id
        LEFT JOIN genre ON genre.genre_Id = media_genre.genre_Id
        LEFT JOIN saga ON saga.saga_Id = m.saga_Id
        WHERE m.media_Id = :id';
        $st = $db->prepare($reg);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->setFetchMode(PDO::FETCH_CLASS, 'Media');
        $st->execute();
        $result = $st->fetch();
        return $result;
    }

    /**
     * The function will execute when edit the media
     */

    function updateMedia()
    {
        try
        {
            $db = DB::getConnect();
            $db->beginTransaction();
            $reg = 'UPDATE media SET media_Titre = :mediaName , media_AnneeSortie = :mediaYear , livre_ISBN = :mediaIsbn, saga_Id = :mediaSaga, typeMedia_Id = :mediaType , valid = :valid WHERE media_Id = :mediaId';
            $st= $db->prepare($reg);
            $st->bindValue('mediaName', $this->m_name, PDO::PARAM_STR);
            $st->bindValue(':mediaYear',$this->m_year, PDO::PARAM_INT);
            $st->bindValue(':mediaIsbn', $this->m_isbn, PDO::PARAM_INT);
            $st->bindValue(':mediaSaga', $this->m_saga, PDO::PARAM_INT);
            $st->bindValue(':mediaType',$this->m_type, PDO::PARAM_INT);
            $st->bindValue(':valid',$this->m_valid, PDO::PARAM_INT);
            $st->bindValue(':mediaId',$this->m_id, PDO::PARAM_INT);
            $st->execute();

            $reg = 'DELETE FROM media_genre WHERE media_Id = :mediaId';
            $st= $db->prepare($reg);
            $st->bindValue(':mediaId',$this->m_id, PDO::PARAM_INT);
            $st->execute();

            if(!empty($this->m_genre))
            {
                foreach($this->m_genre as $genre)
                {
                    $reg = 'INSERT INTO media_genre (media_Id, genre_Id) VALUES (:mediaId, :mediaGenre)';
                    $st=$db->prepare($reg);
                    $st->bindValue(':mediaId',$this->m_id, PDO::PARAM_INT);
                    $st->bindValue(':mediaGenre', $genre, PDO::PARAM_INT);
                    $st->execute();
                }
            }

            $db->commit();
            redirectHeaderURI();
        }
        catch(PDOException $e)
        {
            if (isset($db))
            {
                $db->rollback();
                header('location: ?error=1');
                exit();
                // echo 'Rolbacked , Error: '.$e->getMessage(); 
            }
        }

    }

}