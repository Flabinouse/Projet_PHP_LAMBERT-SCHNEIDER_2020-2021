<html>
<?php error_reporting ( E_ALL ^ E_NOTICE);
  $verif = false;
  $email = trim(htmlentities($_POST['user']));
  $mdp = htmlspecialchars($_POST['mdp']);
  $erreur = [];

  if(!empty($_POST)){
    $ok=true;
  if(empty($_POST['user'])){
    $erreur['user'] = 'Vous devez renseigner l\'email';
    $ok=false;
  }
  if(empty($_POST['mdp'])){
    $erreur['mdp'] = 'Vous devez renseigner le mot de passe';
    $ok=false;
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $erreur['email'] = 'Email saisie invalid';
    $ok=false;
  }
}
  if($ok){
    if (isset($_POST['user']) && isset($_POST['mdp'])){
      include ("connexion.php");
      $result1 = $objPdo->prepare('SELECT * FROM redacteur');
      $result1->execute();
      foreach ($result1 as $row) {
        if($email == $row['adressemail'] && $mdp == $row['motdepasse']){
          session_start();
          $login = $row['nom'].' '.$row['prenom'];
          $_SESSION['connect'] = "ok";
          $_SESSION['id'] = $row['idredacteur'];
          $_SESSION['login']= $login;
          $_SESSION['mdp']= $mdp;
          $verif = true;
          break;
        }else{
          $verif = false;
        }
      }
    }
  if($verif == true){
    echo '<script language="javascript" type="text/javascript">
    alert("Connexion reussi");
    document.location.href = "https://devweb.iutmetz.univ-lorraine.fr/~lamber235u/Projet_PHP_LAMBERT-SCHNEIDER/accueil.php";
    </script>';
  }else {
    echo '<script language="javascript" type="text/javascript"> alert("connection echoue, Email ou mot de passe invalide");</script>';
    }
  }
  ?>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
    <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css"/>
    <meta name = "viewport" content = "width=max-device-width, initial-scale=1" />
  </head>
  <body>
    <header>
      <h1>CONNECTION</h1>
    </header>
      <div id="page-container">
        <div class="espace">
          <section class="main">
            <p>Pour vous connectez, veuillez saisir votre Email et votre mot de passe :</p>
            <form method ="post" action ="" autocomplete="off">
              Addresse Email: <br/><input type="text" size="20" name="user"><span style='color:red'><?php echo $erreur['user']; if(empty($erreur['user'])) echo $erreur['email'];?></span><br/>
              Mot de passe: <br/><input type="password" size="20" name="mdp"><span style='color:red'><?php echo $erreur['mdp'];?></span><br/><br/>
              <input type="submit" value="Validez"><br/></br>
            </form>
            <a id="HdP"href="accueil.php">Retour à l'accueil</a><br/>
          </section>
        </div>
      </div>
      <footer class="footer">
        <p>&copy Création par LAMBERT Flavien et Louis SCHNEIDER - 2020/2021</p>
      </footer>
    </body>
</html>
