<?php 
class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

/*funCION CREar poST*/

public function create($titulo,$intro,$texto,$categoria ,$usuario)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO post(titulo,intro,texto,
													categoria ,usuario)
			 										VALUES(:titulo, :intro, :texto,
			 										:categoria, :usuario )");
			$stmt->bindparam(":titulo",$titulo);
			$stmt->bindparam(":intro",$intro);
			$stmt->bindparam(":texto",$texto);
			$stmt->bindparam(":categoria",$categoria);
			//$stmt->bindparam(":fecha",$fecha);
			$stmt->bindparam(":usuario",$usuario);
		 
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	/*consultar post por id de registro*/

public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM post WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
/*eliminar post por id de registro*/
public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM post WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}

/*actualizar post por id registro*/
public function update($id,$titulo,$intro,$texto,$categoria ,$usuario)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE post SET titulo=:titulo, 
		                                               intro=:intro, 
													   texto =:texto, 
													   categoria=:categoria,
													   usuario=:usuario 													 
													WHERE id=:id ");
			$stmt->bindparam(":titulo",$titulo);
			$stmt->bindparam(":intro",$intro);
			$stmt->bindparam(":texto",$texto);
			$stmt->bindparam(":categoria",$categoria);
			$stmt->bindparam(":usuario",$usuario);			 
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


/*combo categorias*/
 
public function selectCategorias($query)
{
	$stmt=$this->db->prepare($query);
	$stmt->execute();
	 //echo "<SELECT NAME="categoria">";
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

/*listar articulos en index*/
public function getPost()
	{
		$query = "SELECT * FROM post";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?> 
                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="img/common/tilo-avatar.png">

                        <h2 class="post-title"><?php print($row['titulo']); ?></h2>

                        <p class="post-meta">
                            Por <a href="#" class="post-author"><?php print($row['usuario']); ?></a> <?php print($row['categoria']); ?> 
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                            <?php print($row['intro']); ?>
                        </p>
                    </div>
                </section> 
                   <?php
			}
		}
		else
		{
			?>
             <section class="post">
              <header class="post-header">
             No hay datos para mostrar.. 
            </div>
             </section>
            <?php

		}
		
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
                <td><?php print($row['titulo']); ?></td>
                <td><?php print($row['intro']); ?></td>
                <td><?php print($row['texto']); ?></td>
                <td><?php print($row['categoria']); ?></td>
                <td><?php print($row['fecha']); ?></td>                
                <td><?php print($row['usuario']); ?></td>                
                
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>" title="Eliminar"><i class="glyphicon glyphicon-remove-circle"></i></a>
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
 ?>