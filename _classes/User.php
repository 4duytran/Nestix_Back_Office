<?php

class User{

    private $u_id;
    private $u_firstname;
    private $u_lastname;
    private $u_dob;
    private $u_email;
    private $u_password;
    private $u_rank;
    private $u_rank_id;
    private $u_date_registered;
    private $u_banned;

    // Set attribut with the same name of SQL table
    public function __set($attribute, $value)
    {
        switch($attribute)
        {
            case 'u_id' : return $this->u_id = $value; break;
            case 'u_firstname' : return $this->u_firstname = $value; break;
            case 'u_lastname' : return $this->u_lastname = $value; break;
            case 'u_email' : return $this->u_email = $value; break;
            case 'u_password' : return $this->u_password = $value; break;
            case 'u_rank' : return $this->u_rank = $value; break;
            case 'u_rank_id' : return $this->u_rank_id = $value; break;
            case 'u_banned' : return $this->u_banned = $value; break;
        }
    }

    // Get attribute with the same name of SQL table
    public function __get($attribute)
    {
        switch($attribute)
        {
            case 'u_id' : return $this->u_id; break;
            case 'u_firstname' : return $this->u_firstname; break;
            case 'u_lastname' : return $this->u_lastname; break;
            case 'u_email' : return $this->u_email; break;
            case 'u_password' : return $this->u_password; break;
            case 'u_rank' : return $this->u_rank; break;
            case 'u_rank_id' : return $this->u_rank_id; break;
            case 'u_date_registered' : return $this->u_date_registered; break;
            case 'u_banned' : return $this->u_banned; break;
        }
    }


    /**
     * Show all user of the table Utilisateur get from sql database with LIMIT
     * @param $start (nb of row when start in sql)
     * @param $limit (nb of row limit from sql)
     * @return PDO statement (array)
     */
    static function showAllUser($start , $limit)
    {
        $db = DB::getConnect();
        $reg = 'SELECT personne_Id as u_id, personne_Nom as u_firstname, personne_Prenom as u_lastname,u.utilisateur_Bloque as u_banned, u.utilisateur_EMail as u_email , u.utilisateur_Password as password, u.utilisateur_DateCreation as u_date_registered , l.level_Nom as u_rank , l.level_Id as u_rank_id FROM personne p INNER JOIN utilisateur u ON u.utilisateur_Id = p.personne_Id INNER JOIN `level` l ON l.level_Id = u.level_Id LIMIT :start, :limit';
        $st = $db->prepare($reg);
        $st->bindValue(':start', $start, PDO::PARAM_INT);
        $st->bindValue(':limit', $limit, PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_CLASS, 'User');
        return $result;
    }

    /**
     * Show all user of the table Utilisateur get from sql database with LIMIT when using search method
     * @param $start (nb of row when start in sql)
     * @param $limit (nb of row limit from sql)
     * @return PDO statement (array)
     */

    static function showAllSearchUser($start , $limit, $searchUserName)
    {
        try
        {
            // $pieces = explode(' ', $searchUserName);
            // $firstName = @$pieces[0];
            // $lastName = @$pieces[1];
            $db = DB::getConnect();
            // $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,true); 
            $reg = 'SELECT personne_Id as u_id, personne_Nom as u_firstname, personne_Prenom as u_lastname,u.utilisateur_Bloque as u_banned, u.utilisateur_EMail as u_email , u.utilisateur_Password as password, u.utilisateur_DateCreation as u_date_registered , l.level_Nom as u_rank , l.level_Id as u_rank_id FROM personne p INNER JOIN utilisateur u ON u.utilisateur_Id = p.personne_Id INNER JOIN `level` l ON l.level_Id = u.level_Id WHERE :searchName LIKE Concat(Concat(\'%\',personne_Nom),\'%\') OR :searchName LIKE Concat(Concat(\'%\',personne_Prenom),\'%\') LIMIT :start, :limit';
            $st = $db->prepare($reg);
            $st->bindValue(':start', $start, PDO::PARAM_INT);
            $st->bindValue(':limit', $limit, PDO::PARAM_INT);
            $st->bindValue(':searchName', $searchUserName, PDO::PARAM_STR);
            // $st->bindValue(':searchLastName', '%'.$lastName.'%', PDO::PARAM_STR);
            $st->execute();
            $result = $st->fetchAll(PDO::FETCH_CLASS, 'User');
            return $result;
        }
        catch (PDOException $e) 
        {
            $e->getMessage(); 
        }  
    }

