<?php
 include_once '../../connection/dbconfig.php';
if(isset($_POST['btn-update']))
{   $id = $_GET['edit_id'];
	$nombre = $_POST['nombre'];
    $perfil = $_POST['perfil'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];
    $region = $_POST['region'];
    $estado = $_POST['estado'];
	
	if($crud->update($id,$nombre,$perfil,$email,$password,$tipo,$region,$estado))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Perfectp!</strong> Registro actualizado correctamente.. <a href='index.php'>Inicio</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> Error al actualizar el registro !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getID($id));	
}

?>
<?php include_once '../../header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
      <form class="pure-form pure-form-stacked" method="POST">
    <fieldset>
        <legend>Registro usuario</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="first-name">Nombre</label>
                <input name="nombre" class="pure-u-23-24" type="text" value="<?php echo $nombre;  ?>">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="last-name">Perfil</label>
                <input name="perfil" class="pure-u-23-24" type="text" value=" <?php echo $perfil; ?>">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input name ="email" class="pure-u-23-24" type="email" value="<?php echo $email; ?>" required>
            </div>
            
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="last-name">Password</label>
                <input name="password" class="pure-u-23-24" type="password" required value="<?php echo $password; ?>">
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
        <button type="submit" name="btn-update" class="pure-button pure-button-primary">Guardar Usuario</button>
      <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; volver a index</a>
            
    </fieldset>
</form>
     
     
</div>

<?php include_once '../../footer.php'; ?>