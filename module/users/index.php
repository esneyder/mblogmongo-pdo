<?php
include_once '../../connection/dbconfig.php';
?>
<?php include_once '../../header.php'; ?>

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
     <th>Nombres</th>
     <th>Perfil</th> 
     <th>E - mail</th>
     <th>Password</th>
     <th>Tipo</th>
     <th>Región</th>
     <th>Estado</th>
     <th colspan="2" align="center">Acción</th>
     </tr>
     <?php

		$query = "SELECT * FROM usuarios";       
		$records_per_page=10;//CANTIDAD DE REGISTROS A MOSTRAR
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="10" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once '../footer.php'; ?>