<?php
 
include_once '../../connection/dbconfig.php';
 

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$crud->delete($id);
	header("Location: delete.php?deleted");	
}

?>

<?php include_once '../../header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Perfecto!</strong> Usuario eliminado... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Pregunta !</strong> Esta seguro de eliminar el registro ? 
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>Nombres</th>
         <th>Perfil</th>
         <th>E - mail</th>
         <th>Password</th>
         <th>Tipo</th>
         <th>Región</th>
         <th>Estado</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM usuarios WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['nombre']); ?></td>
                <td><?php print($row['perfil']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['password']); ?></td>
                <td><?php print($row['tipo']); ?></td>
                <td><?php print($row['region']); ?></td>
                <td><?php print($row['estado']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; SI</button>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>	
<?php include_once '../../footer.php'; ?>