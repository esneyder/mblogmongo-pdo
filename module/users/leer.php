<?php 


 /* Realizamos una consulta sobre nuestra imagen almacenada, para ello usamos el parámetro archivo_id */
$query = 'select archivo, tipo_imagen from usuarios where archivo_id=18';
$stmt = $conn->prepare($query);
$stmt->execute();
//Usamos bindColumn() que se encarga vincular una variable con el resultado de la consulta
/* Usamos el procedimiento PDO::PARAM_LOB, esto sirve para asignarle el tipo a la variable, nosotros usaremos el tipo PARAM_LOB para guardar binarios */
$stmt->bindColumn(1, $data, PDO::PARAM_LOB);
/* FETCH_BOUND: devuelve TRUE y asigna los valores de las columnas definidas anteriormente con bindColumn*/
$stmt->fetch(PDO::FETCH_BOUND);
//le decimos el tipo de la imagen para que se visualice y la mostramos
header('Content-Type: image/jpeg');
echo $data;
 ?>