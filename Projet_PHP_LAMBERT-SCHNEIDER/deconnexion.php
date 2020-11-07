<html>
<?php error_reporting ( E_ALL ^ E_NOTICE);
session_start();

$_SESSION[]=array();
session_destroy();
echo '<script language="javascript" type="text/javascript">
 alert("Deconnexion reussi");
 document.location.href = "https://devweb.iutmetz.univ-lorraine.fr/~lamber235u/Projet_PHP_LAMBERT-SCHNEIDER/accueil.php";
</script>';
?>
<head>
  <meta charset="utf-8">
  <title>Deconnexion</title>
</head>
<body>
</body>
</html>
