<?php
include_once '../../connection/dbconfig.php';
?>
<?php include_once '../../header.php'; ?>
<div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
           <?php      
        $query = "SELECT * FROM post";
		$stmt =  $DB_con->prepare($query);
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
		 ?>
                


            </div>  
            </div> 
             </div>
