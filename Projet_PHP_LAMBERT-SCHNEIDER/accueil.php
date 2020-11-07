<html>
  <head>
    <meta charset="UTF-8"/>
    <title>Accueil</title>
    <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
    <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css"/>
    <meta name = "viewport" content = "width=max-device-width, initial-scale=1" />
  </head>
  <body>
    <header>
      <a id="logo" href="http://www.iut-metz.univ-lorraine.fr/%22%3E">
    <img class="image_rond" src="images/LogoIUT.png"  width="200" style="border-radius:10px;">
      </a>
    <h1>ACCUEIL</h1>
  <?php error_reporting ( E_ALL ^ E_NOTICE);
      include ("connexion.php");
      session_start();
      echo '<nav>
          <ul>
           <li class="first active">
            <a href = accueil.php>ACCUEIL</a>
           </li>
           <li>
            <a href = news.php>NEWS</a>
           </li>';
      if($_SESSION['connect'] == "ok"){
        $utili = $_SESSION['login'];
        echo '
          <li>'.$utili.'</li>
          <li><a href = "deconnexion.php">Deconnexion</a></li>
        </ul>
        </nav>';
      }
      else {
        $utili = "";
        echo '
          <li><a href = "authentification.php">Se connecter</a></li>
          <li><a href = "creercompte.php">S\'inscrire</a></li>
        </ul>
        </nav>  ';
      }
      echo '</header>';
      echo ' <section class="main">';
      echo '<h2>Bienvenue '.$utili.' sur le site IUTNews</h2>';
   ?>
 </br>
 <form name="recherche" action="" method="post">
    <label for="Recherche">Rechercher</label>
    <select name="cbxtheme">
      <?php
      $result1 = $objPdo->prepare('SELECT * FROM theme');
      $result1->execute();
      echo '<option></option>';
      foreach ($result1 as $id) {
        echo '<option value="'.$id['idtheme'].'">'.$id['description'].'</option>';
      }
      ?>
    </select>
    <input type="submit" value="Chercher"/>
  </form>
</section>
<section class="main">
  <?php
    if($_SESSION['connect'] == "ok"){
      echo '
        <h1>NEWS</h1>
        <a id="new" href = "creernews.php">Ecrire une nouvelle news </a></br>
        ';
    }else{
      echo ' <h1>NEWS</h1>';
    }
    $result1 = $objPdo->prepare('SELECT * FROM news');
    $result1->execute();
    $theme=$_POST['cbxtheme'];
    $recup = $objPdo->prepare('SELECT * FROM news WHERE idtheme=?');
    $recup->bindValue(1,$theme);
    $recup->execute();

    if(!empty($_POST['cbxtheme'])){
      foreach($recup as $row2)
       {
         echo '<article id=\'titre\'>';
         echo '<a href = "news.php">'.$row2['titrenews'].'</a></br></br>';
         switch($row2['idtheme'])
         {
           case 1 :
             echo '<small>'.$row2['datenews'].' Ecologie</small>';
             break;
           case 2 :
             echo '<small>'.$row2['datenews'].' Santé</small>';
             break;
           case 3 :
             echo '<small>'.$row2['datenews'].' Sport</small>';
             break;
           case 4 :
             echo '<small>'.$row2['datenews'].' Divertissement</small>';
             break;
           case 5 :
             echo '<small>'.$row2['datenews'].' Fait divers</small>';
           break;
        }
         echo '</article>';
       }
    }else{
      foreach($result1 as $row)
       {
         echo '<article id=\'titre\'>';
         echo '<a href = "news.php">'.$row['titrenews'].'</a></br></br>';
         switch($row['idtheme'])
         {
           case 1 :
             echo '<small>'.$row['datenews'].' Ecologie</small>';
             break;
           case 2 :
             echo '<small>'.$row['datenews'].' Santé</small>';
             break;
           case 3 :
             echo '<small>'.$row['datenews'].' Sport</small>';
             break;
           case 4 :
             echo '<small>'.$row['datenews'].' Divertissement</small>';
             break;
           case 5 :
             echo '<small>'.$row['datenews'].' Fait divers</small>';
           break;
        }
         echo '</article>';
       }
    }
    ?>
    </section>
    <footer>
      <p>&copy Création par LAMBERT Flavien et Louis SCHNEIDER - 2020/2021</p>
    </footer>
  </body>
<html>
