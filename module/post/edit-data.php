<?php
 include_once '../../connection/dbconfig.php';
if(isset($_POST['btn-update']))
{   

  $id = $_GET['edit_id'];
	$titulo = $_POST['titulo'];
  $intro = $_POST['intro'];
  $texto = $_POST['texto'];
  $categoria = $_POST['categoria'];  
  $fecha = date('y-m-d');
  $usuario = 'edesalla17@gmail.com';
	
	if($crud->update($id,$titulo,$intro,$texto,$categoria,$fecha, $usuario))
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
	 
        <form enctype="multipart/form-data" 
   class="pure-form pure-form-aligned" method="POST">
    <fieldset>
        <legend>Crear Post</legend>
         
            <div class="pure-control-group">
                <label for="first-name">Título</label>
                <input name="titulo" class="pure-input-1-2"  
                type="text" required value="<?php echo $titulo;  ?>">
            </div>
            <div class="pure-control-group">
                <label for="last-name">Introducción</label>
                <input name="intro" class="pure-input-1-2"  
                type="text" required value="<?php echo $intro;  ?>">
            </div>
            <div class="pure-control-group">
                <label for="last-name">Descripción</label>
                <textarea name="texto" class="pure-input-1-2" cols="30" rows="5" required >
                <?php echo $texto;  ?>
                </textarea>
                 
            </div>              
            
            <div class="pure-control-group">
                <label for="state">Tipo</label>
                <select name="categoria" class="pure-input-1-2">
                     <?php 
                      $query = "SELECT * FROM categoria"; 
                      $crud->selectCategorias($query);
                      ?>
                </select>
            </div> 

             <div class="pure-controls">
                 <button type="submit" name="btn-update" id="btn-save" class="pure-button pure-button-primary">Uctualizar Post</button>
                  <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Volver a index</a>             
              </div>    
    </fieldset>
</form>    
     
</div>

<?php include_once '../../footer.php'; ?>