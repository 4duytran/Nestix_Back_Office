<?php
/**
 * Count total Files from sql
 * @return sql request number total of File (int)
 */
function countAllFile($searchFileName = null)
{
    try
    {
        $db = DB::getConnect();
        $reg = 'SELECT COUNT(image_id) as total FROM images WHERE chemin LIKE :searchname';
        $st = $db->prepare($reg);
        $st->bindValue(':searchname', '%'.$searchFileName.'%', PDO::PARAM_STR);
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

