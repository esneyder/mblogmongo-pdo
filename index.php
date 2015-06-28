<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a blog page with a list of posts.">
  <link rel="shortcut icon" href="img/favicon.png" />
    <title>MblogMongo | Mini Editor contenidos</title> 

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
 
<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  
<!--<![endif]--> 
  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/blog-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/blog.css">
    <!--<![endif]--> 

</head>
<body> 
<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">Mini editor</h1>
            <h2 class="brand-tagline">El poder de PHP PDO </h2>

            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="module/users">Admin usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" href="module/post">Post</a>
                    </li>
                     <li class="nav-item">
                        <a class="pure-button" target="_blank" href="https://github.com/esneyder/mblogmongo-pdo">Descargar</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php include_once 'connection/dbconfig.php'; ?>
    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
        <div class="posts">  
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
                <h1 class="content-subhead"><?php print($row['fecha']); ?></h1>
                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar" alt="<?php print($row['usuario']); ?>" height="48" width="48" src="img/common/alvarez.jpg">

                        <h2 class="post-title"><?php print($row['titulo']); ?></h2>

                        <p class="post-meta">
                            Por <a href="#" class="post-author">
                            <?php print($row['usuario']); ?></a> Categoría 
                            <a class="post-category post-category-design" href="#"><?php print($row['categoria']); ?></a>
                             
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
 

            <div class="footer">
                <div class="pure-menu pure-menu-horizontal">
                    <ul>
                        <li class="pure-menu-item"><a href="https://ingedwinesneyder.wordpress.com/" class="pure-menu-link">About</a></li>
                        <li class="pure-menu-item"><a href="https://twitter.com/EdwinEsneyder" class="pure-menu-link">Twitter</a></li>
                        <li class="pure-menu-item"><a href="https://github.com/esneyder/" class="pure-menu-link">GitHub</a></li>
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>






</body>
</html>
