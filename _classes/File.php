<?php
class File{

    private $file_id;
    private $media_id;
    private $file_chemin;
    private $file_show;
    private $date_created;


    public function __set($attribute, $value)
    {
        switch($attribute)
        {
            case 'file_id' : return $this->file_id = $value; break;
            case 'media_id' : return $this->media_id = $value; break;
            case 'file_chemin' : return $this->file_chemin = $value; break;
            case 'file_show' : return $this->file_show = $value; break;
            case 'date_created' : return $this->date_created = $value; break;
           
           
        }
    }


    public function __get($attribute)
    {
        switch($attribute)
        {
            case 'file_id' : return $this->file_id; break;
            case 'media_id' : return $this->media_id; break;
            case 'file_chemin' : return $this->file_chemin; break;
            case 'file_show' : return $this->file_show; break;
            case 'date_created' : return $this->date_created; break;
        }
    }


    /**
     * Show all user of the table Utilisateur get from sql database with LIMIT
     * @param $start (nb of row when start in sql) (INT)
     * @param $limit (nb of row limit from sql) (INT)
     * @param $searchMediaName (STR) - Optional using for search
     * @return PDO statement (array)
     */
    static function showAllFiles($start , $limit, $searchFileName = null)
    {
        $db = DB::getConnect();
        $reg = 'SELECT image_id as file_id, chemin as file_chemin, media_id as media_id, show_image as file_show, date_created as date_created
        FROM images 
        WHERE chemin LIKE :searchName
        GROUP BY image_id
        ORDER BY image_id LIMIT :start, :limit';
        $st = $db->prepare($reg);
        $st->bindValue(':start', $start, PDO::PARAM_INT);
        $st->bindValue(':limit', $limit, PDO::PARAM_INT);
        $st->bindValue(':searchName', '%'.$searchFileName.'%', PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_CLASS, 'File');
        return $result;
    }


     /**
     * Show all user of the table Utilisateur get from sql database with LIMIT
     * @param $start (nb of row when start in sql) (INT)
     * @param $limit (nb of row limit from sql) (INT)
     * @param $searchMediaName (STR) - Optional using for search
     * @return PDO statement (array)
     */
    static function showAllFilesGalery()
    {
        $db = DB::getConnect();
        $reg = 'SELECT DISTINCT chemin as file_chemin, image_id as file_id, media_id as media_id, show_image as file_show, date_created as date_created
        FROM images';
        $st = $db->prepare($reg);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_CLASS, 'File');
        return $result;
    }



    function store() {

        try {
            $db = DB::getConnect();
            $reg = 'INSERT into images (chemin, show_image) VALUES (:chemin, :show_image)';
            $st = $db->prepare($reg);
            $st->bindValue(':chemin', $this->file_chemin, PDO::PARAM_STR);
            $st->bindValue('show_image', $this->file_show, PDO::PARAM_INT);
            $st->execute();
            
        } catch (PDOException $e) {
            header('location: ?error=1');
            exit();
            // echo 'Error: '.$e->getMessage();
        }
        
    }

    function storeWithMedia() {

        try {
            $db = DB::getConnect();
            $reg = 'INSERT into images (chemin, show_image, media_id) VALUES (:chemin, :show_image , :media_id)';
            $st = $db->prepare($reg);
            $st->bindValue(':chemin', $this->file_chemin, PDO::PARAM_STR);
            $st->bindValue('show_image', $this->file_show, PDO::PARAM_INT);
            $st->bindValue(':media_id', $this->media_id, PDO::PARAM_INT);
            $st->execute();
            
        } catch (PDOException $e) {
            header('location: ?error=1');
            exit();
            // echo 'Error: '.$e->getMessage();
        }
        
    }

    static function destroy($id) {

        try {
            $db = DB::getConnect();
            $reg = 'DELETE from images WHERE image_id = :image_id';
            $st = $db->prepare($reg);
            $st->bindValue(':image_id', $id, PDO::PARAM_INT);
            $st->execute();
            header('location: ?success=1');
            exit();
        } catch (PDOException $e) {
            header('location: ?error=1');
            exit();
        }
        

    }

    function update($chemin, $id) {
        try {
            $db = DB::getConnect();
            $reg = 'UPDATE images SET media_Id = :id , show_image = 1 WHERE chemin = :chemin';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->bindValue(':chemin', $chemin, PDO::PARAM_STR);
            $st->execute();       
        } catch (PDOException $e) {
            header('location: ?error=1');
            exit();
        }
    }

    function setNull($id) {
        try {
            $db = DB::getConnect();
            $reg = 'UPDATE images SET media_Id = NULL , show_image = 0 WHERE media_Id = :id AND show_image = 1';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->execute();       
        } catch (PDOException $e) {
            header('location: ?error=1');
            exit();
        }
    }

    


}