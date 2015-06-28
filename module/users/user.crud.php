<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
		
	public function create($nombre,$perfil,$email,$password,$tipo,$region,$estado )
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO usuarios(nombre,perfil,email,
													password,tipo,region,estado)
			 										VALUES(:nombre, :perfil, :email,
			 										:password,:tipo,:region,:estado )");
			$stmt->bindparam(":nombre",$nombre);
			$stmt->bindparam(":perfil",$perfil);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":tipo",$tipo);
			$stmt->bindparam(":region",$region);
			$stmt->bindparam(":estado",$estado);
		 
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$nombre,$perfil,$email,$password,$tipo,$region,$estado)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE usuarios SET nombre=:nombre, 
		                                               perfil=:perfil, 
													   email =:email, 
													   password=:password,
													   tipo=:tipo,
													   region=:region,
													   estado=:estado													 
													WHERE id=:id ");
			$stmt->bindparam(":nombre",$nombre);
			$stmt->bindparam(":perfil",$perfil);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":tipo",$tipo);
			$stmt->bindparam(":region",$region);
			$stmt->bindparam(":estado",$estado);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM usuarios WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}


/**
	 * select data from the the files
	 * @param int $id
	 * @return array contains mime type and BLOB data
	 */
	public function selectBlob($id) {

		$sql = "SELECT  
				archivo
				FROM usuarios
				WHERE id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array(":id" => $id));		 
		$stmt->bindColumn(2, $data, PDO::PARAM_LOB);

		$stmt->fetch(PDO::FETCH_BOUND);

		return array("data" => $data);

	}


	
/*combo regiones*/
public function selectRegioneS($query)
{
	# code...
	$stmt=$this->db->prepare($query);
	$stmt->execute();
	 //echo "<SELECT NAME="region">";
	 echo "<option>Seleccione una Opción...</option>";
	if ($stmt->rowCount()>0) {
		 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		 	?>

		 	<?php 
		 	print('<OPTION VALUE="'.$row['nombre'].'">'.$row['nombre'].'</OPTION>');
		 	 ?> 
		 	<?php  
		 }
	}else {
		   ?>
		 	<?php 
		 	  print  "<option>No hay datos..</option>";
		 	 ?> 
		 	<?php 
	}
	echo "</select>";
}
/*combo tipo*/
public function selectTipo($query)
{
	# code...
	$stmt=$this->db->prepare($query);
	$stmt->execute();
	 //echo "<SELECT NAME="region">";
	 echo "<option>Seleccione una Opción...</option>";
	if ($stmt->rowCount()>0) {
		 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		 	?>

		 	<?php 
		 	print('<OPTION VALUE="'.$row['tipo'].'">'.$row['tipo'].'</OPTION>');
		 	 ?> 
		 	<?php  
		 }
	}else {
		   ?>
		 	<?php 
		 	  print  "<option>No hay datos..</option>";
		 	 ?> 
		 	<?php 
	}
	echo "</select>";
}
/*combo esTATDO*/
public function selectEstado($query)
{
	# code...
	$stmt=$this->db->prepare($query);
	$stmt->execute();
	 //echo "<SELECT NAME="region">";
	 echo "<option>Seleccione una Opción...</option>";
	if ($stmt->rowCount()>0) {
		 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		 	?>

		 	<?php 
		 	print('<OPTION VALUE="'.$row['nombrEstado'].'">'.$row['nombrEstado'].'</OPTION>');
		 	 ?> 
		 	<?php  
		 }
	}else {
		   ?>
		 	<?php 
		 	  print  "<option>No hay datos..</option>";
		 	 ?> 
		 	<?php 
	}
	echo "</select>";
}

	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
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
                
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>No hay datos para mostrar..</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
