<?php
include_once '../../connection/dbconfig.php';
?>
<?php include_once '../../header.php'; ?>
 <meta charset="utf-8">
<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="pure-button">
<i class="fa fa-hdd-o"></i> &nbsp; Nuevo</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Título</th>
     <th>Introducción</th>
     <th>Descripción</th> 
     <th>Categoría</th>
     <th>Fecha</th>     
     <th>Usuario</th>     
     <th colspan="2" align="center">Acción</th>
     </tr>
     <?php

		$query = "SELECT * FROM post";       
		$records_per_page=6;//CANTIDAD DE REGISTROS A MOSTRAR
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="12" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once '../../footer.php'; ?>