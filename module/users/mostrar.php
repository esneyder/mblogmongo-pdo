<?php 
include_once '../../connection/dbconfig.php';

$a=$crud->selectBlob(23);
 header('Content-Type: image/jpg');
 echo $a['data'];
 ?>