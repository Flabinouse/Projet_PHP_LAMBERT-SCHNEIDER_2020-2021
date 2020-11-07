<html>
  <head>
    <meta charset="UTF-8"/>
      <title >Nouvelle News</title >
        <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
        <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css"/>
        <meta name = "viewport" content = "width=max-device-width, initial-scale=1" />
  </head>
  <body>
    <header>
      <h1>NOUVELLE NEWS</h1></br>
      <nav>
        <?php error_reporting ( E_ALL ^ E_NOTICE);
        session_start();
        include ("connexion.php");
        if($_SESSION['connect'] == "ok"){
          $utili = $_SESSION['login'];
          echo '
          <ul>
            <li>'.$utili.'</li>
            <li><a href = "deconnexion.php">Deconnexion</a></li>
          </ul>';
        }
        ?>
      </nav>
    </header>
    <?php
    $erreur = [];
    if(!empty($_POST)){
      $ok=true;
      $titre=trim(htmlentities($_POST['titre']));
      $description=trim(htmlentities($_POST['description']));
    if(empty($_POST['titre'])){
      $erreur['titre'] = 'Vous devez renseigner le titre.<br/>';
      $ok=false;
    }
    if(empty($_POST['description'])){
      $erreur['description'] = 'Vous devez renseigner la desciption.<br/>';
      $ok=false;
    }
    if(empty($_POST['cbxtheme'])){
      $erreur['cbxtheme'] = 'Vous devez selectionner un theme.<br/>';
      $ok=false;
    }
    if($ok){
      include ("connexion.php");
      $iddesc = $_SESSION['id'];
      $idtheme = $_POST['cbxtheme'];
      $date = date("Y-m-d");
      $insert_stmt = $objPdo->prepare("INSERT INTO news(idtheme,titrenews,datenews,textenews,idredacteur) VALUES(?,?,?,?,?) ");
      $insert_stmt->bindParam(1,$idtheme);
      $insert_stmt->bindParam(2,$titre);
      $insert_stmt->bindParam(3,$date);
      $insert_stmt->bindParam(4,$description);
      $insert_stmt->bindParam(5,$iddesc);
      $insert_stmt->execute();
      echo '<script language="javascript" type="text/javascript">
       alert("Création reussi");
       document.location.href = "https://devweb.iutmetz.univ-lorraine.fr/~lamber235u/Projet_PHP_LAMBERT-SCHNEIDER/accueil.php";
      </script>';
    }
  }
   ?>
   <div id="page-container">
    <div class="espace">
      <section class="main">
        <form action="creernews.php" method="post" autocomplete="off">
          <p>Sélection du theme : </p>
          <select name="cbxtheme">
            <?php
            $result1 = $objPdo->prepare('SELECT * FROM theme');
            $result1->execute();
            echo '<option></option>';
            foreach ($result1 as $id) {
              echo '<option value="'.$id['idtheme'].'">'.$id['description'].'</option>';
            }
            ?>
          </select><span style='color:red'><?php echo $erreur['cbxtheme'];?></span><br /><br />
          Titre News :<br />
          <input type="text"name="titre"><span style='color:red'><?php echo $erreur['titre'];?></span><br /><br />
          Description de la News :<br />
          <textarea name="description" rows="5" cols="80"></textarea><span style='color:red'><?php echo $erreur['description'];?></span><br /></br>
          <input type="submit" value="Validez"><br /></br>
        </form>
        <a id="HdP" href="accueil.php">Retour à la page d'accueil</a><br/>

      </section>
    </div>
  </div>
  <footer class="footer">
    <p>&copy Création par LAMBERT Flavien et Louis SCHNEIDER - 2020/2021</p>
  </footer>
  </body>
</html>
