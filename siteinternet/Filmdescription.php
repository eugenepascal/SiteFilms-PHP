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
    <li><a href="ListFilm.php" style="color: white; text-decoration:none">Liste de films</a></li>
    <li><a href="ListActor.php" style="color: white; text-decoration:none">Liste d'Acteurs</a></li>
    <li><a href="Filmdescription.php" style="color: white; text-decoration:none" class ="active">Description de film</a></li>
  </ul>
  </div>
  <br><br><br>     
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
          
        $query = "SELECT title FROM film LIMIT 0, 1";     
        $rs_result = mysqli_query($mysqli, $query);    
  ?>
  <?php if ($_GET["title"] != "") {
    $titrefilm = $_GET["title"];
  } else {
    while ($row = mysqli_fetch_array($rs_result)) { 
      $titrefilm = $row['title'];
    }
  }
  ?>
  <h1 class ="Titre"><td><?php echo $titrefilm ?></td></h1>

  <?php $query = "SELECT `description`, release_year, special_features FROM film WHERE title LIKE '$titrefilm'";     
    $rs_result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($rs_result)) { 
      $description = $row['description']; 
      $annee = $row['release_year'];
      $special = $row['special_features']; 
    }
    ?>
    <p style ="margin-left : 25px;"> <?php echo $annee ?> </p>
    <p style ="margin-left : 25px;">
    <h2 class = 'SousTitre'>Description : </h2>
    <div style ="margin-left : 25px;"><?php echo  $description ?></div> </p>
    <p style ="margin-left : 25px;">
    <h2 class = 'SousTitre'>Caractéristiques spéciales : </h2>
    <div style ="margin-left : 25px;"><?php echo  $special ?></div></p>
  </body>   
</html>