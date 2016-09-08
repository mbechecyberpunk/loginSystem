<?php

class Category
{
  private $db;

  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }

  public function create($name,$descr)
  {
    try{
    $stmt = $this->db->prepare("INSERT INTO categories(name,descr)
                                                VALUES(:name, :descr)");

    $stmt->bindparam(":name", $name);
    $stmt->bindparam(":descr", $descr);
    $stmt->execute();

    return $stmt;
  }
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }
  }

}
