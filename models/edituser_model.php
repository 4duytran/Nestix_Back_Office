<?php

/**
 * Get the name and id of level from database
 * @return List of the table level from Database
 */
function getRankList()
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT level_Id as rank_id, level_Nom as rank FROM level';
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
 * Check number of email by id and email passed
 * @param $email (String)
 * @param $id (int)
 * @return number total 0 or 1 (bool)
 */
function countUserEmail($id, $email)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(utilisateur_Id) as nb FROM utilisateur WHERE utilisateur_EMail = :email AND utilisateur_Id <> :id';
        $st = $db->prepare($reg);
        $st->bindValue(':email', $email, PDO::PARAM_STR);
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