<?php

class KART
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    //A retravailler lorsqu'il faudra ajouter des valeurs spécifiques sur des karts

    // public function register($uid,$upass)
    // {
    //    try
    //    {
    //        $stmt = $this->db->prepare("INSERT INTO operateur(user,password) 
    //                                                    VALUES(:uname, :upass)");         
    //        $stmt->bindparam(":uname", $uname);
    //     //    $stmt->bindparam(":upass", $new_password)    
    //     $stmt->bindparam(":upass", $upass);       
    //        $stmt->execute(); 
    //        return $stmt; 
    //    }
    //    catch(PDOException $e)
    //    {
    //        echo $e->getMessage();
    //    }    
    // }
 
    public function show()
    {
       $stmt = $this->db->prepare("SELECT * FROM kart");
       $stmt-> execute();
        return $stmt->fetchAll();
    }
}
?>