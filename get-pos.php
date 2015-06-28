<?php 
class post
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
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



}