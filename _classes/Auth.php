<?php
class Auth {

    private const ADMIN_LEVEL = 4;
    /**
     * Get password by email 
     * @param $email
     * @return sql request (in email out user password)
     */
    static function getPassByEmail($email)
    {
        try
        {
            $db = DB::getConnect();
            $reg = 'SELECT utilisateur_Password FROM utilisateur WHERE utilisateur_EMail=:uEmail AND level_id = :level_id';
            $st = $db->prepare($reg);
            $st->bindValue(':uEmail', $email , PDO::PARAM_STR);
            $st->bindValue(':level_id', self::ADMIN_LEVEL , PDO::PARAM_INT);
            $st->execute();
            $getPassword = $st->fetch();
            return $getPassword['utilisateur_Password'];
        }
        catch (PDOException $e) 
        {
            header('location: ?error=1');
            exit();
            // echo 'Rolbacked , Error: '.$e->getMessage(); 
        }
        
    }

    /**
     * Get id user by email
     * @param $email
     * @return sql request (in email out id user)
     */
    static function getIdByEmail($email)
    {
        try
        {
            $db = DB::getConnect();
            $reg = 'SELECT utilisateur_Id FROM utilisateur WHERE utilisateur_EMail=:uEmail';
            $st = $db->prepare($reg);
            $st->bindValue(':uEmail', $email , PDO::PARAM_STR);
            $st->execute();
            $getId = $st->fetch();
            return $getId['utilisateur_Id'];
        }
        catch (PDOException $e) 
        {
            header('location: ?error=1');
            exit();
            // echo 'Rolbacked , Error: '.$e->getMessage(); 
        }
    }

    /**
     * Logout user
     * @return void (delete all session)
     */
    static function logout()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Method log connection
     * Insert into sql the information of admin
     * @param $id
     * @return sql request
     */
    static function dblog($id)
    {
        // Try to insert into sql
        try
        {
            $db = DB::getConnect();
            $reg = 'INSERT INTO admin_log (admin_id) VALUES (:id)';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id, PDO::PARAM_INT);
            $st->execute();
        return $st;
        }
        catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
    }

    /**
     * Get last time in sql log
     * @param $id
     * @return sql request (out time)
     */
    static function getLogTime($id)
    {
        try
        {
            $db = DB::getConnect();
            $reg = 'SELECT log_time FROM admin_log WHERE admin_id = :id ORDER BY log_time DESC LIMIT 1';
            $st = $db->prepare($reg);
            $st->bindValue(':id', $id , PDO::PARAM_INT);
            $st->execute();
            return $st->fetch();
        }
        catch (PDOException $e) 
        {
            // header('location: ?error=1');
            // exit();
            echo 'Error: '.$e->getMessage(); 
        }
    }

}