    /**
     * Delete user selected
     * @return PDO statement
     */
    static function delUser($id)
    {
        try
        {
            $db = DB::getConnect();
            $db->beginTransaction();
            $reg = 'DELETE FROM utilisateur WHERE utilisateur_Id = :id';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->execute();

            $reg = 'DELETE FROM personne WHERE personne_Id = :id';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->execute();
            $db->commit();
            header('location: ?success=1');
            exit();
        }
        catch (PDOException $e) 
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

    /**
     * Get 1 user with id passed in param
     * @param $id (int)
     * @return new object of class User
     */

    function getUserById($id)
    {
        $db = DB::getConnect();
        $reg = 'SELECT personne_Id as u_id, personne_Nom as u_firstname, personne_Prenom as u_lastname, u.utilisateur_EMail as u_email ,u.utilisateur_Bloque as u_banned, u.utilisateur_Password as u_password, l.level_Nom as u_rank, l.level_Id as u_rank_id FROM personne p INNER JOIN utilisateur u ON u.utilisateur_Id = p.personne_Id INNER JOIN `level` l ON l.level_Id = u.level_Id WHERE u.utilisateur_Id = :id';
        $st = $db->prepare($reg);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->setFetchMode(PDO::FETCH_CLASS, 'User');
        $st->execute();
        $user = $st->fetch();
        return $user;
    }

    /**
     * Modification user from SQL table personne and utilisateur with rollback
     * @return void
     */
    function updateUser()
    {
        // We will try to edit the user with multiple action, if get error will cancel by using PHP Rollback
        try
        {

            $db = DB::getConnect();
            $db->beginTransaction();
            // Edit the table personne from SQL first
            $reg = 'UPDATE personne SET personne_Nom = :firstname, personne_Prenom = :lastname WHERE personne_Id = :id'; // Request with prepare statement
            $st = $db->prepare($reg); // Parse in request with param
            $st->bindValue(':firstname', $this->u_firstname, PDO::PARAM_STR);
            $st->bindValue(':lastname', $this->u_lastname, PDO::PARAM_STR);
            $st->bindValue(':id', $this->u_id, PDO::PARAM_INT);
            $st->execute(); // execute this request

            // Edit the table user from SQL
            $reg = 'UPDATE utilisateur SET utilisateur_EMail = :uemail, utilisateur_Password = :upassword , level_Id = :rank_id, utilisateur_Bloque = :blocked WHERE utilisateur_Id = :id';
            $st = $db->prepare($reg);
            $st->bindValue(':uemail', $this->u_email, PDO::PARAM_STR);
            $st->bindValue(':upassword', $this->u_password, PDO::PARAM_STR);
            $st->bindValue(':rank_id', $this->u_rank_id, PDO::PARAM_INT);
            $st->bindValue(':blocked', $this->u_banned, PDO::PARAM_INT);
            $st->bindValue(':id', $this->u_id, PDO::PARAM_INT);
            $st->execute();
            $db->commit();
            redirectHeaderURI();
        }
        catch (PDOException $e) 
        {
            if (isset($db)) // check if the connection is existe
            {
                $db->rollback(); // Cancel all action 
                header('location: ?error=1'); // Redirect with error
                exit();
                // echo 'Rolbacked , Error: '.$e->getMessage(); 
            }
        }  
    }


    function creatUser()
    {
        try
        {
            $db = DB::getConnect();
            $db->beginTransaction();
            $reg = 'INSERT INTO personne(personne_Nom, personne_Prenom, personne_DateNaiss) VALUES (:firstname, :lastname, :datenaiss)';
            $st = $db->prepare($reg);
            $st->bindValue(':firstname', $this->u_firstname, PDO::PARAM_STR);
            $st->bindValue(':lastname', $this->u_lastname, PDO::PARAM_STR);
            $st->bindValue(':datenaiss', $this->u_dob, PDO::PARAM_INT);
            $st->execute();
            $this->u_id = $db->lastInsertId();

            $reg = 'INSERT INTO utilisateur (utilisateur_Id, utilisateur_EMail, utilisateur_Password, level_Id) VALUES (:id, :uemail, :upassword, :rank_id)';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $this->u_id, PDO::PARAM_INT);
            $st->bindValue(':uemail', $this->u_email, PDO::PARAM_STR);
            $st->bindValue(':upassword', $this->u_password, PDO::PARAM_STR);
            $st->bindValue(':rank_id', $this->u_rank_id, PDO::PARAM_INT);
            $st->execute();
            $db->commit();
            header('location: ?success=1');
            exit();
        }
        catch (PDOException $e) 
        {
            if (isset($db))
            {
                $db->rollback();
                header('location: ?error=1');
                exit();
                // echo 'Error: '.$e->getMessage(); 
            }
        }
    }

}