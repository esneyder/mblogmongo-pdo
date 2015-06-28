<?php

$DB_host = "localhost";
$DB_user = "esneyder";
$DB_pass = "123";
$DB_name = "blog";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
//incluyo los archivos funciones en su respectivo orden
if (is_file("user.crud.php")) { 
include_once 'user.crud.php';
$crud = new crud($DB_con);
}elseif (is_file("post.crud.php")) {
 include_once 'post.crud.php';
 $crud = new crud($DB_con);
}

?>