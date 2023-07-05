<html>   
  <head>
    <Title>FILMINFO</Title>
    <link rel="icon" href="Images/icon.png">
    <meta charset="utf-8">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  </head>   
  <body>
  <div class="BarreMenu">
  <ul>
    <li><a href="accueil.html" style="color: white; text-decoration:none">Accueil</a></li>
    <li><a href="ListFilm.php" style="color: white; text-decoration:none" class ="active">Liste de films</a></li>
    <li><a href="ListActor.php" style="color: white; text-decoration:none">Liste d'Acteurs</a></li>
    <li><a href="Filmdescription.php" style="color: white; text-decoration:none">Description de film</a></li>
  </ul>
  </div>
  <p> </p>
  <p> t </p>
  <center>  
  <div class="search">
    <form action="#" method = 'post'>
      <input type="text"
        placeholder=" Rechercher un film"
        name="recherche">
        <button>
        <i class="fa fa-search"
          style="font-size: 18px;">
        </i>
        </button>
    </form>
  </div>  
  <?php $Recherche = htmlspecialchars($_POST['recherche']); ?>     
  <?php  
      
    // Import the file where we defined the connection to Database.     
	$user = 'root';
	$password = 'Germaine18?.';
	 
	// Database name is gfg
	$database = 'sakila';
	 
	// Server is localhost with
	// port number 3306
	$servername='localhost:3306';
	$mysqli = new mysqli($servername, $user,
					$password, $database);
	 
	// Checking for connections
	if ($mysqli->connect_error) {
		die('Connect Error (' .
		$mysqli->connect_errno . ') '.
		$mysqli->connect_error);
	} 
    
        $per_page_record = 30;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;     
    
        $query = "SELECT film.title, film.release_year, category.name FROM film
        INNER JOIN film_category ON film.film_id = film_category.film_id
        INNER JOIN category ON film_category.category_id = category.category_id
        WHERE (category.name LIKE '%$Recherche%') OR (film.title LIKE '%$Recherche%') OR (film.release_year LIKE '%$Recherche%')
        ORDER BY film.title
        LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query($mysqli, $query);    
    ?>    
  
    <div class="container">   
      <br>   
      <div>   
        <h1 class ="Titre2" style ="margin-right:80px">Liste des Films</h1>
        <p class ="SousTitre2">(cliquer sur le nom d'un film pour avoir les détails)</p>
        <table class="table table-striped table-condensed    
                                          table-bordered">   
          <thead>   
            <tr>   
              <th>Titre</th>    
              <th>Catégorie</th>
              <th>Année de sortie</th>     
            </tr>   
          </thead>   
          <tbody>   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>
            <?php $link = 'Filmdescription.php?title='. $row["title"]; ?>
            <td><?php echo '<a href="' . $link . '"style="color: black; text-decoration:none">'. $row["title"]."</a>"; ?></td>    
            <td><?php echo $row["name"]; ?></td>   
            <td><?php echo $row["release_year"]; ?></td>                                          
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        $query = "SELECT COUNT(film.title and film.release_year and category.name) FROM film
        INNER JOIN film_category ON film.film_id = film_category.film_id
        INNER JOIN category ON film_category.category_id = category.category_id
        WHERE (category.name LIKE '%$Recherche%') OR (film.title LIKE '%$Recherche%') OR (film.release_year LIKE '%$Recherche%')";     
        $rs_result = mysqli_query($mysqli, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='ListFilm.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='ListFilm.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='ListFilm.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='ListFilm.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
      </div>  
  
  
      <div class="inline">   
      <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
      placeholder="<?php echo $page."/".$total_pages; ?>" required>   
      <button onClick="go2Page();">Go</button>   
     </div>    
    </div>   
  </div>  
</center>   
  <script>   
    function go2Page()   
    {   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'ListFilm.php?page='+page;   
    }   
  </script>  
  </body>   
</html>