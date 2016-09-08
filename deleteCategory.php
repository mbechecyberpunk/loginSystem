<?php
require 'dbconfig.php';
$id=$_GET['id'];

try {
$DB_con  = new PDO("mysql:host=$DB_host ;dbname=dblogin",$DB_user,$DB_pass);


$count=$DB_con ->prepare("DELETE FROM categories WHERE id=:id");
$count->bindParam(":id",$id,PDO::PARAM_INT);
$count->execute();

if ($count) {
echo "<script type= 'text/javascript'>window.location = 'home.php'</script>";
}
else{
echo "<script type= 'text/javascript'>alert('sorry email id already taken ')";
}

$DB_con  = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}


 ?>
