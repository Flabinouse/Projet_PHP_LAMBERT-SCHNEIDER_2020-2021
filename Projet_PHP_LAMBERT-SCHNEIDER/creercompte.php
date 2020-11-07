<html>
  <?php error_reporting ( E_ALL ^ E_NOTICE);
  include ("connexion.php");
  $erreur = [];
  $double = false;
  if(!empty($_POST)){
    $ok=true;
    $user=trim(htmlentities($_POST['user']));
    $username=trim(htmlentities($_POST['username']));
    $email=trim(htmlentities($_POST['email']));
    $mdp=trim(htmlentities($_POST['mdp']));

    if(empty($_POST['user'])){
      $erreur['user'] = 'Vous devez renseigner le nom';
      $ok=false;
    }
    if(empty($_POST['username'])){
      $erreur['username'] = 'Vous devez renseigner le prenom';
      $ok=false;
    }
    if(empty($_POST['email'])){
      $erreur['email'] = "Vous devez renseigner l'adresse email";
      $ok=false;
    }
    if(empty($_POST['mdp'])){
      $erreur['mdp'] = 'Vous devez renseigner le mot de passe';
      $ok=false;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $erreur['validemail'] = 'Email saisie invalid';
      $ok=false;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$user)) {
      $erreur['validnom'] = 'Nom saisie invalid';
      $ok=false;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
      $erreur['validprenom'] = 'Prenom saisie invalid';
      $ok=false;
    }
    $req = $objPdo->prepare('SELECT * FROM redacteur ');
    $req->execute();
    foreach ($req as $mel) {
          if($mel['adressemail'] == $email){
            $erreur['doublon'] = 'Cette Email existe deja !';
            $ok=false;
            $double=true;
            break;
          }
    }
    if($ok){

      $insert_stmt = $objPdo->prepare("INSERT INTO redacteur(nom,prenom,adressemail,motdepasse) VALUES(?,?,?,?) ");
      $insert_stmt->bindValue(1,$user);
      $insert_stmt->bindValue(2,$username);
      $insert_stmt->bindValue(3,$email);
      $insert_stmt->bindValue(4,$mdp);
      $insert_stmt->execute();
      echo '<script language="javascript" type="text/javascript">
       alert("Création reussi");
       document.location.href = "https://devweb.iutmetz.univ-lorraine.fr/~lamber235u/Projet_PHP_LAMBERT-SCHNEIDER/authentification.php";
      </script>';
    }
  }
   ?>
   <head>
    <meta charset="UTF-8"/>
      <title >Inscription</title >
      <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
      <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css"/>
      <meta name = "viewport" content = "width=max-device-width, initial-scale=1" />
   </head>
   <body>
    <header>
     <h1>INSCRIPTION</h1>
    </header>
  <div id="page-container">
   <div class="espace">
     <section class="main">
       <p>Veuillez renseigner les champs suivants pour vous inscrire :</p>
       <form action="creercompte.php" method="post" autocomplete="off">
         Nom :<br />
         <input type="text"name="user"><span style='color:red'><?php echo $erreur['user']; if(empty($erreur['user'])) echo $erreur['validnom'];?></span><br />
         Prenom :<br />
         <input type="text"name="username"><span style='color:red'><?php echo $erreur['username']; if(empty($erreur['username'])) echo $erreur['validprenom'];?></span><br />
         Adress email :<br />
         <input type="text"name="email"><span style='color:red'><?php echo $erreur['email']; if(empty($erreur['email'])){ echo $erreur['validemail'];} if($double == true){ echo $erreur['doublon'];}?></span><br />
         Mot de passe :<br />
        <input type="password"name="mdp"><span style='color:red'><?php echo $erreur['mdp'];?></span><br/><br/>
        <input type="submit" value="Validez"><br /></br>
        <a id="HdP" href="accueil.php">Retour à la page d'accueil</a><br/>
      </section>
   </div>
 </div>
  <footer class="footer">
    <p>&copy Création par LAMBERT Flavien et Louis SCHNEIDER - 2020/2021</p>
  </footer>
 </body>
</html>
