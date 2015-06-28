<?php
 
include_once '../../connection/dbconfig.php';
if(isset($_POST['btn-save']))
{
  
	$titulo = $_POST['titulo'];
	$intro = $_POST['intro'];
	$texto = $_POST['texto'];
  $categoria = $_POST['categoria'];
 $fecha = date('y-m-d');
  $usuario = 'edesalla17@gmail.com';
   
	 
	
	if($crud->create($titulo,$intro,$texto,$categoria,$fecha, $usuario ))
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
    <strong>Super!</strong> Post ingresado correctamente <a href="index.php">Inicio</a>!
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

 	<form enctype="multipart/form-data" 
   class="pure-form pure-form-aligned" method="POST">
    <fieldset>
        <legend>Crear Post</legend>
         
            <div class="pure-control-group">
                <label for="first-name">Título</label>
                <input name="titulo" class="pure-input-1-2"  
                type="text" required>
            </div>
            <div class="pure-control-group">
                <label for="last-name">Introducción</label>
                <input name="intro" class="pure-input-1-2"  
                type="text" required>
            </div>
            <div class="pure-control-group">
                <label for="last-name">Descripción</label>
                <textarea name="texto" class="pure-input-1-2" cols="30" rows="5" required></textarea>
                 
            </div>              
            
            <div class="pure-control-group">
                <label for="state">Categoría</label>
                <select name="categoria" class="pure-input-1-2">
                     <?php 
                      $query = "SELECT * FROM categoria"; 
                      $crud->selectCategorias($query);
                      ?>
                </select>
            </div> 

             <div class="pure-controls">
             <button type="submit" name="btn-save" id="btn-save" class="pure-button pure-button-primary">Guardar Post</button>
          <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Volver a index</a>
             
              </div>

       
        
            
    </fieldset>
</form>
     
     
</div>

<?php include_once '../../footer.php'; ?>