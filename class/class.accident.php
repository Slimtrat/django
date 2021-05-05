<?php

class ACCIDENT
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function add($position,$moment,$idOperateur,$idKart,$description)
    {
       try
       {
           $stmt = $this->db->prepare("INSERT INTO accident(position,moment,idoperateur,idkart,description) 
                                                       VALUES(:uposition, :umoment,:uidoperateur,:uidkart,:udescription)");
              
           $stmt->bindparam(":uposition", $position);
            $stmt->bindparam(":umoment", $moment);      
            $stmt->bindparam(":uidoperateur", $idOperateur);
            $stmt->bindparam(":uidkart", $idKart);   
            $stmt->bindparam(":udescription", $description);   
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function showKart($idKart)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident WHERE idkart=:uidkart");
       $stmt->execute(array(':uidkart'=>$idKart));
       return $stmt->fetchAll();
    }

    public function showByLieu($ascOrDesc)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident ORDER BY position $ascOrDesc");
       $stmt-> execute();
       return $stmt->fetchAll();
    }

    public function showByKart($ascOrDesc)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident ORDER BY idkart $ascOrDesc");
       $stmt-> execute();
       return $stmt->fetchAll();
       
    }
    public function showByOpe($ascOrDesc)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident ORDER BY idoperateur $ascOrDesc");
       $stmt-> execute();
       return $stmt->fetchAll();
    }
    public function showByDate($ascOrDesc)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident ORDER BY moment $ascOrDesc");
       $stmt-> execute();
       return $stmt->fetchAll();
    }
    public function showById($ascOrDesc)
    {
       $stmt = $this->db->prepare("SELECT * FROM accident ORDER BY idaccident $ascOrDesc");
       $stmt-> execute();
       return $stmt->fetchAll();
    }
    public function show()
    {
       $stmt = $this->db->prepare("SELECT * FROM accident");
       $stmt-> execute();
        return $stmt->fetchAll();
    }
}
?>