<?php

$DB_host = "sql5.freemysqlhosting.net";
$DB_user = "sql582157";
$DB_pass = "hX3!qP9*";
$DB_name = "sql582157";


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
}elseif (is_file("get-post.php")) {
	 include_once 'get-post.php';
    $post = new post($DB_con);
}

?>