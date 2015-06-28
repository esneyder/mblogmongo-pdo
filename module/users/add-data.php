<?php
 
include_once '../../connection/dbconfig.php';
if(isset($_POST['btn-save']))
{

  // archivo temporal (ruta y nombre).
$tmp_name = $_FILES['archivo']['tmp_name'];
// Obtenemos los datos de la imagen tamaño, tipo y nombre
$tamano = $_FILES['archivo']['size'];
$tipo = $_FILES['archivo']['type'];
$nombre = $_FILES['archivo']['name'];
//ruta completa
$archivo_temporal = $_FILES['archivo']['tmp_name'];
//leer el archivo(imagen) temporal en binario
$fp = fopen($archivo_temporal, 'r+b');
$data = fread($fp, filesize($archivo_temporal));
ob_end_clean();
ob_start();
//mostramos la imagen en nuestro explorador para comprobar que se ha cargado correctamente
 echo $data;


/* en nuestro caso subiremos imágenes jpeg, pero si queremos incluir tipos diferentes deberíamos usar la variable $tipo definida anteriormente y sustituirla por image/jpeg que aparece en la línea de abajo */
header('Content-Type: image/jpeg');
header("Content-Disposition: inline; filename='imagen.jpg'");
header('Expires: 0');
header('Pragma: cache');
header('Cache-Control: private');
ob_end_flush ();
//escapar los caracteres
$data = mysql_escape_string($data);
fclose($fp);
	$nombre = $_POST['nombre'];
	$perfil = $_POST['perfil'];
	$email = $_POST['email'];
  $password = $_POST['password'];
  $tipo = $_POST['tipo'];
  $region = $_POST['region'];
  $estado = $_POST['estado'];
	 
	
	if($crud->create($nombre,$perfil,$email,$password,
    $tipo,$region,$estado,$data))
	{
		header("Location: add-data.php?inserted");
	}
	else
	{
		header("Location: add-data.php?failure");
	}
}
?>
<?php include_once '../../header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>Super!</strong> Usuario ingresado correctamente <a href="index.php">Inicio</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> Ha ocurrido un error !
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	<form enctype="multipart/form-data"  class="pure-form pure-form-stacked" method="POST">
    <fieldset>
        <legend>Registro usuario</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="first-name">Nombre</label>
                <input name="nombre" class="pure-u-23-24" type="text">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="last-name">Perfil</label>
                <input name="perfil" class="pure-u-23-24" type="text">
            </div>
            

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input name ="email" class="pure-u-23-24" type="email" required>
            </div>
            
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="last-name">Password</label>
                <input name="password" class="pure-u-23-24" type="password">
            </div>
            
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="state">Tipo</label>
                <select name="tipo" class="pure-input-1-2">
                     <?php 
                      $query = "SELECT * FROM tipo"; 
                      $crud->selectTipo($query);
                      ?>
                </select>
            </div>

             

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="state">Region</label>
                <select name="region" class="pure-input-1-2">
                     <?php 
                      $query = "SELECT * FROM region"; 
                      $crud->selectRegioneS($query);
                      ?>
                </select>
            </div>
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="state">Estado</label>
                <select name="estado" class="pure-input-1-2">
                      <?php 
                      $query = "SELECT * FROM estado"; 
                      $crud->selectEstado($query);
                      ?>
                </select>
            </div> 
        </div> 
        <button type="submit" name="btn-save" id="btn-save" class="pure-button pure-button-primary">Guardar Usuario</button>
      <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Volver a index</a>
            
    </fieldset>
</form>
     
     
</div>

<?php include_once '../../footer.php'; ?>